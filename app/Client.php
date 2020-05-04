<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Client extends Model
{    
    use SoftDeletes;
    use SoftCascadeTrait;
  
    protected $fillable = [
        'name_client','lastname','address','city','province','postal_code','country','phone_client','email'
    ];  
        
    protected $dates = ['deleted_at'];

    protected $softCascade = ['company']; //indica la relación companies()

    public $timestamps = true;

    public function company()
    {
        return $this->hasOne('App\Company');
    }    

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function scopeAllowed($query)
    {
        if( auth()->user()->can('view', $this))
        {
            return $query;
        }

         return $query->where('client_id', auth()->id());
    }     
    
}
