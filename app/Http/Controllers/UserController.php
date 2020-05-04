<?php

namespace App\Http\Controllers;

use App\User;
use DataTables;
use App\Providers\UserWasCreated;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveUserRequest;
use Spatie\Permission\Models\Permission;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()    
    {
        
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();

        $this->authorize('create', $user);            
       
        $roles = Role::with('permissions')->get(); 
        $permissions = Permission::pluck('name', 'id');         
        
        return view('admin.users.partials.form', compact('user', 'roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()){
            try {
                //  Transacciones
                DB::beginTransaction();

                $this->authorize('create', new User);

                // Validar el formulario
                $data = $request->validate([
                    'name'      => 'required|string|max:255',
                    'email'     => 'required|string|email|max:255|unique:users',                  
                    // 'password'  => 'required|string|min:6|confirmed',
                ]);
                
                // Generar una contraseña
                $data['password'] = str_random(8);

                // Creamos el usuario
                $user = User::create($data);
                // $user = User::create($request->all());                
                // $user = User::create($request->validated());
             
                // Asignamos los roles
                $user->assignRole($request->roles);
                
                // Asignamos los permisos
                $user->givePermissionTo($request->permissions);
                
                // Enviamos el email
                UserWasCreated::dispatch($user, $data['password']);
                
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
    public function show(User $user)
    {
        $this->authorize('view', $user);

        // $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        // $user = User::findOrFail($id);
        $roles = Role::with('permissions')->get(); 
        $permissions = Permission::pluck('name', 'id'); 
                            
        return view('admin.users.partials.form', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveUserRequest $request, User $user)
    {
        if ($request->ajax()){
            try {
                // Transacciones
                DB::beginTransaction();  
                
                $this->authorize('update', $user);
              
                // Actualizamos el usuario
                $user->update($request->validated()); 

                 // Asignamos los roles
                $user->syncRoles($request->roles);

                // Asignamos los permisos
                $user->syncPermissions($request->permissions);              
                            
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
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        // $user = User::findOrFail($id);
         $user->delete();
    }

    public function dataTable()
    {
        $usuarios = User::query()
        ->allowed()
        ->get();
        
        return dataTables::of($usuarios)
            ->addColumn('created_at', function ($usuarios){
                return $usuarios->created_at->format('d-m-y');
            })   
            ->addColumn('rol', function ($usuarios){
                return $usuarios->roles->implode('name', ', ');
            })   
            
            ->addColumn('accion', function ($usuarios) {
                return view('admin.users.partials._action', [
                    'usuarios' => $usuarios,
                    'url_show' => route('admin.users.show', $usuarios->id),                        
                    'url_edit' => route('admin.users.edit', $usuarios->id),                              
                    'url_destroy' => route('admin.users.destroy', $usuarios->id)
                ]);
            })           
            ->addIndexColumn()   
            ->rawColumns(['rol', 'created_at', 'accion'])                
            ->make(true);  
    }
}
