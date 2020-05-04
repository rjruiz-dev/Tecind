<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $fillable = [
        'user_id', 'machine', 'category_maq'
    ];
     
    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function pieces()
    {
        return $this->hasMany(Piece::class);
    }  

    public function times()
    {
        return $this->hasMany(Time::class);
    }  
}
