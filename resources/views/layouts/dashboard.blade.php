@extends('layouts.app')

@section('header')        
    <h1>
        Panel de Control 
        <small>Version 1.0 </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Dashboard</li>        
    </ol> 
@stop

@section('content')  
    <div class="row"> 
        <div class="col-md-4 col-sm-6 col-xs-12">         
            <div class="small-box bg-aqua">
                <div class="inner">
                    @foreach($ordenes as $date)
                        <span class="info-box-text">                          
                            ORDENES DE TRABAJO 
                        </span>     
                        <h4>
                            <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">
                                {{ $date->year }} - ({{ $date->orders }})
                            </font>
                            </font>
                        </h4>
                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Total de pedidos</font></font></p>
                    @endforeach	
                </div>
                <div class="icon">
                    <i class="fa fa-clipboard"></i>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="small-box-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Más información </font></font><i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>     
            
        <div class="col-md-4 col-sm-6 col-xs-12">         
            <div class="small-box bg-yellow">
                <div class="inner">
                    @foreach($clientes as $cliente)
                        <span class="info-box-text">                          
                            CLIENTES 
                        </span>     
                        <h4>
                            <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">
                            {{ $cliente->year }} - ({{ $cliente->clients }})
                            </font>
                            </font>
                        </h4>
                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Registros de clientes</font></font></p>
                    @endforeach	
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('admin.customers.index') }}" class="small-box-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Más información </font></font><i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">         
            <div class="small-box bg-green">
                <div class="inner">
                    @foreach($usuarios as $usuario)
                        <span class="info-box-text">                          
                            USUARIOS
                        </span>     
                        <h4>
                            <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">
                            {{ $usuario->year }} - ({{ $usuario->users }})
                            </font>
                            </font>
                        </h4>
                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Registros de usuarios</font></font></p>
                    @endforeach	
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Más información </font></font><i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div> 
    <template>   
        <dashboard><dashboard>           
    </template> 
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ordenes por operario del dia</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>                    
                </div>
                <div class="box-body"> 
                    <div class="card card-chart">
                        <div class="card-header">
                        
                        </div>
                        <div class="card-content">
                            <div class="form-row">                           
                                <div class="form-group col-md-6">
                                                          
                                    <label>Estados</label>                                                                  
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-check"></i>
                                        </div>                   
                                        <select class="form-control" name="status" id="status">
                                            <option></option>                                                                                                  
                                        </select>                             
                                    </div>                                                      
                                </div> 
                            </div>                                            
                            <div class="ct-chart">                          
                                <canvas id="orders"></canvas>
                            </div>                               
                        </div>
                        <div class="card-footer">
                            <div>
                                <ul class="chart-legend clearfix">                                           
                                    <li><i class="fa fa-circle-o text-yellow"></i> <label> En Proceso</label></li> 
                                    <li><i class="fa fa-circle-o text-green"></i> <label> Terminado</label></li>
                                    <li><i class="fa fa-circle-o text-red"></i> <label> No Terminado</label></li>                                                                                      
                                </ul>
                            </div>     
                        </div>
                    </div>                                          
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tiempos de mec. promedio por operario</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body"> 
                    <div class="card card-chart">
                        <div class="card-header">
                        
                        </div>
                        <div class="card-content">
                            <div class="form-row">                           
                                <div class="form-group col-md-6">                           
                                    <label>Piezas</label>                                                                  
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-check"></i>
                                        </div>                   
                                        <select class="form-control" name="pieces" id="pieces">
                                            <option></option>                                                                                                  
                                        </select>                             
                                    </div> 
                                </div> 
                            </div>                                            
                            <div class="ct-chart">                          
                                <canvas id="times"></canvas>
                            </div>                               
                        </div>
                        <div class="card-footer">
                    
                        </div>
                    </div>                                          
                </div>
            </div>
        </div>
    </div>

@stop

@push('styles')    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
    <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">  
@endpush

@push('scripts')   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/order.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/chartPiece.js') }}"></script>
@endpush


