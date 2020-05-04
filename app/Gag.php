<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gag extends Model
{
    protected $fillable = [
        'number_gag','diameter','type_gag','category_gag'
    ];
        
    public function pieces()
    {
        return $this->hasMany(Piece::class);
    }  
}
