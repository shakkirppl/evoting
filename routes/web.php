<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\ElectionController;
use App\Http\Controllers\Admin\LiveDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

 Route::get('/',[VoteController::class,'index']);
Route::post('/vote/{id}',[VoteController::class,'vote'])
        ->name('vote');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::prefix('admin')
    ->middleware(['auth','admin'])
    ->name('admin.')
    ->group(function () {

Route::get('/dashboard',
DashboardController::class.'@index');
 Route::resource('candidates', CandidateController::class);
   Route::post('election-toggle',
        [ElectionController::class,'toggle']
    )->name('election.toggle');

     Route::get('/live-dashboard',
        [LiveDashboardController::class,'index'])
        ->name('live.dashboard');

    Route::get('/live-results',
        [LiveDashboardController::class,'liveResults'])->name('live.results');;

        Route::get('/candidate-voters/{id}',
    [LiveDashboardController::class,'candidateVoters'])->name('candidate.voters');;

});

require __DIR__.'/auth.php';
