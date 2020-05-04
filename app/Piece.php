<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Piece extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $fillable = [
        'machine_id', 'program_id', 'gag_id', 'order_id', 'denomination', 'user', 'code', 'part_piece', 'time', 'observation'
    ];
    
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($piece){

            $piece->tools()->detach()->delete();
        });
    }

    public function program()
    {
         return $this->belongsTo(Program::class);
    } 

    public function user()
    {
         return $this->belongsTo(User::class);
    } 
    
    public function gag()
    {
        return $this->belongsTo(Gag::class);
    } 
          
    public function machine()
    {
        return $this->belongsTo(Machine::class);        
    } 

    public function order()
    {
        return $this->belongsTo(Order::class);        
    } 

    public function tools() 
    {        
        return $this->belongsToMany(Tool::class)->withTimestamps();
    }  
       

    // public function times()
    // {
    //     return $this->hasMany(Time::class);
    // }  
   
    public function syncTools($tools)
    {
       $toolsIds = collect($tools)->map(function($tool){
            return Tool::find($tool) ? $tool :Tool::create(['tool' => $tool])->id;
        });                

        return $this->tools()->sync($toolsIds);
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
