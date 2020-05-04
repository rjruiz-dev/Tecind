<?php

namespace App\Http\Controllers;

use App\Post;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function store(Post $post)
    {        
        $this->validate(request(),[
            // jpg, png, bmp, gif, o svg            
            'photo' => 'required|image|max:2048' 
        ]);

        $photo = request()->file('photo')->store('public');

        Photo::create([
            'url' => Storage::url($photo),
            'post_id' => $post->id
        ]);       
    }

    public function destroy(Photo $photo)
    {         
        $photo->delete();    
        
        $photoPath = str_replace('storage', 'public', $photo->url);

        Storage::delete($photoPath);        
    }

    // public function store(Post $post)
    // {        
    //     $this->validate(request(),[
    //         // jpg, png, bmp, gif, o svg            
    //         'photo' => 'required|image|max:2048' 
    //     ]);

    //     $post->photos()->create([      
    //         'url' => request()->file('photo')->store('posts','public'),
    //     ]);
    // }

    // public function destroy(Photo $photo)
    // {         
    //     $photo->delete();

    //     $photoPath = str_replace('storage', 'public', $photo->url);

    //     Storage::delete($photoPath);        
    // }

    
    
}
