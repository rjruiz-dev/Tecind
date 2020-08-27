<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Order extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    use SoftCascadeTrait;  
    
    protected $fillable = ['client_id', 'user_id', 'statu_id', 'order', 'denomination', 'code', 'reason', 'quantity', 'status', 'date'];

    public $timestamps = true;  

    protected $dates = ['date', 'deleted_at'];
    
    // protected $status = [
    //     'EN PROCESO'    => 'En proceso',
    //     'TERMINADO'     => 'Terminado',
    //     'NO TERMINADO'  => 'No terminado'
    // ];

    public function client()
    {
        return $this->belongsTo('App\Client', 'client_id');
    }   

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    } 

    public function statu()
    {
        return $this->belongsTo('App\Statu', 'statu_id');
    }
    
    public function pieces()
    {
        return $this->hasMany(Piece::class);
    }

    public function times()
    {
        return $this->hasMany(Time::class);
    }     
    
    // public function getStatus()
    // {
    //     return $this->status;
    // } 
    
    public function scopeAllowed($query)
    {
        if( auth()->user()->can('view', $this))
        {
            return $query;
        }

         return $query->where('user_id', auth()->id());
    }

}
