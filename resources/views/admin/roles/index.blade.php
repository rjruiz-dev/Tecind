<?php
use Spatie\Permission\Models\Role;
?>

@extends('layouts.app')

@section('header')    
    <h1>
        ROLES
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Roles</li>
    </ol> 
@stop

@section('content')
    <div class="panel panel-primary">        
        <div class="panel-heading">
            <h3 class="panel-title">Listado de roles
            @can('create', $role = new Role())
                <a href="{{ route('admin.roles.create') }}"  id="btn-btn-create" class="btn btn-success pull-right modal-show" style="margin-top: -8px;" title="Crear Rol"><i class="fa fa-plus-square"></i> Crear rol</a>
            @endcan           
            </h3>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Identificador</th>
                        <th>Nombre</th>   
                        <th>Permisos</th>                                               
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>                
            </table>
        </div>
    </div> 
@stop

@include('admin.roles.partials._modal')

@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">  
@endpush

@push('scripts')
    <script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> 
    <script src="{{ asset('js/role.js') }}"></script>
    
    <script>
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('roles.table') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'}, 
                {data: 'display_name', name: 'display_name'},               
                {data: 'permission', name: 'permission'},                                
                {data: 'accion', name: 'accion'}                
            ]
        });
    </script>
@endpush
