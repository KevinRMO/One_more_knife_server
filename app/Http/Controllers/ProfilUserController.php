<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth; 
// use App\Models\User;

// class ProfilUserController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         $user = Auth::user();

//         if ($user) {
//             // Retourner les données de l'utilisateur connecté
//             return response()->json(['user' => $user]);
//         } else {
//             // Retourner un message d'erreur si l'utilisateur n'est pas connecté
//             return response()->json(['message' => 'User not authenticated'], 401);
//         }
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         //
//     }

//     /**
//      * Display the specified resource.
//      */
//     // public function show()
//     // {
//     //     // Récupérer l'utilisateur authentifié
//     //     $user = Auth::user();

//     //     // Vérifier si l'utilisateur est connecté
//     //     if ($user) {
//     //         // Retourner la vue du profil de l'utilisateur avec les données
//     //         return view('profil', ['user' => $user]);
//     //     } else {
//     //         // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
//     //         return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder à votre profil.');
//     //     }
//     // }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(string $id)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request)
//     {
//         // Vérifier si l'utilisateur est authentifié
//         if (!auth()->check()) {
//             return response()->json(['message' => 'Unauthorized'], 401);
//         }
        
//         // Récupérer l'utilisateur connecté
//         $user = auth()->user();
        
//         // Validation des données du formulaire
//         $request->validate([
//             'lastname' => 'required',
//             'firstname' => 'required',
//             'birth_date' => 'required',
//             'zip_code' => 'required',
//             'city' => 'required',
//             'phone' => 'required',
//             'cv_path' => 'required',
//             'email' => 'required',
//         ]);
    
//         // Mise à jour des attributs de l'utilisateur avec les données fournies dans la requête
//         $user->update([
//             'lastname' => $request->lastname,
//             'firstname' => $request->firstname,
//             'birth_date' => $request->birth_date,
//             'zip_code' => $request->zip_code,
//             'city' => $request->city,
//             'phone' => $request->phone,
//             'cv_path' => $request->cv_path,
//             'email' => $request->email,
//         ]);
    
//         // Retour d'une réponse JSON indiquant que la mise à jour a été effectuée avec succès
//         return response()->json(['message' => 'User updated successfully']);
//     }
    

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         //
//     }
// }
