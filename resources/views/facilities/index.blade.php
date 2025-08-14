@extends('layouts.app')

@section('content')
  <h1 class="mb-3">Facilities</h1>

  <form method="GET" action="{{ route('facilities.index') }}" class="row g-2 align-items-end mb-3">
    <div class="col-md-4">
      <label class="form-label">Search (name / city / material)</label>
      <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="e.g. Green Earth or New York">
    </div>
    <div class="col-md-3">
      <label class="form-label">Filter by Material</label>
      <select name="material_id" class="form-select">
        <option value="">-- All materials --</option>
        @foreach($materials as $m)
          <option value="{{ $m->id }}" @selected($materialId == $m->id)>{{ $m->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Sort by Last Update</label>
      <select name="sort" class="form-select">
        <option value="desc" @selected($sortDir==='desc')>Newest first</option>
        <option value="asc" @selected($sortDir==='asc')>Oldest first</option>
      </select>
    </div>
    <div class="col-md-2 d-flex gap-2">
      <button class="btn btn-primary w-100">Apply</button>
      <a href="{{ route('facilities.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
    </div>
  </form>

  <div class="mb-3 d-flex justify-content-between">
    <a href="{{ route('facilities.create') }}" class="btn btn-success">+ Add Facility</a>
    <a href="{{ route('facilities.export', request()->query()) }}" class="btn btn-outline-primary">Download CSV (current view)</a>
  </div>

  <div class="table-responsive">
    <table class="table table-striped align-middle">
      <thead>
        <tr>
          <th>Business Name</th>
          <th>Last Updated</th>
          <th>Address</th>
          <th>Materials Accepted</th>
          <th style="width:160px">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($facilities as $f)
          <tr>
            <td><a href="{{ route('facilities.show', $f) }}">{{ $f->business_name }}</a></td>
            <td>{{ optional($f->last_update_date)->format('Y-m-d') }}</td>
            <td>{{ $f->street_address }}</td>
            <td>{{ $f->materials->pluck('name')->implode(', ') }}</td>
            <td>
              <a href="{{ route('facilities.edit', $f) }}" class="btn btn-sm btn-primary">Edit</a>
              <form action="{{ route('facilities.destroy', $f) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this facility?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-center text-muted">No facilities found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div>
    {{ $facilities->links() }}
  </div>
@endsection
