<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class RegisterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**²²
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
                'lastname' => 'required',
                'firstname' => 'required',
                'birth_date' => 'required',
                'zip_code' => 'required',
                'city' => 'required',
                'phone' => 'required',
                'cv_path' => 'required|file|mimes:pdf',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'false',
                    'data' => $validator->errors()
                ]);
            }else{
                $user = User::create([
                    'lastname' => $request->lastname,
                    'firstname' => $request->firstname,
                    'birth_date' => $request->birth_date,
                    'zip_code' => $request->zip_code,
                    'city' => $request->city,
                    'phone' => $request->phone,
                    'cv_path' => $request->cv_path,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
