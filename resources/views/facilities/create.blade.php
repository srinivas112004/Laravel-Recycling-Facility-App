@extends('layouts.app')

@section('content')
  <h2 class="mb-3">Add Facility</h2>
  <form method="POST" action="{{ route('facilities.store') }}" class="card card-body">
    @csrf
    @include('facilities.partials.form', ['facility' => null, 'materials' => $materials])
    <div class="mt-3 d-flex gap-2">
      <button class="btn btn-success">Save</button>
      <a href="{{ route('facilities.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
  </form>
@endsection
