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

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ranking de ordenes por operario</h3>
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
  
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
   
  
@endpush
