<?php
use App\Piece;
?>

@extends('layouts.app')

@section('header')    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>
        LEGAJOS
        <small>Listado </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Legajos</li>
    </ol> 
@stop

@section('content')
    <div class="panel panel-primary">        
        <div class="panel-heading">
            <h3 class="panel-title">Listado de Legajos de fabricación     
            @can('create', $piece = new Piece())      
                <a href="{{ route('admin.pieces.create') }}" id="btn-btn-create" class="btn btn-success pull-right modal-show" style="margin-top: -8px;" title="Crear Legajo de fabricación"><i class="fa fa-plus-square"></i> Crear legajo </a>
            @endcan  
            </h3>              
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>    
                        <th>Pieza</th>                 
                        <th>Maq-Op </th>                      
                        <th>Parte</th>                       
                        <th>Fecha</th>                                                                                      
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>                
            </table>
        </div>
    </div> 
@stop

@include('admin.pieces.partials._modal')

@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">       
    <link rel="stylesheet" href="/adminlte/plugins/timepicker/bootstrap-timepicker.min.css">     
    <!-- <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">    -->
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">    
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"> 
@endpush

@push('scripts')

    <script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- <script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
    <script src="/adminlte/bower_components/inputmask/dist/jquery.inputmask.bundle.js"></script>
    <script src="/adminlte/bower_components/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>    
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>   
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script> 
      
    <script src="{{ asset('js/piece.js') }}"></script>   
        
    <script>
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [ [0, 'desc'] ],           
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                }
                
            ], 
            ajax: "{{ route('pieces.table') }}",
            columns: [
                {data: 'id', name: 'id'},            
                {data: 'pieza', name: 'pieza'},     
                {data: 'maq_op', name: 'maq_op'},              
                {data: 'parte', name: 'parte'},
                {data: 'fecha', name: 'fecha'},                         
                {data: 'accion', name: 'accion'}                
            ]
        });        
    </script>
@endpush

