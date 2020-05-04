<?php

namespace App\Http\Controllers;

use DataTables;
use App\User;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

class UserRestoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.restore');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function restore($id)
    {
        $user = User::withTrashed()->where('id',$id)->first();
        $user->restore();      
        
        // $this->authorize('delete', $client);         
    }    

    public function dataTable()
    {
       $usuarios = User::onlyTrashed()->get()->map(function ($user) {
            // $user->deleted_user = $user->orders()->withTrashed()->first();
            return $user;
        });        
               
        return dataTables::of($usuarios)
                ->addColumn('id', function ($usuarios){
                    return$usuarios->id;
                })  
              
                ->addColumn('usuario', function ($usuarios){
                    return 
                            '<i class="fa fa-user"></i>'.' '.$usuarios->name."<br>".
                            '<i class="fa fa-envelope"></i>'.' '.$usuarios->email."<br>";
                })

                ->addColumn('rol', function ($usuarios){
                    return $usuarios->roles->implode('name', ', ');
                })               
                
                ->addColumn('deleted_at', function ($usuarios){
                    return$usuarios->deleted_at->format('d-m-y');
                })

                ->addColumn('accion', function ($usuarios) {
                    return view('admin.users.partials._action_restore', [
                        'usuarios' =>$usuarios,
                        'url_restore' => route('admin.users.restore',$usuarios->id)
                        
                    ]);
                })                  
               
                ->addIndexColumn()   
                ->rawColumns(['usuario', 'rol', 'deleted_at', 'accion'])                
                ->make(true);          
    }
}
