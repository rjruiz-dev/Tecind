<?php

use Illuminate\Database\Seeder;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 2)->create();
        
        // create roles
        $adminRole = Role::create(['name' => 'Admin', 'display_name' => 'Administrador']);
        $operatorRole = Role::create(['name' => 'Operator', 'display_name' => 'Operador']);
        $supervisorRole = Role::create(['name' => 'Supervisor', 'display_name' => 'Supervisor']);

        // create permissions
        $viewPostsPermission     = Permission::create([

            'name' => 'View posts',
            'display_name' => 'Ver publicaciones'
        ]);
        $createPostsPermission   = Permission::create([

            'name' => 'Create posts',
            'display_name' => 'Crear publicaciones'
        ]);
        $updatePostsPermission   = Permission::create([

            'name' => 'Update posts',
            'display_name' => 'Actualizar publicaciones'
        ]);
        $deletePostsPermission   = Permission::create([

            'name' => 'Delete posts',
            'display_name' => 'Eliminar publicaciones'
        ]);

        $viewUsersPermission     = Permission::create([
            
            'name' => 'View users',
            'display_name' => 'Ver usuarios'
        ]);
        $createUsersPermission   = Permission::create([
            
            'name' => 'Create users',
            'display_name' => 'Crear usuarios'
        ]);
        $updateUsersPermission   = Permission::create([
        
            'name' => 'Update users',
            'display_name' => 'Actualizar usuarios'
        ]);
        $deleteUsersPermission   = Permission::create([
            
            'name' => 'Delete users',
            'display_name' => 'Eliminar usuarios'
        ]);

        $viewRolesPermission     = Permission::create([
        
            'name' => 'View roles',
            'display_name' => 'Ver roles'
        ]);
        $createRolesPermission   = Permission::create([
            
            'name' => 'Create roles',
            'display_name' => 'Crear roles'
        ]);
        $updateRolesPermission   = Permission::create([
            
            'name' => 'Update roles',
            'display_name' => 'Actualizar roles'
        ]);
        $deleteRolesPermission   = Permission::create([
            
            'name' => 'Delete roles',
            'display_name' => 'Eliminar roles'
        ]);        

        $viewClientsPermission     = Permission::create([
        
            'name' => 'View clients',
            'display_name' => 'Ver clientes'
        ]);
        $createClientsPermission   = Permission::create([
            
            'name' => 'Create clients',
            'display_name' => 'Crear clientes'
        ]);
        $updateClientsPermission   = Permission::create([
            
            'name' => 'Update clients',
            'display_name' => 'Actualizar clientes'
        ]);
        $deleteClientsPermission   = Permission::create([
            
            'name' => 'Delete clients',
            'display_name' => 'Eliminar clientes'
        ]);        

        $viewOrdersPermission     = Permission::create([
        
            'name' => 'View orders',
            'display_name' => 'Ver Ordenes'
        ]);
        $createOrdersPermission   = Permission::create([
            
            'name' => 'Create orders',
            'display_name' => 'Crear Ordenes'
        ]);
        $updateOrdersPermission   = Permission::create([
            
            'name' => 'Update orders',
            'display_name' => 'Actualizar Ordenes'
        ]);
        $deleteOrdersPermission   = Permission::create([
            
            'name' => 'Delete orders',
            'display_name' => 'Eliminar Ordenes'
        ]);

        $viewPermissionsPermission   = Permission::create([
            
            'name' => 'View permissions',
            'display_name' => 'Ver permisos'
        ]);
        $updatePermissionsPermission   = Permission::create([
            
            'name' => 'Update permissions',
            'display_name' => 'Actualizar permisos'
        ]);
        $viewPiecesPermission     = Permission::create([
        
            'name' => 'View pieces',
            'display_name' => 'Ver Piezas'
        ]);
        $createPiecesPermission   = Permission::create([
            
            'name' => 'Create pieces',
            'display_name' => 'Crear Piezas'
        ]);
        $updatePiecesPermission   = Permission::create([
            
            'name' => 'Update pieces',
            'display_name' => 'Actualizar Piezas'
        ]);
        $viewTimesPermission     = Permission::create([
        
            'name' => 'View times',
            'display_name' => 'Ver Tiempos'
        ]);
        $createTimesPermission   = Permission::create([
            
            'name' => 'Create times',
            'display_name' => 'Crear Tiempos'
        ]);
        $updateTimesPermission   = Permission::create([
            
            'name' => 'Update times',
            'display_name' => 'Actualizar Tiempos'
        ]);          
        $viewAuditsPermission   = Permission::create([
            
            'name' => 'View audits',
            'display_name' => 'Ver auditoria'
        ]);
        $viewNotificationsPermission   = Permission::create([
            
            'name' => 'View notifications',
            'display_name' => 'Ver notificaciones'
        ]);
        $viewDashboardsPermission   = Permission::create([
            
            'name' => 'View dashboards',
            'display_name' => 'Ver panel'
        ]);



        // create users
        $admin = new User;
        $admin->name = 'Rodrigo';
        $admin->email = 'rjruizsf@gmail.com';        
        $admin->password = '123456';    
        $admin->save();

        $admin->assignRole($adminRole);
        
        $operator = new User;
        $operator->name = 'Luis';
        $operator->email = 'luis@gmail.com';       
        $operator->password = '123456';    
        $operator->save();

        $operator->assignRole($operatorRole);

        $supervisor = new User;
        $supervisor->name = 'Jorge';
        $supervisor->email = 'jorge@gmail.com';        
        $supervisor->password = '123456';    
        $supervisor->save();

        $supervisor->assignRole($supervisorRole);
    }
}
