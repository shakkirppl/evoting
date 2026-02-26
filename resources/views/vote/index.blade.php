@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-6">
Select Candidate
</h2>

<form method="POST" action="/vote">
@csrf

<div class="grid md:grid-cols-3 gap-6">

@foreach($candidates as $candidate)

<label class="bg-white p-6 rounded shadow cursor-pointer">

<input type="radio"
name="candidate_id"
value="{{$candidate->id}}"
required>

<h3 class="font-bold text-lg mt-2">
{{$candidate->name}}
</h3>

<p class="text-gray-500">
{{$candidate->party}}
</p>

</label>

@endforeach

</div>

<button
class="mt-6 bg-green-600 text-white px-8 py-3 rounded">
Submit Vote
</button>

</form>

@endsection