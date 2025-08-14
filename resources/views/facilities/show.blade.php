@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>{{ $facility->business_name }}</h2>
    <div class="d-flex gap-2">
      <a href="{{ route('facilities.edit', $facility) }}" class="btn btn-primary">Edit</a>
      <a href="{{ route('facilities.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-body">
      <p><strong>Last Updated:</strong> {{ optional($facility->last_update_date)->format('Y-m-d') }}</p>
      <p><strong>Address:</strong> {{ $facility->street_address }}</p>
      <p><strong>Materials Accepted:</strong> {{ $facility->materials->pluck('name')->implode(', ') ?: '—' }}</p>
    </div>
  </div>

  <h5>Map</h5>
  <div class="ratio ratio-16x9">
    <iframe
      src="https://www.google.com/maps?q={{ urlencode($facility->street_address) }}&output=embed"
      width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
@endsection
