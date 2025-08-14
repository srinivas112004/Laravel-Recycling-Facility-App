<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Recycling Facility Directory</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('facilities.index') }}">Recycling Directory</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('facilities.create') }}">Add Facility</a></li>
      </ul>
    </div>
  </div>
</nav>
<main class="container">
  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
  @yield('content')
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
