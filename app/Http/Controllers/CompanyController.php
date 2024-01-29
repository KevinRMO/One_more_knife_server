<?php

namespace App\Http\Controllers;

use App\Models\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
               'name' => 'required',
               'email' => 'required|email|unique:users',
               'password' => 'required',
           ]);
           if ($validator->fails()) {
               return response()->json([
                   'status' => 'false',
                   'data' => $validator->errors()
               ]);
           }else{
               $user = Company::create([
                   'name' => $request->name,
                   'email' => $request->email,
                   'password' => Hash::make($request->password),
               ]);

               $token = $user->createToken('auth_token')->plainTextToken;
               return response()->json([
                   'status' => 'true',
                   'message'=> 'Utilisateur bien enregistré!',
               ]);
           }
       } catch (\Exception $e) {
           // En cas d'erreur, retour d'une réponse JSON avec un message d'erreur et le code HTTP 500 (Internal Server Error)
           return response()->json([
               'status' => 'false',
               'message' => 'Une erreur s\'est produite lors de l\'enregistrement.',
               'error' => $e->getMessage(),
           ], 500);
       }
    }

    /**
     * Display the specified resource.
     */
    public function show(company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(company $company)
    {
        //
    }
}
