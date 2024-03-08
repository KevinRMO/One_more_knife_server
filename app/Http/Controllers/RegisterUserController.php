<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class RegisterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            // Retourner les données de l'utilisateur connecté
            return response()->json(['user' => $user]);
        } else {
            // Retourner un message d'erreur si l'utilisateur n'est pas connecté
            return response()->json(['message' => 'User not authenticated'], 401);
        }
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
    // public function store(Request $request)
    // {
    //     try {
    //         // Validation des données du formulaire
    //         $validator = Validator::make($request->all(), [
    //             'lastname' => 'required',
    //             'firstname' => 'required',
    //             'birth_date' => 'required',
    //             'zip_code' => 'required',
    //             'city' => 'required',
    //             'phone' => 'required',
    //             'cv_path' => 'required|file|mimes:pdf,jpeg,png,jpg',
    //             'email' => 'required|email|unique:users',
    //             'password' => 'required',
    //         ]);
            
    //         // Vérifier si la validation a échoué
    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status' => 'false',
    //                 'data' => $validator->errors()
    //             ]);
    //         }
    
    //         // Stockage du fichier
    //         $cvPath = $request->file('cv_path')->store('cv_files', 'local');
    
    //         // Création de l'utilisateur avec le chemin du CV
    //         $user = User::create([
    //             'lastname' => $request->lastname,
    //             'firstname' => $request->firstname,
    //             'birth_date' => $request->birth_date,
    //             'zip_code' => $request->zip_code,
    //             'city' => $request->city,
    //             'phone' => $request->phone,
    //             'cv_path' => $cvPath,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password),
    //         ]);
    
    //         // Retourner une réponse JSON avec un message de succès
    //         return response()->json([
    //             'status' => 'true',
    //             'message' => 'Utilisateur bien enregistré!',
    //         ]);
    //     } catch (\Exception $e) {
    //         // En cas d'erreur, retourner une réponse JSON avec un message d'erreur et un code d'erreur HTTP 500
    //         return response()->json([
    //             'status' => 'false',
    //             'message' => 'Une erreur s\'est produite lors de l\'enregistrement.',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
    
    public function store(Request $request)
{
    try {
        // Validation des données du formulaire
        $validator = Validator::make($request->all(), [
            'lastname' => 'required',
            'firstname' => 'required',
            'birth_date' => 'required|date',
            'zip_code' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'cv_path' => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048', // Ajout de la taille maximale
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6', // Assurez-vous que le mot de passe soit assez complexe
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Récupération du fichier depuis la requête
        $cvFile = $request->file('cv_path');
        $cvFileName = time() . '_' . $cvFile->getClientOriginalName();
        
        // Créer le répertoire `public/cv_files` s'il n'existe pas
        $cvDirectory = public_path('cv_files');
        if (!file_exists($cvDirectory)) {
            mkdir($cvDirectory, 0777, true);
        }
        
        // Déplacement du fichier vers `public/cv_files`
        $cvFile->move($cvDirectory, $cvFileName);
        
        // Chemin relatif à utiliser pour accéder au fichier via l'URL
        $cvFilePath = 'cv_files/' . $cvFileName;

        // Création de l'utilisateur avec le chemin du CV
        $user = User::create([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'birth_date' => $request->birth_date,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'phone' => $request->phone,
            'cv_path' => $cvFilePath, // Stocke le chemin relatif dans la base de données
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Utilisateur bien enregistré avec CV!',
            'user' => $user,
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
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
    public function update(Request $request)
    {
        // Vérifier si l'utilisateur est authentifié
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        
        // Récupérer l'utilisateur connecté
        $user = auth()->user();
        
        // Validation des données du formulaire
        $request->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'birth_date' => 'required',
            'zip_code' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'cv_path' => 'required',
            'email' => 'required',
        ]);
    
        // Mise à jour des attributs de l'utilisateur avec les données fournies dans la requête
        $user->update([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'birth_date' => $request->birth_date,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'phone' => $request->phone,
            'cv_path' => $request->cv_path,
            'email' => $request->email,
        ]);
    
        // Retour d'une réponse JSON indiquant que la mise à jour a été effectuée avec succès
        return response()->json(['message' => 'User updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
