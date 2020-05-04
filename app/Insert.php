<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insert extends Model
{
    protected $fillable = [
        'code_insert', 'quality', 'type', 'category', 'status', 'description', 'reason'
    ];

    // public function tool()
    // {
    //     return $this->belongsTo(Tool::class);
    // } 

    public function tools()
    {
        return $this->hasMany(Tool::class);
    }
}
