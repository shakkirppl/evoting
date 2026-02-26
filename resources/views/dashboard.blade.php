@extends('layouts.app')

@section('content')

<div class="bg-white p-8 rounded shadow">

<h1 class="text-2xl font-bold">
Welcome {{ auth()->user()->name }}
</h1>

@if(auth()->user()->has_voted)

<div class="mt-6 text-green-600 font-bold">
You have already voted ✅
</div>

@else

<a href="/vote"
class="bg-indigo-600 text-white px-6 py-3 rounded mt-6 inline-block">
Cast Your Vote
</a>

@endif

</div>

@endsection