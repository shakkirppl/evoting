<!DOCTYPE html>
<html>
<head>
    <title>E-Voting System</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-100">

<nav class="bg-indigo-600 text-white p-4 flex justify-between">

<div class="font-bold">E-Voting</div>

<div>
@auth
<a href="/dashboard" class="mr-4">Dashboard</a>

<form method="POST" action="{{ route('logout') }}" class="inline">
@csrf
<button>Logout</button>
</form>
@endauth
</div>

</nav>

<div class="max-w-6xl mx-auto mt-8">
@yield('content')
</div>

</body>
</html>