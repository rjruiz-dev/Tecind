<?php
use App\Post;
?>

@extends('layouts.app')

@section('header')  
    
    <h1>
        POSTS
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>          
        <li class="active">Posts</li>
    </ol> 
@stop

@section('content')
    <div class="panel panel-primary">        
        <div class="panel-heading">
            <h3 class="panel-title">Listado de publicaciónes
                @can('create', $post = new Post())
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-success pull-right modal-show" style="margin-top: -8px;" title="Crear Publicación"><i class="fa fa-plus"></i> Crear publicación</a>
                @endcan  
            </h3>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>   
                        <th>Extracto</th>                                                                
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>                
            </table>
        </div>
    </div> 
@stop

@include('admin.posts.partials._modal')

@push('styles')    
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"> 
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
@endpush

@stack('script')
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="/adminlte/bower_components/ckeditor/ckeditor.js"></script>
    <script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>  
    <script src="/adminlte/bower_components/sweetalert2/sweetalert2.all.min.js"></script>   
    <script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> 
    <script src="{{ asset('js/post.js') }}"></script>   
    
    <script>
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [ [0, 'desc'] ],           
            ajax: "{{ route('post.table') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'titulo', name: 'titulo'},
                {data: 'extracto', name: 'extracto'},  
                {data: 'accion', name: 'accion'}                          
            ]
        });
    </script>
@endpush