<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Time extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $fillable = [
        'order_id', 'machine_id', 'denomination', 'code', 'user', 'date', 'quantity', 'preparation_time', 'machining_time', 'observation'
    ];

    protected $dates = ['date'];

//     public function piece()
//     {
//          return $this->belongsTo(Piece::class);
//     } 

    public function user()
    {
         return $this->belongsTo(User::class);
    }
    
    public function order()
    {
         return $this->belongsTo(Order::class);
    }

    public function machine()
    {
         return $this->belongsTo(Machine::class);
    }

    public function scopeAllowed($query)
    {
        if( auth()->user()->can('view', $this))
        {
            return $query;
        }

         return $query->where('user_id', auth()->id());
    }
    
}
