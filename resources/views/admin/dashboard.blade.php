@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">
Election Live Results
</h2>

<table class="w-full bg-white rounded shadow">

<thead>
<tr class="bg-gray-200">
<th class="p-3">Candidate</th>
<th class="p-3">Votes</th>
</tr>
</thead>

<tbody id="results"></tbody>

</table>

<script>

function loadResults(){

fetch('/admin/live-results')
.then(res=>res.json())
.then(data=>{

let html='';

data.forEach(row=>{
html+=`
<tr>
<td class="p-3">${row.name}</td>
<td class="p-3">${row.votes_count}</td>
</tr>`;
});

document.getElementById('results').innerHTML=html;

});
}

loadResults();
setInterval(loadResults,3000);

</script>

@endsection