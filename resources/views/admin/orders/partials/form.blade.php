<div class="row">
    {!! Form::model($order, [
        'route' => $order->exists ? ['admin.orders.update', $order->id] : 'admin.orders.store',   
        'method' => $order->exists ? 'PUT' : 'POST'
    ]) !!}  

    @if( auth()->user()->getRoleDisplayNames() == 'Administrador' )

            @php 
                $enable = '';
                $readonly = '';
            @endphp
    @else
            @php 
                $enable = 'disabled';
                $readonly = 'readonly';
            @endphp
    @endif
    
    <div class="col-md-6">    
        <div class="box box-primary">            
            <div class="box-header with-border ">
                <h3 class="box-title">Detalles del Cliente                  
                </h3>     
            </div>          
            <div class="box-body">
                {!! csrf_field() !!}           
                <div class="form-group">                    
                    <label>Nombre empresa</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-industry"></i>
                        </div>                        
                    <select name="name_company" id="name_company" class="form-control select2" {{{$enable}}}>
                        <option value=""></option>
                        @foreach ($clients as $client)          
                            <option value="{{ $client->company['id'] }}"
                            {{ old('name_company', $order->client_id) == $client->company['id'] ? 'selected' : ''}}>
                            {{ $client->company['name_company'] }}</option>                     
                        @endforeach  
                    </select>
                    </div>                                    
                </div>               
                
                <div class="form-group">                    
                    {!! Form::label('phone_company', 'Telefono empresa:') !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                    @if ($order->exists)
                        @foreach ($clients as $client) 
                            @if(old('phone_company', $order->client_id) == $client->company['id'])               
                                {!! Form::text('phone_company', old('phone_company', $client->company['phone_company']), ['class' => 'form-control', 'id' => 'phone_company', 'disabled' => 'disabled', 'placeholder' => 'Telefono empresa']) !!}
                            @endif
                        @endforeach  
                    @else
                        {!! Form::text('phone_company', null, ['class' => 'form-control', 'id' => 'phone_company', 'disabled' => 'disabled', 'placeholder' => 'Telefono empresa']) !!}
                    @endif
                    </div>
                </div> 
               
                <div class="form-group">
                    {!! Form::label('name_client', 'Nombre contacto:') !!}  
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div> 
                    @if ($order->exists) 
                        @foreach ($clients as $client)
                            @if(old('name_client', $order->client_id) == $client->company['id'])         
                                {!! Form::text('name_client', old('name_client', $client['name_client']), ['class' => 'form-control', 'id' => 'name_client', 'disabled' => 'disabled', 'placeholder' => 'Nombre contacto']) !!}
                            @endif
                        @endforeach
                    @else
                        {!! Form::text('name_client', null, ['class' => 'form-control', 'id' => 'name_client', 'disabled' => 'disabled', 'placeholder' => 'Nombre contacto']) !!}
                    @endif
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('phone_client', 'Telefono contacto:') !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                    @if ($order->exists) 
                        @foreach ($clients as $client) 
                            @if(old('phone_client', $order->client_id) == $client->company['id'])               
                                {!! Form::text('phone_client', old('phone_client', $client['phone_client']), ['class' => 'form-control', 'id' => 'phone_client', 'disabled' => 'disabled', 'placeholder' => 'Telefono contacto']) !!}
                            @endif
                        @endforeach
                    @else
                        {!! Form::text('phone_client', null, ['class' => 'form-control', 'id' => 'phone_client', 'disabled' => 'disabled', 'placeholder' => 'Telefono contacto']) !!}
                    @endif
                    </div>
                </div>              

                <div class="form-group">
                    {!! Form::label('email', 'Email contacto:') !!} 
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </div>
                    @if ($order->exists) 
                        @foreach ($clients as $client) 
                            @if(old('email', $order->client_id) == $client->company['id'])              
                                {!! Form::text('email', old('email', $client['email']), ['class' => 'form-control', 'id' => 'email', 'disabled' => 'disabled', 'placeholder' => 'Email contacto']) !!}
                            @endif
                        @endforeach                        
                    @else
                        {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'disabled' => 'disabled', 'placeholder' => 'Email contacto']) !!}
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Detalles de Orden</h3>                
            </div>
            <div class="box-body">                   

                <div class="form-group">              
                    {!! Form::label('status', 'Estado') !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa  fa-pencil-square-o"></i>
                        </div>
                        {!! Form::select('status', $status, $order->statu_id, ['class' => 'form-control select2', 'id' => 'status', 'placeholder' => '']) !!}
                      
                    </div>
                </div>       

                @if ($status === '3')
                
                    @php                        
                        $visible = "display:none"
                    @endphp
                @else
                    @php  
                        $visible = ""
                    @endphp
                @endif       

                <div class="form-group" style="{{{ $visible }}}" id="motivo">
                    {!! Form::label('reason', 'Motivo') !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa  fa-pencil-square-o"></i>
                        </div>                                 
                        {!! Form::text('reason', null, ['class' => 'form-control', 'id' => 'reason',  'placeholder' => 'Motivo']) !!}                     
                    </div>
                </div> 
                &nbsp;
                <div class="form-group">  
                    <label>Nombre operario</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>                     
                        <select name="name" id="name" class="form-control select2" {{{$enable}}}>                    
                            <option value=""></option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                {{ old('name', $order->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select> 
                    </div>                  
                </div>              

                <div class="form-group">
                    <label>Fecha</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="date" {{{$readonly}}}
                            class="form-control pull-right"                                                       
                            value="{{ old('date', $order->date ? $order->date->format('m/d/Y') : null) }}"                            
                            type="text"
                            id="datepicker"
                            placeholder= "Selecciona una fecha">                       
                    </div>                  
                </div>             
            </div>
        </div>      
    </div>
    <div class="col-md-12">  
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Detalles de Fabricación</h3>
            </div>             
            <div class="box-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                                            
                        {!! Form::label('denomination', 'Pieza') !!}                  
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-edit"></i>
                            </div>                                      
                            {!! Form::select('denomination', $orders, $order->id, ['class' => 'form-control', 'id' => 'denomination', 'placeholder' => '', $enable]) !!}
                        </div>
                    </div> 
                    <div class="form-group col-md-6"> 
                        {!! Form::label('order', 'Número de Orden') !!}                 
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-edit"></i>
                            </div>                                   
                            {!! Form::text('order', $order->order, ['class' => 'form-control', 'id' => 'order', 'placeholder' => 'Ingresa número de orden', $enable]) !!}                        
                        </div>
                    </div>                               
                    <div class="form-group col-md-6">                    
                        {!! Form::label('code', 'Número de pieza') !!}                          
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-edit"></i>
                            </div>                                   
                            {!! Form::text('code',  $order->code, ['class' => 'form-control', 'id' => 'code', 'placeholder' => 'Ingresa número de pieza', $enable]) !!}
                        </div>
                    </div>                    
                    <div class="form-group col-md-6"> 
                        {!! Form::label('quantity', 'Cantidad') !!}                 
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-edit"></i>
                            </div>                                   
                            {!! Form::number('quantity', $order->quantity, ['class' => 'form-control', 'id' => 'quantity', 'placeholder' => 'Ingresa cantidad a fabricar', $enable]) !!}                        
                        </div>
                    </div>                   
                </div>               
            </div>       
        </div>  
    </div>
    {!! Form::close() !!}    
</div>
