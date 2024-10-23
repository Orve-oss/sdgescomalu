<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Defprix extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',

    ];

    public function clients(){
        return $this->hasMany(Client::class);
    }

    public static function getAllDefprix(){
        return Self::all();
    }

    public static function addDefprix($data){
        $def = new Self();
        $def->nom = $data['nom'];
        $def->save();

    }

    public static function getDefprix($id){

        return Self::find($id);
    }

    public static function updateDefprix($data, $id){
        Self::where('id', $id)->update([
            'nom' => $data['nom'],
        ]);
    }

    public static function deleteDefprix($id){
        Self::find($id)->delete();
    }

}
