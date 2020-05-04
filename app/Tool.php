<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = ['tool'];   

    // public function inserts()
    // {
    //     return $this->hasMany(Insert::class);
    // }  
    
    // public function insert()
    // {
    //     return $this->belongsTo(Insert::class);
    // } 
    
    public function pieces()
    {
        return $this->belongsToMany(Piece::class)->withTimestamps();
    }
}

