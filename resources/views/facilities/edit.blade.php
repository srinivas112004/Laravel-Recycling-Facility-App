@extends('layouts.app')

@section('content')
  <h2 class="mb-3">Edit Facility</h2>
  <form method="POST" action="{{ route('facilities.update', $facility) }}" class="card card-body">
    @csrf @method('PUT')
    @include('facilities.partials.form', ['facility' => $facility, 'materials' => $materials])
    <div class="mt-3 d-flex gap-2">
      <button class="btn btn-primary">Update</button>
      <a href="{{ route('facilities.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
  </form>
@endsection
