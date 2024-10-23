<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',

    ];

    protected $table = 'produits';

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    public static function getAllProduits()
    {
        return Self::all()->load('fournisseur', 'categorie');
        // ->with('fournisseur', 'categorie');
        // return Self::latest()->get();
    }

    public static function addProduit($data)
    {
        $produit = new Self();
        $produit->designation = $data['designation'];

        $produit->Actif = $data['Actif'];
        $produit->fournisseur_id = $data['fournisseur_id'];
        $produit->categorie_id = $data['categorie_id'];
        $produit->save();
    }

    public static function getProduitsByCategorie($catId)
    {
        return Self::where('categorie_id', $catId)->get();
    }

    public static function getProduit($id)
    {
        return Self::find($id);
    }

    public static function updateProduit($data, $id)
    {
        Self::where('id', $id)->update([
            'designation' => $data['designation'],

            'Actif' => $data['Actif'],
            'fournisseur_id' => $data['fournisseur_id'],
            'categorie_id' => $data['categorie_id'],
        ]);
    }

    public static function deleteProduit($id)
    {
        Self::find($id)->delete();
    }


}
