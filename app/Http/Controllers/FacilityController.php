<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FacilityController extends Controller
{
    public function index(Request $request)
    {
        $q          = trim((string) $request->get('q', ''));
        $materialId = $request->get('material_id');
        $sortDir    = strtolower($request->get('sort', 'desc')) === 'asc' ? 'asc' : 'desc';

        $query = Facility::query()
            ->with('materials')
            ->when($q, function ($qr) use ($q) {
                $qr->where(function ($sub) use ($q) {
                    $sub->where('business_name', 'like', "%{$q}%")
                        ->orWhere('street_address', 'like', "%{$q}%")
                        ->orWhereHas('materials', fn($m) => $m->where('name', 'like', "%{$q}%"));
                });
            })
            ->when($materialId, fn($qr) => $qr->whereHas('materials', fn($m) => $m->where('materials.id', $materialId)))
            ->orderBy('last_update_date', $sortDir)
            ->orderBy('id', 'desc');

        $facilities = $query->paginate(10)->withQueryString();
        $materials  = Material::orderBy('name')->get();

        return view('facilities.index', compact('facilities', 'materials', 'q', 'materialId', 'sortDir'));
    }

    public function create() {
        $materials = Material::orderBy('name')->get();
        return view('facilities.create', compact('materials'));
    }

    public function store(StoreFacilityRequest $request) {
        $facility = Facility::create($request->validated());
        $facility->materials()->sync($request->input('materials', []));
        return redirect()->route('facilities.index')->with('success', 'Facility created.');
    }

    public function show(Facility $facility) {
        $facility->load('materials');
        return view('facilities.show', compact('facility'));
    }

    public function edit(Facility $facility) {
        $materials = Material::orderBy('name')->get();
        $facility->load('materials');
        return view('facilities.edit', compact('facility', 'materials'));
    }

    public function update(UpdateFacilityRequest $request, Facility $facility) {
        $facility->update($request->validated());
        $facility->materials()->sync($request->input('materials', []));
        return redirect()->route('facilities.index')->with('success', 'Facility updated.');
    }

    public function destroy(Facility $facility) {
        $facility->delete();
        return redirect()->route('facilities.index')->with('success', 'Facility deleted.');
    }

    public function export(Request $request): StreamedResponse
    {
        $q          = trim((string) $request->get('q', ''));
        $materialId = $request->get('material_id');
        $sortDir    = strtolower($request->get('sort', 'desc')) === 'asc' ? 'asc' : 'desc';

        $facilities = Facility::query()
            ->with('materials')
            ->when($q, function ($qr) use ($q) {
                $qr->where(function ($sub) use ($q) {
                    $sub->where('business_name', 'like', "%{$q}%")
                        ->orWhere('street_address', 'like', "%{$q}%")
                        ->orWhereHas('materials', fn($m) => $m->where('name', 'like', "%{$q}%"));
                });
            })
            ->when($materialId, fn($qr) => $qr->whereHas('materials', fn($m) => $m->where('materials.id', $materialId)))
            ->orderBy('last_update_date', $sortDir)
            ->orderBy('id', 'desc')
            ->get();

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="facilities.csv"',
        ];
        return response()->stream(function () use ($facilities) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Business Name', 'Last Updated', 'Address', 'Materials Accepted']);
            foreach ($facilities as $f) {
                fputcsv($out, [
                    $f->business_name,
                    optional($f->last_update_date)->format('Y-m-d'),
                    $f->street_address,
                    $f->materials->pluck('name')->implode(', '),
                ]);
            }
            fclose($out);
        }, 200, $headers);
    }
}
