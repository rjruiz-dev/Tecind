
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Navegación</li>
    <!-- Optionally, you can add icons to the links -->
    
    @can('view', new App\Dashboard) 
    <li class="{{ setActiveRoute('dashboard') }}">
        <a href="{{ route('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Inicio</span>
        </a>
    </li>
    @endcan  
     
    <li class="treeview {{ setActiveRoute(['admin.posts.index']) }}">                
        <a href="#"><i class="fa fa-bars"></i> <span>Blog</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu">             
            <li class="{{ setActiveRoute('admin.posts.index') }}">
                <a href="{{ route('admin.posts.index') }}">
                    <i class="fa fa-eye"></i> <span>Ver todos los post</span>
                </a>
            </li>           
        </ul>
    </li>      
   

    @can('view', new App\Client) 
    <li class="treeview {{ setActiveRoute(['admin.customers.index','admin.clients.index']) }}">                
        <a href="#"><i class="fa fa-users"></i> <span>Administrar Clientes</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu">             
            <li class="{{ setActiveRoute('admin.customers.index') }}">
                <a href="{{ route('admin.customers.index') }}">
                    <i class="fa fa-user"></i> <span>Clientes</span>
                </a>
            </li>    
            <li class="{{ setActiveRoute('admin.client.index') }}">
                <a href="{{ route('admin.client.index') }}">
                    <i class="fa fa-user-times"></i> <span>Restaurar Clientes</span>
                </a>
            </li> 
        </ul>
    </li>     
    @endcan  


    <li class="{{ setActiveRoute('admin.orders.index') }}">
        <a href="{{ route('admin.orders.index') }}">
            <i class="fa fa-wrench"></i> <span>Ordenes de trabajo</span>
        </a>
    </li> 

    <li class="treeview {{ setActiveRoute(['admin.pieces.index', 'admin.times.index']) }}">                
        <a href="#"><i class="fa fa-industry"></i> <span>Producción</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu">     
            <li class="{{ setActiveRoute('admin.pieces.index') }}">
                <a href="{{ route('admin.pieces.index') }}">
                    <i class="fa fa-folder-open"></i> <span>Legajos de fabricación</span>
                </a>
            </li> 
            <li class="{{ setActiveRoute('admin.times.index') }}">
                <a href="{{ route('admin.times.index') }}">
                    <i class="fa fa-hourglass-2"></i> <span>Tiempos de mecanizado</span>
                </a>
            </li> 
        </ul>
    </li>

    <!-- @can('view', new App\Report)  -->
    <li class="{{ setActiveRoute('admin.reports.index') }}">
        <a href="{{ route('admin.reports.index') }}">
            <i class="fa fa-bar-chart"></i> <span>Reportes</span>
        </a>
    </li>       
    <!-- @endcan  -->

    @can('view', new OwenIt\Auditing\Models\Audit) 
    <li class="{{ setActiveRoute('admin.audits.index') }}">
        <a href="{{ route('admin.audits.index') }}">
            <i class="fa fa-shield"></i> <span>Auditoria</span>
        </a>
    </li>
    @endcan
  

    @can('view', new App\User)      
    <li class="treeview {{ setActiveRoute('admin.users.index') }}">                
        <a href="#"><i class="fa fa-users"></i> <span>Administrar Usuarios</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu">             
            <li class="{{ setActiveRoute('admin.users.index') }}">
                <a href="{{ route('admin.users.index') }}">
                    <i class="fa fa-user"></i><span> Usuarios</span>
                </a>
            </li> 
            <li class="{{ setActiveRoute('admin.user.index') }}">
                <a href="{{ route('admin.user.index') }}">
                    <i class="fa fa-user-times"></i> <span>Restaurar Usuarios</span>
                </a>
            </li>               
        </ul>
    </li> 
    @else
    <li class="{{ setActiveRoute(['admin.users.index','admin.users.edit']) }}">
        <a href="{{ route('admin.users.index', auth()->user()) }}">
            <i class="fa fa-user"></i> <span>Perfil</span>
        </a>
    </li>  
    @endcan 

    @can('view', new Spatie\Permission\Models\Role) 
    <li class="treeview {{ setActiveRoute(['admin.roles.index','admin.permissions.index']) }}">                
        <a href="#"><i class="fa fa-lock"></i> <span>Administrar accesos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>       
        <ul class="treeview-menu">        
            <li class="{{ setActiveRoute('admin.roles.index') }}">
                <a href="{{ route('admin.roles.index') }}">
                    <i class="fa fa-check-square-o"></i> <span>Roles</span>
                </a>
            </li>   
            @endcan

            @can('view', new Spatie\Permission\Models\Permission) 
            <li class="{{ setActiveRoute('admin.permissions.index') }}">
                <a href="{{ route('admin.permissions.index') }}">
                    <i class="fa fa-check-square-o"></i> <span>Permisos</span>
                </a>
            </li>   
            @endcan
        </ul>
    </li>  
</ul>
