<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'name_program','number_program','part_program'
    ]; 
   
    public function piece()
    {
        return $this->hasOne(Piece::class);
    }

//    public function piece()
//    {
//         return $this->belongsTo(Piece::class);
//    }  
}
