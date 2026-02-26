@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">Candidates</h2>

<a href="{{ route('admin.candidates.create') }}"
class="bg-green-600 text-white px-4 py-2 rounded">
Add Candidate
</a>

<table class="w-full mt-4 bg-white shadow rounded">

<tr class="bg-gray-200">
<th>Name</th>
<th>Party</th>
<th>Image</th>
<th>Action</th>
</tr>

@foreach($candidates as $c)
<tr>
<td>{{ $c->name }}</td>
<td>{{ $c->party }}</td>

<td>
@if($c->image)
<img src="{{ asset('storage/'.$c->image) }}" class="w-12">
@endif
</td>


<td class="space-x-2">

<a href="{{ route('admin.candidates.edit',$c->id) }}"
class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>

<form method="POST"
action="{{ route('admin.candidates.destroy',$c->id) }}"
class="inline">
@csrf
@method('DELETE')
<button class="bg-red-500 text-white px-2 py-1 rounded">
Delete
</button>
</form>

</td>
</tr>
@endforeach

</table>

@endsection