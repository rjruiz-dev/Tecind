<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SaveRoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use DataTables;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', new Role);   

        return view('admin.roles.index');        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role();

        $this->authorize('create', $role);
        
        $permissions = Permission::pluck('name', 'id');         

        return view('admin.roles.partials.form', compact('role', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRoleRequest $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                $this->authorize('create', new Role);

                // $this->authorize('create', new User);

                // Validar el formulario
                // $data = $request->validate([
                //     'name'          => 'required|unique:roles',
                //     'display_name'  => 'required'                                
                // ],[
                //     'name.required'         => 'El campo identificador es obligatorio.',
                //     'name.unique'           => 'Este identificador ya ha sido registrado.',
                //     'display_name.required' => 'El campo nombre es obligatorio.'
                // ]);
                
                // Creamos el rol
                $role = Role::create($request->validated());                

               // Asignamos los permisos
               if ($request->has('permissions'))
               {
                   $role->givePermissionTo($request->permissions);
               } 
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {   
        $this->authorize('update', $role);
        
        $permissions = Permission::pluck('name', 'id'); 

        return view('admin.roles.partials.form', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveRoleRequest $request, Role $role)
    {       
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                $this->authorize('update', $role);

                // $this->authorize('create', new User);

                // Validar el formulario
                // $data = $request->validate(['display_name'  => 'required'],
                //     [
                //         'display_name.required'  => 'El campo nombre es obligatorio.'
                //     ]
                // );
                
                // Actualizamos el rol
                $role->update($request->validated()); 

                // Quitamos los permisos
                $role->permissions()->detach(); 

               // Actualizamos los permisos
               if ($request->has('permissions'))
               {
                   $role->givePermissionTo($request->permissions);
               } 
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
    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        $role->delete();
    }

    public function dataTable()
    {      
        $roles = Role::query();
        return dataTables::of($roles)
                ->addColumn('display_name', function ($roles){
                    return $roles->display_name;
                }) 

                ->addColumn('permission', function ($roles){
                    return $roles->permissions->pluck('display_name')->implode(', ');
                })   

                ->addColumn('accion', function ($roles) {
                    return view('admin.roles.partials._action', [
                        'roles' => $roles,
                                              
                        'url_edit' => route('admin.roles.edit', $roles->id),                                            
                        'url_destroy' => route('admin.roles.destroy', $roles->id)
                        
                    ]);
                })
               
                ->addIndexColumn()   
                ->rawColumns(['display_name', 'permission', 'accion'])                
                ->make(true);          
    }
}
