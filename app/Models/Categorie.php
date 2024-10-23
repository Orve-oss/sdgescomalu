<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
    ];

    protected $table = 'categories';

    public function produits()
    {
        return $this->hasMany(Produit::class);
    }

    public static function getAllCategories()
    {
        // return Self::all();
        return Self::latest()->get();
    }

    public static function addCategorie($data)
    {
        $categorie = new Self();
        $categorie->libelle = $data['libelle'];
        $categorie->save();
    }

    public static function getCategorie($id)
    {
        return Self::find($id);
    }

    public static function updateCategorie($data, $id)
    {
        Self::where('id', $id)->update([
            'libelle' => $data['libelle'],
        ]);
    }

    public static function deleteCategorie($id)
    {
        Self::find($id)->delete();
    }
}
