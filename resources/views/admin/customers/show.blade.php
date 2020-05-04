<div class="row">
    <div class="col-md-4">    
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Empresa</h3>
            </div>        
            <div class="box-body box-profile">                                                              
                <img class="profile-user-img img-responsive img-circle" 
                    src="/adminlte/img/user4-128x128.jpg"                                                            
                    alt="{{ $client->company->name_company}}">

                <h3 class="profile-username text-center">{{ $client->company->name_company }}</h3>
               
                <p class="text-muted text-center">Desde {{ $client->created_at->format('d/M/Y') }}</p>                   
               
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Cuit</b> <a class="pull-right">{{ $client->company->cuit }}</a>
                    </li>                   
                    <li class="list-group-item">
                        <b>Telefono</b> <a class="pull-right">{{ $client->company->phone_company }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Web</b> <a class="pull-right">{{ $client->company->web }}</a>
                    </li>
                    <!-- <li class="list-group-item">
                        <b>Following</b> <a class="pull-right">543</a>
                    </li> -->
                                    
                </ul>
                <!-- <a href="#" class="btn btn-primary btn-block"><b>Editar</b></a> -->
             
                
            </div>
        <!-- /.box-body -->
        </div>
    </div>        
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Contacto</h3>
            </div>
            <div class="box-body">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Nombre</b> <a class="pull-right">{{ $client->name_client }}</a>
                    </li>                   
                    <li class="list-group-item">
                        <b>Apellido</b> <a class="pull-right">{{ $client->lastname }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b> <a class="pull-right">{{ $client->email }}</a>
                    </li>   
                    <li class="list-group-item">
                        <b>Telefono</b> <a class="pull-right">{{ $client->phone_client }}</a>
                    </li>                       
                </ul>             
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Direccion</h3>
            </div>
            <div class="box-body">
                         
                <ul class="list-group list-group-unbordered">               
                    <li class="list-group-item"> 
                    @if ( $client->address === NULL )       
                        <b>Direccion</b> <a class="pull-right"><small class="tex-muted">No tiene direccion asignada</small></a> 
                    @else
                        <b>Direccion</b> <a class="pull-right">{{ $client->address}}</a>
                                                 
                    @endif    
                    </li>                              
                    <li class="list-group-item">
                    @if ( $client->city === NULL )       
                        <b>Ciudad</b> <a class="pull-right"><small class="tex-muted">No tiene ciudad asignada</small></a> 
                    @else
                        <b>Ciudad</b> <a class="pull-right">{{ $client->city }}</a>
                    @endif 
                    </li>
                    <li class="list-group-item">
                    @if ( $client->province === NULL )       
                        <b>Provincia</b> <a class="pull-right"><small class="tex-muted">No tiene provincia asignada</small></a> 
                    @else
                        <b>Provincia</b> <a class="pull-right">{{ $client->province }}</a>
                    @endif
                    </li>   
                    <li class="list-group-item">
                    @if ( $client->postal_code === NULL )       
                        <b>Codigo Postal</b> <a class="pull-right"><small class="tex-muted">No tiene codigo postal asignado</small></a> 
                    @else
                        <b>Codigo Postal</b> <a class="pull-right">{{ $client->postal_code }}</a>
                    @endif
                    </li> 
                    <li class="list-group-item">
                    @if ( $client->country === NULL )       
                        <b>Pais</b> <a class="pull-right"><small class="tex-muted">No tiene pais asignado</small></a> 
                    @else
                        <b>Pais</b> <a class="pull-right">{{ $client->country }}</a>
                    @endif
                    </li> 
                </ul> 
                
            </div>
        </div>
    </div>  
</div>
    


