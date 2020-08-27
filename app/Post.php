<?php

namespace App;

use App\Tag;
use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Post extends Model
{  
    use SoftDeletes;
    use SoftCascadeTrait;  

    protected $fillable = ['user_id', 'category_id', 'title', 'body', 'iframe', 'excerpt', 'published_at'];
 
    protected $dates = ['published_at', 'deleted_at']; 
    
    protected $appends = ['published_date']; 
   
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($post){

            $post->tags()->detach();
            $post->photos->each->delete();       

        });
    }
   
    public function getRouteKeyName()
    {
        return 'url';
    }
   
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished($query)
    {
        $query->with(['category', 'tags', 'owner', 'photos']) 
            ->whereNotNull('published_at')
            ->where('published_at', '<=', Carbon::now())
            ->latest('published_at');
    }

    public function scopeAllowed($query)
    {
        if(auth()->user()->can('view', $this))
        {
            return $query;
        }

        return $query->where('user_id', auth()->id());

    }   

    public function scopeByYearAndMonth($query)
    {
        return $query->selectRaw('year(published_at) year')
                    ->selectRaw('month(published_at) month')
                    ->selectRaw('monthname(published_at) monthname')
                    ->selectRaw('count(*) posts')
                    ->groupBy('year', 'month', 'monthname')
                    ->orderBy('published_at');            
    }

    public function scopeTitle($query, $title)
    {
        if(trim($title) != "")
        {
            $query->where('title', "LIKE", "%$title%");
        }
        
    }
    
    public function isPublished()
    {
        return ! is_null($this->published_at) && $this->published_at < today();
    }

    public function setPublishedAtAttribute($published_at)
    {
        $this->attributes['published_at'] = $published_at ? Carbon::parse($published_at) : null;
    }

    public function setCategoryIdAttribute($category)
    {
        $this->attributes['category_id'] = Category::find($category)
                            ? $category
                            : Category::create(['name' => $category])->id;
    }

    public function syncTags($tags)
    {
       $tagsIds = collect($tags)->map(function($tag){
            return  Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });                

        return $this->tags()->sync($tagsIds);
    }

    public static function create(array $attributes = [])
    {
        $attributes['user_id'] = auth()->id();

        $post = static::query()->create($attributes);

        $post->generateUrl();      

        return $post;
    }

    public function generateUrl()
    {
        $url = str_slug($this->title);

        if($this->whereUrl($url)->exists())
        {
            $url = "{$url}-{$this->id}";
        }
        
        $this->url = $url;

        $this->save();
    }

    public function getPublishedDateAttribute()
    {
        return optional($this->published_at)->format('M d');
    }

    public function viewType($home = '')
    {
       if($this->photos->count() === 1):
           return 'blog.photo';
       elseif($this->photos->count() > 1):
           return  $home === 'home' ? 'blog.carousel-preview' : 'blog.carousel';
       elseif($this->iframe):
           return 'blog.iframe';
       else:
            return 'blog.text';
       endif;
    }

    // public function setTitleAttribute($title)
    // {
    //     $this->attributes['title'] = $title;

    //     $originalUrl =  $url = str_slug($title);
    //     $count = 1;

    //     while( Post::where('url', $url)->exists() )
    //     {
    //         $url = "{$originalUrl}-" . ++$count;
    //     }

    //     $this->attributes['url'] = $url;
    // }

    // public function setTitleAttribute($title)
    // {
    //     $this->attributes['title'] = $title;

    //     $url = str_slug($title);

    //     $duplicateUrlCount = Post::where('url', 'LIKE', "{$url}%")->count();

    //     if( $duplicateUrlCount )
    //     {
    //         $url .= "-" . ++$duplicateUrlCount;
    //     }

    //     $this->attributes['url'] = $url;
    // }

}
