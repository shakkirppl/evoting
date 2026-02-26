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

<form id="deleteForm{{ $c->id }}"
method="POST"
action="{{ route('admin.candidates.destroy',$c->id) }}"
class="inline">

@csrf
@method('DELETE')

<button type="button"
onclick="confirmDelete('deleteForm{{ $c->id }}','{{ $c->name }}')"
class="bg-red-500 text-white px-2 py-1 rounded">
Delete
</button>

</form>

</td>
</tr>
@endforeach

</table>
<!-- ================= DELETE CONFIRM MODAL ================= -->

<div id="deleteModal"
class="fixed inset-0 bg-black/50 hidden
flex items-center justify-center z-50">

<div class="bg-white rounded-lg p-6 w-96 text-center">

<h3 class="text-lg font-bold mb-3 text-red-600">
Delete Candidate
</h3>

<p id="deleteText" class="mb-6"></p>

<div class="flex justify-center gap-4">

<button onclick="submitDelete()"
class="bg-red-600 text-white px-4 py-2 rounded">
Yes Delete
</button>

<button onclick="closeDelete()"
class="bg-gray-400 text-white px-4 py-2 rounded">
Cancel
</button>

</div>

</div>
</div>
@endsection
<script>

let deleteFormId = null;

/*
|--------------------------------------------------------------------------
| Open Delete Confirmation
|--------------------------------------------------------------------------
*/

function confirmDelete(formId, name)
{
    deleteFormId = formId;

    document.getElementById('deleteText')
        .innerHTML =
        "Are you sure you want to delete <b>" + name + "</b>?";

    document.getElementById('deleteModal')
        .classList.remove('hidden');
}

/*
|--------------------------------------------------------------------------
| Submit Delete
|--------------------------------------------------------------------------
*/

function submitDelete()
{
    if(deleteFormId){
        document.getElementById(deleteFormId).submit();
    }
}

/*
|--------------------------------------------------------------------------
| Close Modal
|--------------------------------------------------------------------------
*/

function closeDelete()
{
    document.getElementById('deleteModal')
        .classList.add('hidden');
}

</script>