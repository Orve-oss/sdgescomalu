<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getAllClients()
    {
        // return Self::all();
        return Self::latest()->get();
    }

    public static function addClient($data){

        $client = new Self();
        $client->Rais_Soc = $data['Rais_Soc'];
        $client->Contact = $data['Contact'];
        $client->Adresse = $data['Adresse'];
        // $client->Actif = $data['Actif'];
        // $client->created_date = $data['created_date'];
        $client->save();
    }
    public static function getclient($id){

        return Self::find($id);
    }


    public static function updateClient($data){

        $client = Self::find($data['id']);
        $client->Rais_Soc = $data['Rais_Soc'];
        $client->Contact = $data['Contact'];
        $client->Adresse = $data['Adresse'];
        $client->Actif = $data['Actif'];
        $client->created_date = $data['created_date'];
        $client->save();
    }
    public static function deleteClient($id){
        Self::find($id)->delete();
    }
}
