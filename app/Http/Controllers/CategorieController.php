<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::getAllCategories();
        return response()->json(['categorie'=> $categories]);
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
            'libelle'=>'required',
        ]);
        Categorie::addCategorie($data);
        return response()->json(['message' => 'Categorie ajoute avec succes']);
        // return response()->json(['categorie'=> $categorie]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        return response()->json($categorie);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {
        $data = $request->validate([
            'libelle'=>'required',
        ]);
        $categorie = Categorie::updateCategorie($data, $categorie->id);
        return response()->json($categorie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Categorie::deleteCategorie($id);
        return response()->json(['message' => 'Categorie supprime avec succes']);
    }
}
