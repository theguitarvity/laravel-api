<?php

namespace App\Http\Controllers;
use App\Job;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class JobsController extends Controller
{
    public function index(){
        $jobs = Job::all();
        return response()->json($jobs);
    }
    public function show($id){
        $jobs = Job::with('company')->find($id);
        ///echo 'eae porra';
        if(!$jobs){
            return response()->json([
                'message'=>'Record not found',
            ],404);
        }
        return response()->json($jobs);
    }
    public function store(Request $request){
        $job = new Job();
        $job->fill($request->all());
        $job->save();

        return response()->json($job,201);
        
    }
    public function update(Request $request, $id){
        $job = Job::find($id);
        if(!$job)
            return response()->json(['message'=>'Record not found'],404);
        $job->fill($request->all());
        $job->save();
        return response()->json($job);

        
    }
    public function delete($id){
        $job = Job::find($id);
        if(!$job)
            return response()->json(['message'=>'Record not found'], 404);
        $job->delete();
    }
}
