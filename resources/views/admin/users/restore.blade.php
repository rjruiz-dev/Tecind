@extends('layouts.app')

@section('header')    
    <h1>
        USUARIOS
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Usuarios</li>
    </ol> 
@stop

@section('content')
    <div class="panel panel-primary">        
        <div class="panel-heading">
            <h3 class="panel-title">Listado de usuarios eliminados</h3>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>                      
                        <th>Usuario</th>                    
                        <th>Rol</th>    
                        <th>Eliminado</th>                                             
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>                
            </table>
        </div>
    </div> 
@stop

@push('styles')
         
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">  
   
@endpush

@push('scripts')
  
    <script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>   
    <script src="{{ asset('js/user.js') }}"></script>
    
    <script>
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,             
            ajax: "{{ route('user.restore.table') }}",
            columns: [
                {data: 'id', name: 'id'},                
                {data: 'usuario', name: 'usuario'},            
                {data: 'rol', name: 'rol'}, 
                {data: 'deleted_at', name: 'deleted_at'}, 
                {data: 'accion', name: 'accion'}                
            ]
        });
    </script>
@endpush