<div class="row">
{!! Form::model($role, [
    'route' => $role->exists ? ['admin.roles.update', $role->id] : 'admin.roles.store',   
    'method' => $role->exists ? 'PUT' : 'POST'
]) !!}
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Rol</h3>
            </div>
            <div class="box-body">                
                <!-- abre formulario -->
                    <div class="form-group">              
                        {!! Form::label('name', 'Identificador') !!}  
                        @if ($role->exists)                    
                            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'disabled' => 'disabled']) !!}
                        @else
                           {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Identificador']) !!}
                        @endif
                    </div>                  

                    <div class="form-group">              
                        {!! Form::label('display_name', 'Nombre') !!}                    
                        {!! Form::text('display_name', null, ['class' => 'form-control', 'id' => 'display_name', 'placeholder' => 'Nombre']) !!}
                    </div>

                    <!-- <div class="form-group">
                        <label for="email">Guard</label>                                          
                        <select name="guard_name" id="" class="form-control">
                            @foreach(config('auth.guards') as $guardName => $guard)
                                <option {{ old('guard_name', $role->guard_name ) === $guardName ? 'selected' : '' }} 
                                value="{{ $guardName }}">{{ $guardName }}</option>
                            @endforeach
                        </select>                             
                    </div>                  -->
                <!-- cierra formulario -->
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Permisos</h3>                
            </div>
            <div class="box-body">                          
                @include('admin.roles.partials.permissions-checkboxes', ['model' => $role])            
            </div>
        </div>
        <!-- <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Permisos</h3>                
            </div>
            <div class="box-body">
                @include('admin.roles.partials.permissions-checkboxes', ['model' => $role])            
            </div>
        </div> -->
    </div>
{!! Form::close() !!}    
</div>

   


    




  