@extends('layouts.app')

@section('content')

<div class="max-w-lg mx-auto bg-white p-8 rounded shadow">

<h2 class="text-2xl font-bold mb-6 text-center">
Voter Registration
</h2>

<form method="POST" action="{{ route('register') }}">
@csrf

<input name="name"
placeholder="Full Name"
class="w-full border p-3 mb-4 rounded"
required>

<input name="email"
type="email"
placeholder="Email Address"
class="w-full border p-3 mb-4 rounded"
required>

<input name="password"
type="password"
placeholder="Password"
class="w-full border p-3 mb-4 rounded"
required>

<input name="password_confirmation"
type="password"
placeholder="Confirm Password"
class="w-full border p-3 mb-4 rounded"
required>

<button
class="w-full bg-green-600 text-white p-3 rounded hover:bg-green-700">
Register as Voter
</button>

</form>

</div>

@endsection