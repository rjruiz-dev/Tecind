@extends('layouts.app')

@section('header')        
    <h1>
        AUDITORIA
        <small>Listado </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Auditoria</li>
    </ol> 
@stop

@section('content')
    <div class="panel panel-primary">        
        <div class="panel-heading">
            <h3 class="panel-title">Listado de las acciones de los usuarios</h3>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-bordered table-hover" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Model</th>
                        <th>Action</th>
                        <th>User</th>
                        <th>Time</th>
                        <th>Old Values</th>                          
                        <th>New Values</th>
                        <th>Ip_adrress</th>        
                        <th>Url</th>                        
                        <th>Navegador</th>                       
                    </tr>
                </thead>
                <tbody id="audits">
                    @foreach($audits as $audit)                        
                        <tr>
                            <td>{{ $audit->auditable_type }} (id: {{ $audit->auditable_id }})</td>
                            <td>{{ $audit->event }}</td>
                            <td>{{ $audit->user['name'] }}</td>
                            <td>{{ $audit->created_at }}</td>                            
                            <td>                 
                                <table class="table table-bordered table-hover" style="width:100%">
                                    @foreach($audit->old_values as $attribute => $value)                            
                                        <tr>
                                            <td><b>{{ $attribute  }}</b></td>                                         
                                            <td>{{  $value }}</td>                                                                      
                                        </tr>                                  
                                    @endforeach
                                </table>
                            </td>                                                    
                            <td>
                                <table class="table table-bordered table-hover" style="width:100%">
                                    @foreach($audit->new_values  as $attribute2 => $value2)                                
                                        <tr>
                                            <td><b>{{ $attribute2 }}</b></td>                                                                                      
                                            <td>{{ is_array($value2) ? json_encode($value2) : $value2 }}</td>                                         
                                        </tr>                                  
                                    @endforeach 
                                </table>
                            </td> 
                            <td>{{ $audit->ip_address }}</td>                                    
                            <td>{{ $audit->url }}</td>                            
                            <td>{{ $audit->user_agent }}</td>                                              
                        </tr>
                    @endforeach
                </tbody>                
            </table>
        </div>
    </div> 
@stop

@push('styles')      
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">  
@endpush

@push('scripts')  
    <script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>    
    
    <script>
        $('#datatable').DataTable({
            "columnDefs": 
            [
                { "width": "20%", "targets": 5 }
            ]
        });
    </script>
@endpush

