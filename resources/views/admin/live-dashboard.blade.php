@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">
📊 Live Election Results
</h2>

<!-- ================= CHART ================= -->
<div class="bg-white p-6 rounded shadow mb-8">
    <canvas id="voteChart"></canvas>
</div>


<!-- ================= RESULT TABLE ================= -->
<div class="bg-white rounded shadow">
<table class="w-full">

<thead class="bg-gray-200">
<tr>
<th class="p-3">Candidate</th>
<th class="p-3">Votes</th>
<th class="p-3">Action</th>
</tr>
</thead>

<tbody id="resultTable"></tbody>

</table>
</div>


<!-- ================= MODAL ================= -->
<div id="voterModal"
class="fixed inset-0 bg-black/50 hidden justify-center items-center">

<div class="bg-white w-3/4 rounded-lg p-6">

<h3 class="text-xl font-bold mb-4">
Voted Users
</h3>

<table class="w-full">
<thead>
<tr class="bg-gray-100">
<th class="p-2">User</th>
<th class="p-2">Candidate</th>
<th class="p-2">Voted Time</th>
</tr>
</thead>

<tbody id="voterDetails"></tbody>
</table>

<button onclick="closeModal()"
class="mt-4 bg-red-500 text-white px-4 py-2 rounded">
Close
</button>

</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

/*
|--------------------------------------------------------------------------
| Laravel Named Routes (Professional Way)
|--------------------------------------------------------------------------
*/

const routes = {
    liveResults: "{{ route('admin.live.results') }}",
    voters: "{{ route('admin.candidate.voters', ':id') }}"
};

let chart;


/* ================= LIVE RESULTS ================= */

function loadResults(){

fetch(routes.liveResults)
.then(res => res.json())
.then(data => {

let html='';
let labels=[];
let votes=[];

data.forEach(row=>{

html+=`
<tr>
<td class="p-3">${row.name}</td>
<td class="p-3 font-bold">${row.votes_count}</td>
<td class="p-3">
<button onclick="viewVoters(${row.id})"
class="bg-blue-500 text-white px-3 py-1 rounded">
View
</button>
</td>
</tr>`;

labels.push(row.name);
votes.push(row.votes_count);

});

document.getElementById('resultTable').innerHTML=html;


/* ===== GRAPH ===== */

if(chart) chart.destroy();

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


/* ================= VIEW VOTERS ================= */

function viewVoters(id){

let url = routes.voters.replace(':id', id);

fetch(url)
.then(res=>res.json())
.then(data=>{

let html='';

data.forEach(vote=>{

html+=`
<tr>
<td class="p-2">${vote.user.name}</td>
<td class="p-2">${vote.candidate.name}</td>
<td class="p-2">${vote.created_at}</td>
</tr>`;

});

document.getElementById('voterDetails').innerHTML=html;

document.getElementById('voterModal')
.classList.remove('hidden');

});

}


/* ================= CLOSE MODAL ================= */

function closeModal(){
document.getElementById('voterModal')
.classList.add('hidden');
}


/* ================= AUTO REFRESH ================= */

loadResults();
setInterval(loadResults,3000);

</script>

@endsection