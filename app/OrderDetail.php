<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['code', 'name', 'quantity', 'description'];

    public $timestamps = true;

   
}
