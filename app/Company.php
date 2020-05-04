<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'client_id','name_company','cuit','web','phone_company'
    ]; 

    protected $dates = ['deleted_at'];

    public $timestamps = true;
    
    public function client()
    {
        return $this->belongsTo('App\Client', 'client_id');
    }
    
}
