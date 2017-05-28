<?php

namespace App\Http\Controllers;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompaniesController extends Controller
{
    public function index(){
        $companies = Company::all();
        return response()->json($companies);
    }
    public function show($id){
        $company = Company::find($id);
        if(!$company){
            return response()->json([
                'message' => 'Record not found'
            ],404);
        }
        return response()->json($company);

    }
    public function store(Request $request){
        $company = new Company();
        $company->fill($request->all());
        $company->save();

        return response()->json($company, 201);
    }
    public function update(Request $request, $id){
        $companies = Company::find($id);
        if(!$companies)
            return response()->json(['message'=>'Record not found'],404);
        $companies->fill($request->all());
        $companies->save();
        return response()->json($companies);

    }
    public function destroy($id){
        $company = Company::find($id);
        if(!$company)
            return response()->json(['message'=>'Record not  found'],404);
        $company->delete();    
    }
}
