<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'rais_soc',
        'telephone',
        'Actif',
        'defprix_id',

    ];


    public function defprix()
    {
        return $this->belongsTo(Defprix::class);
    }

    public static function getAllFournisseurs()
    {
        return Self::all();
    }

    public static function addFournisseur($data)
    {
        $fournisseur = new Self();
        $fournisseur->rais_soc = $data['rais_soc'];
        $fournisseur->adresse = $data['adresse'];
        $fournisseur->email = $data['email'];
        $fournisseur->telephone = $data['telephone'];
        $fournisseur->Actif = $data['Actif'];
        $fournisseur->defprix_id = $data['defprix_id'];
        $fournisseur->save();
    }

    public static function getFournisseur($id)
    {
        return Self::find($id);
    }

    public static function updateFournisseur($data, $id)
    {
        Self::where('id', $id)->update([
            'rais_soc' => $data['rais_soc'],
            'adresse' => $data['adresse'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'Actif' => $data['Actif'],
            'defprix_id' => $data['defprix_id'],
        ]);
    }

    public static function deleteFournisseur($id)
    {
        Self::find($id)->delete();
    }
}
