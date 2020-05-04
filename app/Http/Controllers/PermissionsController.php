<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use DataTables;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', new Permission); 
        
        return view('admin.permissions.index');    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = new Permission();

        $this->authorize('create', $permission);           

        return view('admin.permissions.partials.form', compact('permission'));
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
    public function edit(Permission $permission)
    {
        $this->authorize('update', $permission);

        return view('admin.permissions.partials.form', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                 $this->authorize('update', $permission);

                // Validar el formulario
                $data = $request->validate(['display_name'  => 'required'],
                    [
                        'display_name.required'  => 'El campo nombre es obligatorio.'
                    ]
                );
                
                // Actualizamos el permiso
                $permission->update($data); 

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dataTable()
    {      
        $permissions = Permission::query();
        return dataTables::of($permissions)
                ->addColumn('display_name', function ($permissions){
                    return $permissions->display_name;
                })                   

                ->addColumn('accion', function ($permissions) {
                    return view('admin.permissions.partials._action', [
                        'permissions' => $permissions,

                        'url_edit' => route('admin.permissions.edit', $permissions->id)                  
                    ]);
                })
               
                ->addIndexColumn()   
                ->rawColumns(['display_name', 'accion'])                
                ->make(true);          
    }
}
