<div class="row">
{!! Form::model($permission, [
    'route' => $permission->exists ? ['admin.permissions.update', $permission->id] : 'admin.permissions.store',   
    'method' => $permission->exists ? 'PUT' : 'POST'
]) !!}
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Rol</h3>
            </div>
            <div class="box-body">                
                <!-- abre formulario -->
                    <div class="form-group">              
                        {!! Form::label('name', 'Identificador') !!}  
                        <!-- @if ($permission->exists)                     -->
                            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'disabled' => 'disabled']) !!}
                        <!-- @else
                           {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Identificador']) !!}
                        @endif -->
                    </div>                  

                    <div class="form-group">              
                        {!! Form::label('display_name', 'Nombre') !!}                    
                        {!! Form::text('display_name', null, ['class' => 'form-control', 'id' => 'display_name', 'placeholder' => 'Nombre']) !!}
                    </div>

                  
                <!-- cierra formulario -->
            </div>
        </div>
    </div>
    <!-- <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Permisos</h3>                
            </div>
            <div class="box-body">                          
                   
            </div>
        </div> -->
        <!-- <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Permisos</h3>                
            </div>
            <div class="box-body">
                        
            </div>
        </div> -->
    </div>
{!! Form::close() !!}    
</div>

   

    




  