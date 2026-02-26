@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white p-8 rounded shadow">

<h2 class="text-2xl font-bold mb-6 text-center">
Login
</h2>

<form method="POST" action="{{ route('login') }}">
@csrf

<input type="email"
name="email"
placeholder="Email"
class="w-full border p-3 mb-4 rounded"
required>

<input type="password"
name="password"
placeholder="Password"
class="w-full border p-3 mb-4 rounded"
required>

<button class="w-full bg-indigo-600 text-white p-3 rounded">
Login
</button>

</form>

</div>

@endsection