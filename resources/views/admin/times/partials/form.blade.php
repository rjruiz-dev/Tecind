<div class="row">
    {!! Form::model($time, [
        'route' => $time->exists ? ['admin.times.update', $time->id] : 'admin.times.store',   
        'method' => $time->exists ? 'PUT' : 'POST'
    ]) !!}  

    <div class="col-md-8">  
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Detalles de la Orden</h3>                
            </div>
            <div class="box-body">
                <div class="form-row">  
                    <div class="form-group col-md-12">          
                        {!! Form::label('order_id', 'Número de orden:') !!} 
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-file"></i>
                            </div>                                          
                            {!! Form::select('order_id', $order, $time->order_id, ['class' => 'form-control select2', 'id' => 'order_id', 'placeholder' => '',  'style' => 'width:100%;']) !!}                       
                        </div>
                    </div>
               
                    <div class="form-group col-md-12">          
                        {!! Form::label('denomination', 'Denominación:') !!}
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-wrench"></i>
                            </div> 
                            {!! Form::text('denomination', $time->denomination, ['class' => 'form-control', 'id' => 'denomination', 'readonly' => 'true', 'placeholder' => 'Nombre de pieza']) !!}                       
                        </div>
                    </div>
                    <div class="form-group col-md-12">          
                        {!! Form::label('code', 'Número de pieza:') !!}        
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-check-square-o"></i>
                            </div>                            
                            {!! Form::text('code', $time->code, ['class' => 'form-control', 'id' => 'code', 'readonly' => 'true', 'placeholder' => 'Código de pieza']) !!} 
                        </div>
                    </div>
                    <div class="form-group col-md-12">          
                        {!! Form::label('quantity', 'Cantidad:') !!}  
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-asc"></i>
                            </div>                           
                            {!! Form::text('quantity', $time->quantity, ['class' => 'form-control', 'id' => 'quantity', 'readonly' => 'true', 'placeholder' => 'Cantidad solicitada']) !!}                       
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
                        {!! Form::text('user', $time->user, ['class' => 'form-control', 'id' => 'user', 'readonly' => 'true', 'placeholder' => 'Nombre de operario']) !!}
                    </div>
                </div>                  
                <div class="form-group col-md-12">          
                    {!! Form::label('machine_id', 'Maquina:') !!} 
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-cogs"></i>
                        </div>                                          
                        {!! Form::select('machine_id', $machine, $time->machine_id, ['class' => 'form-control select2', 'id' => 'machine_id', 'placeholder' => '',  'style' => 'width:100%;']) !!}                                                         </div>
                    </div>
                </div>
                <div class="form-group col-md-12">          
                    {!! Form::label('category_maq', 'Categoria de maquina:') !!} 
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-edit"></i>
                        </div>                    
                        {!! Form::text('category_maq', $time->machine['category_maq'], ['class' => 'form-control', 'id' => 'category_maq', 'readonly' => 'true', 'placeholder' => 'Categoria de maquina cnc']) !!}
                    </div>
                </div>                            
            </div>
        </div>

               
    </div>  
    <div class="col-md-4">      
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Tiempo Total de Mecanizado</h3>                
            </div>            
            <div class="box-body">                 
                <div class="form-group">          
                    {!! Form::label('amount', 'Cantidad fabricada:') !!} 
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>     
                        {!! Form::text('amount', $time->quantity, ['class' => 'form-control', 'id' => 'amount', 'placeholder' => 'Ingrese cantidad de piezas']) !!}                       
                    </div>
                </div>
                <div class="form-group">          
                    {!! Form::label('minute', 'Tiempo de mecanizado:') !!} 
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>    
                        {!! Form::text('minute', $time->machining_time, ['class' => 'form-control', 'id' => 'minute', 'placeholder' => 'Ingrese el tiempo de fabricación']) !!}                       
                    </div>
                </div>

                <div class="form-group">          
                    {!! Form::label('machining_time', 'Resultado:') !!}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>    
                        {!! Form::text('machining_time', $time->machining_time, ['class' => 'form-control', 'id' => 'machining_time', 'placeholder' => 'Tiempo total']) !!}                       
                    </div>
                </div>
               
                <!-- <h5> {!! Form::label('machining_time', 'Resultado: ') !!}  <span id="machining_time">0</span></h5>  -->
 
                <button type="button"  class="btn btn-info btn-block" id="calcular">Calcular</button>
                
            </div>  
        </div>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Tiempo Total de Preparación</h3>                
            </div>            
            <div class="box-body"> 
                 <div class="form-group">          
                    {!! Form::label('preparation_time', 'Tiempo de preparación maquina cnc:') !!}           
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>                              
                        {!! Form::text('preparation_time', $time->preparation_time, ['class' => 'form-control', 'id' => 'preparation_time', 'placeholder' => 'Ingrese tiempo de preparación']) !!} 
                    </div>  
                </div>  
            </div>
        </div>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Fecha de Finalización</h3>                
            </div>            
            <div class="box-body"> 
                <div class="form-group">
                    <label>Fecha:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="date"
                            class="form-control pull-right"                                                       
                            value="{{ old('date', $time->date ? $time->date->format('m/d/Y') : null) }}"                            
                            type="text"
                            id="datepicker"
                            placeholder= "Ingrese fecha terminado">                       
                    </div>                  
                </div>  
            </div>
        </div>
    </div>     
   <div class="col-md-12">  
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Observaciónes generales</h3>
            </div>             
            <div class="box-body">
                <div class="form-group">
                    <label>Observación:</label>
                    <textarea name="observation" id="observation" rows="3" class="form-control" placeholder="Si es necesario, ingresar alguna observación">{{ old('observation', $time->observation)}}</textarea>
                </div>
            </div>       
        </div>  
    </div>
    {!! Form::close() !!}    
</div>

<script>

    $(function() {
       
      $('#calcular').click(function(e) {
        e.preventDefault();
        
        var primerValor = $('#amount').val();
        var segundoValor = $('#minute').val();

        let arrayTime = segundoValor.split(":").reverse();
        let timeSeconds = isNaN(arrayTime[0]) ? 0 : parseInt(arrayTime[0]);
            timeSeconds += isNaN(arrayTime[1]) ? 0 : parseInt(arrayTime[1]) * 60;
            timeSeconds += isNaN(arrayTime[2]) ? 0 : parseInt(arrayTime[2]) * 60 * 60;
        let totalAmount = isNaN(primerValor) ? 0 : parseInt(primerValor);

        let totalTime = totalAmount * timeSeconds;

        let hours = Math.floor(totalTime / 3600);
        let minutes = Math.floor(totalTime % 3600 / 60);
        let seconds = totalTime % 60;

        hours = hours.toString().padStart(2, "0");
        minutes = minutes.toString().padStart(2, "0");
        seconds = seconds.toString().padStart(2, "0");

        let resultado = `${hours}:${minutes}:${seconds}`;
     
        $('#machining_time').val(resultado);
      });
    }); 

</script>
<!-- <style>
  
    #machining_time{
    font-size: 2em;
    }
   
</style> -->
