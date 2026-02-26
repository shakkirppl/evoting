<!DOCTYPE html>
<html>
<head>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="max-w-6xl mx-auto py-10">

<h1 class="text-3xl font-bold text-center mb-10">
🗳 Electronic Voting System
</h1>

{{-- Login Area --}}
<div class="text-right mb-6">

@auth
    <span class="mr-4 font-semibold">
        Welcome {{ auth()->user()->name }}
    </span>

    <form method="POST" action="{{ route('logout') }}" class="inline">
        @csrf
        <button class="bg-red-500 text-white px-4 py-2 rounded">
            Logout
        </button>
    </form>

@else
    <a href="{{ route('login') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded">
        Login
    </a>

    <a href="{{ route('register') }}"
       class="bg-green-500 text-white px-4 py-2 rounded">
        Register
    </a>
@endauth

</div>


{{-- Messages --}}
@if(session('success'))
<div class="bg-green-200 p-3 mb-4 rounded">
{{ session('success') }}
</div>
@endif


@if(session('error'))
<div class="bg-red-200 p-3 mb-4 rounded">
{{ session('error') }}
</div>
@endif


{{-- Candidate Grid --}}
<div class="grid md:grid-cols-3 gap-8">

@foreach($candidates as $candidate)

@php
$voted = $userVote && $userVote->candidate_id == $candidate->id;
@endphp

<div class="bg-white shadow-lg rounded-xl p-6 text-center
    {{ $voted ? 'border-4 border-green-500' : '' }}">

<img src="{{ asset('storage/'.$candidate->image) }}"
class="w-40 h-40 mx-auto rounded-full object-cover mb-4">

<h2 class="text-xl font-bold mb-4">
{{ $candidate->name }}
</h2>


{{-- VOTE BUTTON LOGIC --}}

@guest

<a href="{{ route('login') }}"
class="bg-blue-500 text-white px-6 py-2 rounded">
Login to Vote
</a>

@else

@if($userVote)

@if($voted)
<button class="bg-green-500 text-white px-6 py-2 rounded">
✔ Your Vote
</button>
@else
<button disabled
class="bg-gray-400 text-white px-6 py-2 rounded">
Vote Closed
</button>
@endif

@else

<form method="POST" action="{{ route('vote',$candidate->id) }}">
@csrf
<button
class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded">
Vote
</button>
</form>

@endif

@endguest

</div>

@endforeach

</div>

</div>

</body>
</html>