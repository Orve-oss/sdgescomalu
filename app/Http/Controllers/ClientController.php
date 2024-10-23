<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::getAllClients();

        return response()->json($clients);
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
            'Rais_Soc'=>'required',
            'Contact'=>'required',
            'Adresse'=>'required',
            'Actif'=>'nullable',
            'created_date'=>'nullable',
        ]);

        $client = Client::addClient($data);
        return response()->json($client);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $client = Client::getclient($id);
        return response()->json(['client'=>$client]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Rais_Soc' => 'required|string'
        ]);

        Client::updateClient($request, $id);
        return response()->json(['message' => 'Client modifie avec succes']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Client::deleteClient($id);
        return response()->json(['message' => 'Client supprime avec succes']);

    }
}
