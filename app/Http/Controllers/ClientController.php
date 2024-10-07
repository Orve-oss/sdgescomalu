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

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
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
        if ($request->has('Actif') && empty($request->get('Actif'))) {
            $data['Actif'] = 1;
        }
        if ($request->has('created_date') && empty($request->get('created_date'))) {
            $data['created_date'] = now();
        }
        Client::addClient($data);
        return redirect('/clients')->with('success', 'Client created successfully');

        // return response()->json([
        //     'message' => 'Client created successfully',
        //     'data' => $data
        // ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client=Client::getclient($id);
        return view('clients.edit',compact('client'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'Rais_Soc'=>'required',
            'Contact'=>'required',
            'Adresse'=>'required',
            'created_date'=>'required',
        ]);
        $client = Client::find($request->id);
        $client->Rais_Soc = $request->Rais_Soc;
        $client->Contact = $request->Contact;
        $client->Adresse = $request->Adresse;
        $client->created_date = $request->created_date;
        $client->update();
        // $data = $request->validate([
        //     'Rais_Soc'=>'nullable',
        //     'Contact'=>'nullable',
        //     'Adresse'=>'nullable',

        // ]);
        // $data['id'] = $client->id;

        // Client::updateClient($data);
        return redirect('/clients');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        // Client::deleteClient($id);
        return redirect('/clients');
        // return response()->json(['message' => 'Client deleted successfully']);
    }
}
