<?php

namespace App\Http\Controllers;

use App\Models\Defprix;
use Illuminate\Http\Request;

class DefprixController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function liste()
    {
        $defprix = Defprix::getAllDefprix();
        return response()->json($defprix);
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
    public function ajout(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required'
        ]);
        Defprix::addDefprix($data);
        return response()->json(['message' => 'Defprix ajoute avec succes']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $defprix = Defprix::getDefprix($id);
        return response()->json(['defprix' => $defprix]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Defprix $defprix)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatedefprix(Request $request, $id)
    {
        Defprix::updateDefprix($request->all(), $id);
        return response()->json(['message' => 'Defprix modifie avec succes']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletedefprix($id)
    {
        Defprix::deleteDefprix($id);
        return response()->json(['message' => 'Defprix supprime avec succes']);
    }
}
