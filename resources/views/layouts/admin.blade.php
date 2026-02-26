<!DOCTYPE html>
<html>
<head>
@vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="flex">

<!-- ================= SIDEBAR ================= -->
<div class="w-64 bg-gray-900 text-white min-h-screen p-6">

<h2 class="text-xl font-bold mb-6">
Admin Panel
</h2>

<nav class="space-y-3">

<a href="/admin/dashboard"
class="block hover:bg-gray-700 p-2 rounded">
🏠 Dashboard
</a>

<a href="{{ route('admin.candidates.index') }}"
class="block hover:bg-gray-700 p-2 rounded">
👤 Candidate List
</a>

<a href="{{ route('admin.candidates.create') }}"
class="block hover:bg-gray-700 p-2 rounded">
➕ Candidate Register
</a>

<a href="{{ route('admin.live.dashboard') }}"
class="block hover:bg-gray-700 p-2 rounded">
📊 Live Results
</a>

<!-- Election Start / Stop -->
 @php
$status = \App\Models\Election::first();
@endphp

<p class="mb-4 text-sm">
Status :
<span class="{{ $status && $status->is_active ? 'text-green-400':'text-red-400' }}">
{{ $status && $status->is_active ? 'LIVE' : 'STOPPED' }}
</span>
</p>
<form method="POST" action="{{ route('admin.election.toggle') }}">
@csrf
<button
class="w-full text-left hover:bg-gray-700 p-2 rounded">
🗳 Election Start / Stop
</button>
</form>

<hr class="border-gray-700 my-4">

{{-- LOGOUT MENU --}}
<form method="POST" action="{{ route('logout') }}">
@csrf

<button
class="w-full text-left hover:bg-red-600 p-2 rounded">
🚪 Logout
</button>

</form>
</nav>

</div>

<!-- ================= CONTENT ================= -->
<div class="flex-1 bg-gray-100 p-8">

@yield('content')

</div>

</body>
</html>