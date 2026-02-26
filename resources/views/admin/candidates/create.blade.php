@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">
{{ isset($candidate)?'Edit':'Add' }} Candidate
</h2>

<form method="POST"
action="{{ isset($candidate)
? route('admin.candidates.update',$candidate->id)
: route('admin.candidates.store') }}"
enctype="multipart/form-data"
class="bg-white p-6 rounded shadow w-1/2">

@csrf
@if(isset($candidate)) @method('PUT') @endif

<input type="text" name="name"
value="{{ $candidate->name ?? '' }}"
placeholder="Candidate Name"
class="border p-2 w-full mb-3" required>

<input type="text" name="party"
value="{{ $candidate->party ?? '' }}"
placeholder="Party"
class="border p-2 w-full mb-3" required>

<input type="file" name="image"
class="border p-2 w-full mb-3">

@if(isset($candidate) && $candidate->image)
<img src="{{ asset('storage/'.$candidate->image) }}"
class="w-24 mb-3">
@endif

<button class="bg-blue-600 text-white px-4 py-2 rounded">
Save
</button>

</form>

@endsection