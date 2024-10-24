<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valprix extends Model
{
    use HasFactory;

    protected $fillable = [
        'produit_id',
        'defprix_id',
        'pvte',

    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function defprix()
    {
        return $this->belongsTo(Defprix::class);
    }

    public static function getallvalprix()
    {
        return Self::all()->load('produit', 'defprix');
    }

    public static function addvalprix($data)
    {
        $valprix = new Self();
        $valprix->produit_id = $data['produit_id'];
        $valprix->defprix_id = $data['defprix_id'];
        $valprix->pvte = $data['pvte'];
        $valprix->save();
    }

    public static function getvalprix($id)
    {
        return Self::find($id);
    }

    public static function updatevalprix($data, $id)
    {
        Self::where('id', $id)->update([
            'pvte' => $data['pvte'],
        ]);
    }
}
