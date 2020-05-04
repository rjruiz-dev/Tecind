<div class="row">

    {!! Form::model($client, [
        'route' => $client->exists ? ['admin.customers.update', $client->id] : 'admin.customers.store',   
        'method' => $client->exists ? 'PUT' : 'POST'
    ]) !!}

    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Empresa</h3>
            </div>
            <div class="box-body">
                {!! csrf_field() !!}                       
                <div class="form-group">              
                    {!! Form::label('name_company', 'Nombre') !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-industry"></i>
                        </div>                     
                        {!! Form::text('name_company', $client->company['name_company'], ['class' => 'form-control', 'id' => 'name_company', 'placeholder' => 'Nombre de empresa']) !!}         
                    </div>   
                </div>

                <div class="form-group">
                    {!! Form::label('cuit', 'Cuit') !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-slack"></i>
                        </div> 
                        {!! Form::text('cuit', $client->company['cuit'], ['class' => 'form-control', 'id' => 'cuit', 'placeholder' => 'N° de cuit']) !!}               
                    </div>   
                </div>               

                <div class="form-group">
                    {!! Form::label('web', 'Web') !!}  
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-globe"></i>
                        </div>                     
                        {!! Form::text('web', $client->company['web'], ['class' => 'form-control', 'id' => 'web']) !!}                 
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('phone_company', 'Telefono') !!}       
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-fax"></i>
                        </div>            
                    {!! Form::text('phone_company', $client->company['phone_company'], ['class' => 'form-control', 'id' => 'phone_company']) !!}
                    </div>                
                </div>           
            </div>
        </div>
    </div> 
    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Contacto</h3>                
            </div>            
            <div class="box-body"> 
                <div class="form-group">
                    {!! Form::label('name_client', 'Nombres') !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>                       
                        {!! Form::text('name_client', null, ['class' => 'form-control', 'id' => 'name_client', 'placeholder' => 'Nombres del contacto']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('lastname', 'Apellidos') !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>                 
                        {!! Form::text('lastname', null, ['class' => 'form-control', 'id' => 'lastname', 'placeholder' => 'Apellidos del contacto']) !!}
                    </div>
                </div> 

                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </div>                
                        {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email',  'placeholder' => 'example@gmail.com']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('phone_client', 'Telefono') !!} 
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>                
                    {!! Form::text('phone_client', null, ['class' => 'form-control', 'id' => 'phone_client', 'placeholder' => 'Telefono del contacto']) !!}
                    </div>      
                </div>                
            </div>
        </div>
    </div>
    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Dirección</h3>                
            </div>            
            <div class="box-body"> 
                <div class="form-group">
                    {!! Form::label('address', 'Direccion') !!}                
                    {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'address']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('city', 'Ciudad') !!}               
                    {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('province', 'Provincia') !!}               
                    {!! Form::text('province', null, ['class' => 'form-control', 'id' => 'province']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('postal_code', 'Codigo Postal') !!}                
                    {!! Form::text('postal_code', null, ['class' => 'form-control', 'id' => 'postal_code']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('country', 'Pais') !!}                                     
                    {!! Form::select('country', $países, null, ['class' => 'form-control select2', 'id' => 'country', 'placeholder' => '']) !!}                  
                </div>                                                     
            </div>
        </div>
    </div>   
    {!! Form::close() !!}   
</div> 