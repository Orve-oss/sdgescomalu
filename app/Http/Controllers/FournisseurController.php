<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function liste()
    {
        $fournisseurs = Fournisseur::getAllFournisseurs();

        return response()->json(['fournisseur'=>$fournisseurs]);
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
        $data = $request->validate([
            'rais_soc'=>'required',
            'email'=>'required',
            'telephone'=>'required',
            'adresse'=>'required',
            'Actif'=>'required',
        ]);
        $fournisseur = Fournisseur::addFournisseur($data);
        return response()->json($fournisseur);
    }

    /**
     * Display the specified resource.
     */
    public function show(Fournisseur $fournisseur)
    {
        return response()->json($fournisseur);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {
        $data = $request->validate([
            'rais_soc'=>'required',
            'email'=>'required',
            'telephone'=>'required',
            'Adresse'=>'required',
            'Actif'=>'required',
        ]);
        $fournisseur = Fournisseur::updateFournisseur($data, $fournisseur->id);
        return response()->json($fournisseur);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fournisseur $fournisseur)
    {
        Fournisseur::deleteFournisseur($fournisseur->id);
        return response()->json(['message' => 'Fournisseur supprime avec succes']);
    }
}
