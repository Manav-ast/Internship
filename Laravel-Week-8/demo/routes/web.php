<?php

use App\Models\Job;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


//Index Route
Route::get('/jobs', function (){

    $jobs = Job::with('employer')->latest()->simplePaginate(3); 

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

//Create a new Job
Route::get('/jobs/create', function(){
    return view('jobs.create');
});

//Show a Job
Route::get('/jobs/{id}', function ($id){
    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});

//Store a new job
Route::post('/jobs', function(){

    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => '1',
    ]);

    return redirect('/jobs');
});

//edit a job
Route::get('/jobs/{id}/edit', function(){
    $job = Job::find(request('id'));
    return view('jobs.edit', ['job' => $job]);
});

//Update a Job
Route::patch('/jobs/{id}', function ($id){
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    $job = Job::findOrFail($id);

    $job->update([
        'title' => request('title'),
        'salary' => request('salary')
    ]);

    return redirect('/jobs/'. $job->id);
});

//Delete a Job
Route::delete('/jobs/{id}', function ($id){
    Job::findOrFail($id)->delete();
    return redirect('/jobs');
});
Route::get('/contact', function () {
    return view('contact');
});
