<?php

namespace App\Http\Controllers;

use App\Models\Valprix;
use Illuminate\Http\Request;

class ValprixController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        $valprix = Valprix::getallvalprix();
        return response()->json(['valprix' => $valprix]);
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
    public function add(Request $request)
    {
        $data = $request->validate([
            'produit_id'=>'required',
            'defprix_id'=>'required',
            'pvte'=>'required',
        ]);
        Valprix::addvalprix($data);
        return response()->json(['message' => 'prix ajoute avec succes']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $valprix = Valprix::getvalprix($id);
        return response()->json(['valprix' => $valprix]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Valprix $valprix)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function change(Request $request, $id)
    {
        $data = $request->validate([

            'pvte'=>'required',
        ]);
        Valprix::updatevalprix($data, $id);
        return response()->json(['message' => 'prix modifie avec succes']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Valprix $valprix)
    {
        //
    }
}
