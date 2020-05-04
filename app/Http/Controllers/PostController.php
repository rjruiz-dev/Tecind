<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use DataTables;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SavePostsRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post(); 
        
        $this->authorize('create', $post);
        
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('admin.posts.partials.form', compact('post', 'categories', 'tags'));     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePostsRequest $request)
    {
        if ($request->ajax()){
            try {
                // utiliza transacciones
                DB::beginTransaction();  
                
                $this->authorize('create', new Post);

                $post = Post::create($request->all());              
                $post->syncTags($request->get('tags')); 

                DB::commit();

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    // public function show(Post $post)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */      

    public function edit($id)
    {
        $post = Post::findOrFail($id);  

        $this->authorize('update', $post); 

        $tags = Tag::all();       
        $categories = Category::all();        
        
        return view('admin.posts.partials.form', compact('post', 'categories', 'tags'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(SavePostsRequest $request, $id)
    {
        if ($request->ajax()){
            try {
                // utiliza transacciones
                DB::beginTransaction();                
                
                $post = Post::findOrFail($id);

                $this->authorize('update', $post);            

                $post->update($request->all());            

                $post->syncTags($request->get('tags'));                            
              
                DB::commit();

            } catch (Exception $e) {
                // anula la transacion
                DB::rollBack();
            }
        }  
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {      
        $post = Post::findOrFail($id);

        $this->authorize('delete', $post);
     
        $post->delete();
    }   
    
    public function dataTable()
    {
        $posts = Post::query()               
        // ->where('user_id', auth()->id())
        ->allowed()
        ->get();   
                     
        return dataTables::of($posts)
                ->addColumn('id', function ($posts){
                    return $posts->id;
                })  
                ->addColumn('titulo', function ($posts){
                    return $posts->title;
                })
                ->addColumn('extracto', function ($posts){
                    return $posts->excerpt;
                })                               
                ->addColumn('accion', function ($posts) {
                    return view('admin.posts.partials._action', [
                        'posts' => $posts,
                        'url_show' => route('posts.show', $posts),
                        'url_edit' => route('admin.posts.edit', $posts->id),                       
                        'url_destroy' => route('admin.posts.destroy', $posts->id)
                    ]);
                })
               
                ->addIndexColumn()   
                ->rawColumns(['titulo', 'extracto', 'accion'])                
                ->make(true);          
    }
}
