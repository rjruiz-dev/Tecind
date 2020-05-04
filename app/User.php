<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable 
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    use SoftCascadeTrait;  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 
    ];   

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];
    
    protected $softCascade = ['posts','orders']; 

    public function posts()
    {
        return $this->hasMany(Post::class);
    } 

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function pieces()
    {
        return $this->hasMany(Piece::class);
    } 
     
    public function machine()
    {
        return $this->hasOne(Machine::class);
    }

    public function times()
    {
        return $this->hasMany(Time::class);
    }  
    
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function scopeAllowed($query)
    {
        if( auth()->user()->can('view', $this))
        {
            return $query;
        }

         return $query->where('id', auth()->id());
    }

    public function getRoleDisplayNames()
    {
        return $this->roles->pluck('display_name')->implode(', ');
    }  
    
    public function scopeNotRole(Builder $query, $roles, $guard = null): Builder 
    { 
         if ($roles instanceof Collection) { 
             $roles = $roles->all(); 
         } 
  
         if (! is_array($roles)) { 
             $roles = [$roles]; 
         } 
  
         $roles = array_map(function ($role) use ($guard) { 
             if ($role instanceof Role) { 
                 return $role; 
             } 
  
             $method = is_numeric($role) ? 'findById' : 'findByName'; 
             $guard = $guard ?: $this->getDefaultGuardName(); 
  
             return $this->getRoleClass()->{$method}($role, $guard); 
         }, $roles); 
  
         return $query->whereHas('roles', function ($query) use ($roles) { 
             $query->where(function ($query) use ($roles) { 
                 foreach ($roles as $role) { 
                     $query->where(config('permission.table_names.roles').'.id', '!=' , $role->id); 
                 } 
             }); 
         }); 
    }
    
}
