<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::getAllProduits();

        if ($produits->isEmpty()) {
            return response()->json(['message' => 'Aucun produit trouve'], 201);
        }

        return response()->json($produits);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getProduitByCategorie($catId)
    {
        $produits = Produit::getProduitsByCategorie($catId);
        if ($produits->isEmpty()) {
            return response()->json(['message' => 'Aucun produit trouve'], 201);
        }
        return response()->json(['produits' => $produits]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function add(Request $request)
    {
        $data = $request->validate([
            'designation'=>'required',

            'Actif'=>'nullable',
            'fournisseur_id'=>'required',
            'categorie_id'=>'required',
        ]);
        Produit::addProduit($data);
        return response()->json(['message' => 'Produit ajoute avec succes']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produit = Produit::getProduit($id);
        return response()->json(['Produit'=> $produit]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function change(Request $request, $id)
    {
        $data = $request->validate([
            'designation'=>'nullable',

            'Actif'=>'nullable',
            'fournisseur_id'=>'nullable',
            'categorie_id'=>'nullable',
        ]);
        Produit::updateProduit($data, $id);
        return response()->json(['message' => 'Produit modifie avec succes']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Produit::deleteProduit($id);
        return response()->json(['message' => 'Produit supprime avec succes']);
    }
}
