<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    // Récupérer l'utilisateur authentifié
    $user = Auth::user();

    // Vérifier si l'utilisateur est connecté
    if ($user) {
        // Récupérer les emplacements associés à l'utilisateur connecté en utilisant la relation définie dans le modèle User
        $locations = $user->locations()->get();

        return response()->json(['locations' => $locations]);
    } else {
        // Gérer le cas où aucun utilisateur n'est connecté
        return response()->json(['message' => 'User not authenticated'], 401);
    }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Vérifier si l'utilisateur de l'entreprise est authentifié
        $company = auth()->user();
    
        if ($company) {
            $request->validate([
                'title' => 'required',
                'zip_code' => 'required',
                'city' => 'required',
                'description_location' => 'required',
            ]);
    
            // Créer un nouvel enregistrement de location avec les données du formulaire
            $location = new Location([
                'company_id' => $company->id,
                'title' => $request->input('title'),
                'zip_code' => $request->input('zip_code'),
                'city' => $request->input('city'),
                'description_location' => $request->input('description_location'),
            ]);
    
            // Enregistrer l'enregistrement dans la base de données
            $location->save();
    
            return response()->json(['message' => 'Location created successfully']);
        } else {
            // Gérer le cas où l'entreprise n'est pas authentifiée
            return response()->json(['message' => 'Company not authenticated'], 401);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Validation des données du formulaire
        $request->validate([
            'title' => 'required',
            'zip_code' => 'required',
            'city' => 'required',
            'description_location' => 'required',
        ]);

        // Recherche de la location à mettre à jour par son identifiant
        $location = Location::find($id);
    
        // Vérification si la location existe
        if (!$location) {
            return response()->json(['message' => 'Location not found'], 404);
        }
    
        // Mise à jour des attributs de la location avec les données fournies dans la requête
        $location->update([
            'title' => $request->title,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'description_location' => $request->description_location,
        ]);
    
        // Retour d'une réponse JSON indiquant que la mise à jour a été effectuée avec succès
        return response()->json(['message' => 'Location updated successfully']);
    }
    
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Recherche de la location à supprimer par son identifiant
        $location = Location::find($id);

        // Vérifier si la location existe
        if (!$location) {
            return response()->json(['message' => 'Location not found'], 404);
        }
        
        // Supprimer la location de la base de données
        $location->delete();
        
        // Retourner une réponse JSON indiquant que la suppression a été effectuée avec succès
        return response()->json(['message' => 'Location deleted successfully']);
    }
}
