<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Job;
use App\Models\Location; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::join('locations', 'jobs.location_id', '=', 'locations.id')
        ->select('jobs.*', 'locations.title as location_title','locations.zip_code as location_zip_code','locations.city as location_city','locations.description_location')
        ->get();
        
        return response()->json(['jobs' => $jobs]);
    }

    public function annonce()
    {
        // Récupérer l'utilisateur authentifié
        $user = Auth::user();
    
        // Vérifier si l'utilisateur est connecté
        if ($user) {
            // Récupérer les jobs associés à l'utilisateur connecté en utilisant la relation définie dans le modèle User
            $jobs = $user->jobs()
                ->join('locations', 'jobs.location_id', '=', 'locations.id')
                ->select('jobs.*','locations.zip_code as location_zip_code','locations.city as location_city', 'locations.description_location')
                ->get();
    
            return response()->json(['jobs' => $jobs]);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // Vérifier si l'utilisateur de l'entreprise est authentifié
    $company = auth()->user();

    // Vérifier si l'entreprise est authentifiée
    if ($company) {
        // Validation des données du formulaire (vous pouvez ajuster selon vos besoins)
        $request->validate([
            'title' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'salary' => 'required',
            'description_job' => 'required',
            'location_id' => 'required',
        ]);

        // Créer un nouvel enregistrement de job avec les données du formulaire
        $job = new Job([
            'company_id' => $company->id, // Utilisation de l'ID de l'utilisateur authentifié
            'location_id' => $request->input('location_id'),
            'title' => $request->input('title'),
            'date_start' => $request->input('date_start'),
            'date_end' => $request->input('date_end'),
            'salary' => $request->input('salary'),
            'description_job' => $request->input('description_job'),
        ]);

        // Enregistrer l'enregistrement dans la base de données
        $job->save();

        return response()->json(['message' => 'Job created successfully']);
    } else {
        // Gérer le cas où l'entreprise n'est pas authentifiée
        return response()->json(['message' => 'Company not authenticated'], 401);
    }
}


    /**
     * Display the specified resource.
     */
    public function show(job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, job $job)
    {

        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Validation des données du formulaire
        $request->validate([
            'title' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'salary' => 'required',
            'description_job' => 'required',
            'location_id' => 'required',
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
    public function destroy(job $job)
    {
        //
    }
}
