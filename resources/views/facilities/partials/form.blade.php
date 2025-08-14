@php
  $selected = old('materials', $facility?->materials->pluck('id')->all() ?? []);
@endphp

<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Business Name *</label>
    <input type="text" name="business_name" class="form-control"
           value="{{ old('business_name', $facility->business_name ?? '') }}" required>
    @error('business_name') <div class="text-danger small">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-3">
    <label class="form-label">Last Update Date *</label>
    <input type="date" name="last_update_date" class="form-control"
           value="{{ old('last_update_date', isset($facility)? optional($facility->last_update_date)->format('Y-m-d') : '') }}" required>
    @error('last_update_date') <div class="text-danger small">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-12">
    <label class="form-label">Street Address *</label>
    <input type="text" name="street_address" class="form-control"
           placeholder="123 5th Ave, New York, NY 10001"
           value="{{ old('street_address', $facility->street_address ?? '') }}" required>
    @error('street_address') <div class="text-danger small">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-12">
    <label class="form-label">Materials Accepted</label>
    <select name="materials[]" multiple class="form-select" size="8">
      @foreach($materials as $m)
        <option value="{{ $m->id }}" @selected(in_array($m->id, $selected))>{{ $m->name }}</option>
      @endforeach
    </select>
    @error('materials.*') <div class="text-danger small">{{ $message }}</div> @enderror
    <div class="form-text">Hold Ctrl (Windows) / Cmd (Mac) to select multiple.</div>
  </div>
</div>
