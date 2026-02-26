@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">
Live Election Results
</h2>

<!-- Chart -->
<div class="bg-white p-6 rounded shadow mb-8">
<canvas id="voteChart"></canvas>
</div>

<!-- Table -->
<div class="bg-white rounded shadow">
<table class="w-full">

<thead class="bg-gray-200">
<tr>
<th class="p-3">Candidate</th>
<th class="p-3">Votes</th>
</tr>
</thead>

<tbody id="resultTable"></tbody>

</table>
</div>

<script>

let chart;

/**
 * Load Live Results
 */
function loadResults(){

fetch('/admin/live-results')
.then(res=>res.json())
.then(data=>{

let html='';
let labels=[];
let votes=[];

data.forEach(row=>{

html+=`
<tr>
<td class="p-3">${row.name}</td>
<td class="p-3 font-bold">${row.votes_count}</td>
</tr>`;

labels.push(row.name);
votes.push(row.votes_count);

});

document.getElementById('resultTable').innerHTML=html;

/* ---------- GRAPH ---------- */

if(chart){
chart.destroy();
}

chart = new Chart(
document.getElementById('voteChart'),
{
type:'bar',
data:{
labels:labels,
datasets:[{
label:'Votes',
data:votes
}]
}
});

});

}

/* Auto Refresh Every 3 Seconds */
loadResults();
setInterval(loadResults,3000);

</script>

@endsection