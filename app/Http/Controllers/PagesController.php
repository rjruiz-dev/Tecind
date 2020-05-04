<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Category;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function spa()
    {
        return view('pages.spa');
    }

    public function home()
    {
        $query = Post::published();
       
        // $query = Post::with(['category', 'tags', 'owner', 'photos'])->published();

        if(request('month'))
        {
            $query->whereMonth('published_at', request('month'));
        }

        if(request('year'))
        {
            $query->whereYear('published_at', request('year'));
        }     

        $posts = $query->paginate();

        if(request()->wantsJson())
        {
            return $posts;
        }

        return view('pages.home', compact('posts'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function archive()
    {
        // Agrupar post por año y por mes
        // $archive = Post::published()->byYearAndMonth()->get();

        $data = [            
            'authors'       => User::latest()->take(4)->get(),
            'categories'    => Category::take(7)->get(),
            'posts'         => Post::latest('published_at')->take(4)->get(),
            'archive'       => Post::selectRaw('year(published_at) year')
                ->selectRaw('month(published_at) month')
                ->selectRaw('monthname(published_at) monthname')
                ->selectRaw('count(*) posts')
                ->groupBy('year', 'month', 'monthname')
                ->orderBy('published_at')
                ->get()
        ];

        if(request()->wantsJson())
        {
            return $data;
        }
        
        return view('pages.archive', $data);
    }

    public function contact()
    {
        return view('pages.contact');
    }    

    public function search(Request $request)
    {
        $posts = Post::title($request->get('title'))->published()->paginate();

        return view('pages.home', compact('posts'));                 
    } 
}
