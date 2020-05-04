<div class="row">
    {!! Form::model($piece, [
        'route' => $piece->exists ? ['admin.pieces.update', $piece->id] : 'admin.pieces.store',   
        'method' => $piece->exists ? 'PUT' : 'POST'
    ]) !!} 
    
    <div class="col-md-8"> 
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Pieza</h3>
            </div>             
            <div class="box-body">
                {{ csrf_field() }}
                <div class="form-row">                    
                    <div class="form-group col-md-4">                                        
                        {!! Form::label('order_id', 'Denominación:') !!}
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-edit"></i>
                            </div>                         
                            {!! Form::select('order_id', $order, $piece->order_id, ['class' => 'form-control', 'id' => 'order_id', 'placeholder' => '']) !!}                              
                           
                        </div> 
                    </div> 
                    <div class="form-group col-md-4">                      
                        {!! Form::label('code', 'Número de pieza:') !!} 
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-edit"></i>
                            </div>                                      
                            {!! Form::text('code', $piece->code, ['class' => 'form-control', 'id' => 'code', 'readonly' => 'true','placeholder' => 'Código']) !!}                     
                        </div> 
                    </div>                    
                    <div class="form-group col-md-4">                    
                        {!! Form::label('part_piece', 'Parte N°:') !!}
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-edit"></i>
                            </div>  
                            {!! Form::select('part_piece', $part_piece, null, ['class' => 'form-control', 'id' => 'part_piece', 'placeholder' => 'Parte']) !!}                              
                        </div>       
                    </div>           
                </div>                
            </div>            
        </div>
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Operario - Maquina:</h3>                
            </div>
            <div class="box-body">
                <div class="form-row">
                <div class="form-group col-md-12">          
                    {!! Form::label('user', 'Operario:') !!} 
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-edit"></i>
                        </div>                    
                        {!! Form::text('user', $piece->user, ['class' => 'form-control', 'id' => 'user', 'readonly' => 'true', 'placeholder' => 'Nombre de operario']) !!}
                    </div>
                </div> 
                  
                <div class="form-group col-md-12">          
                    {!! Form::label('machine_id', 'Maquina:') !!} 
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-cogs"></i>
                        </div>                                          
                        {!! Form::select('machine_id', $machine, $piece->machine_id, ['class' => 'form-control select2', 'id' => 'machine_id', 'placeholder' => '']) !!}</div>
                    </div>
                </div>
                <div class="form-group col-md-12">          
                    {!! Form::label('category_maq', 'Categoria de maquina:') !!} 
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-edit"></i>
                        </div>                    
                        {!! Form::text('category_maq', $piece->machine['category_maq'], ['class' => 'form-control', 'id' => 'category_maq', 'readonly' => 'true', 'placeholder' => 'Categoria de maquina cnc']) !!}
                    </div>
                </div>                            
            </div>
        </div>
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Programa</h3>
            </div>             
            <div class="box-body">
                <div class="form-row">                
                    <div class="form-group col-md-4">                    
                        {!! Form::label('name_program', 'Nombre:') !!}
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-edit"></i>
                            </div>                               
                            {!! Form::text('name_program', $piece->program['name_program'], ['class' => 'form-control', 'id' => 'name_program', 'readonly' => 'true', 'placeholder' => 'Programa']) !!}                           
                        </div>
                    </div>                 
                    <div class="form-group col-md-4">                    
                        {!! Form::label('number_program', 'Número:') !!}
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-edit"></i>
                            </div>                                      
                            {!! Form::text('number_program', $piece->program['number_program'], ['class' => 'form-control', 'id' => 'number_program', 'placeholder' => 'Número']) !!}                              
                        </div>
                    </div>  
                    <div class="form-group col-md-4">                    
                        {!! Form::label('part_program', 'Parte N°:') !!}
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-edit"></i>
                            </div>                                   
                            {!! Form::text('part_program', $piece->program['part_program'], ['class' => 'form-control', 'id' => 'part_program', 'readonly' => 'true', 'placeholder' => 'Parte']) !!}                               
                        </div>
                    </div>
                </div>  
            </div>      
        </div> 

        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Herramientas de mecanizado</h3>
            </div>             
            <div class="box-body">
                <div class="form-group">
                    <label>Herramientas:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-wrench"></i>
                        </div>      
                        <select name="tools[]" id="tools" class="form-control select2" 
                                multiple="multiple"                        
                                data-placeholder="Selecciona una o mas herramientas" style="width: 100%;">
                            @foreach($tools as $tool)
                                <option {{ collect( old('tools', $piece->tools->pluck('id')))->contains($tool->id) ? 'selected' : '' }} value="{{ $tool->id}}"> {{ $tool->tool }} </option>
                            @endforeach
                        </select>
                    </div>  
                </div>    
            </div>    
        </div>     
    </div>

    <div class="col-md-4">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Mordaza</h3>
            </div>             
            <div class="box-body">
                <div class="form-group">                    
                    {!! Form::label('number_gag', 'Número de mordaza:') !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-edit"></i>
                        </div>        
                        {!! Form::select('number_gag', $number_gag, $piece->gag_id, ['class' => 'form-control', 'id' => 'number_gag', 'placeholder' => '']) !!}                     
                    </div>
                </div>                 
                <div class="form-group">                  
                    {!! Form::label('diameter', 'Diametro de mordaza:') !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-edit"></i>
                        </div>                                                            
                        {!! Form::text('diameter', $piece->gag['diameter'], ['class' => 'form-control', 'id' => 'diameter', 'readonly' => 'true', 'placeholder' => 'Diametro de sujección']) !!}                              
                    </div>
                </div>  
                <div class="form-group">          
                    {!! Form::label('type_gag', 'Tipo de mordaza:') !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-edit"></i>
                        </div>        
                        {!! Form::text('type_gag', $piece->gag['type_gag'], ['class' => 'form-control', 'id' => 'type_gag', 'readonly' => 'true', 'placeholder' => 'Tipo de mordaza']) !!}                     
                    </div>
                </div>
                <div class="form-group">             
                    {!! Form::label('category_gag', 'Categoria de mordaza:') !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-edit"></i>
                        </div>                                     
                        {!! Form::text('category_gag', $piece->gag['category_gag'], ['class' => 'form-control', 'id' => 'category_gag', 'readonly' => 'true', 'placeholder' => 'Categoria de mordaza']) !!}                            
                    </div>
                </div>            
            </div>      
        </div>


        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Tiempo de mecanizado</h3>                
            </div>            
            <div class="box-body"> 
                <div class="form-group">                    
                    {!! Form::label('time', 'Tiempo:') !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>                                       
                        {!! Form::text('time', null, ['class' => 'form-control timepicker', 'id' => 'time', 'placeholder' => 'Ingresa tiempo de mecanizado']) !!}                          
                    </div>
                </div>              
            </div>  
        </div>
       
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Observaciónes generales</h3>
            </div>             
            <div class="box-body">
                <div class="form-group">
                    <label>Observaciónes:</label>
                    <textarea name="observation" id="observation" rows="5" class="form-control" placeholder="Si es necesario, ingresar alguna observación">{{ old('observation', $piece->observation)}}</textarea>
                </div>
            </div>       
        </div>   
    </div>
    <!-- <div class="col-md-12">  
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Observaciónes generales</h3>
            </div>             
            <div class="box-body">
                <div class="form-group">
                    <label>Observación</label>
                    <textarea name="observation" id="observation" rows="5" class="form-control" placeholder="Ingresa un extracto de la publicación">{{ old('observation', $piece->observation)}}</textarea>
                </div>
            </div>       
        </div>  
    </div> -->
    {!! Form::close() !!}    
</div>
