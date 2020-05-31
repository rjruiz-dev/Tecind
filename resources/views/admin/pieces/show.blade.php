
@extends('layouts.app')

@section('header')    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>
        LEGAJOS
        <small>Listado </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin/pieces') }}"><i class="fa fa-folder-open"></i> Volver</a></li>
        <li class="active">Legajos</li>
    </ol>   
    <div class="pad margin no-print">
        <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
        </div>
    </div>
@stop

@section('content')
    <section class="invoice">     
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-cogs"></i> PREPARACIÓN TORNO {{ $pieces->machine['machine'] }}
                    <small class="pull-right">Fecha: {{ $pieces->created_at->format('d-m-y') }}</small>
                </h2>
            </div>           
        </div> 
        <div class="row">
            <div class="col-xs-12">
                <p class="lead">Datos de la Pieza</p>
            </div>
            <div class="col-xs-6">
                <div class="table-responsive">
                    <table class="table">
                    <tr>
                        <th style="width:50%">Denominación:</th>
                        <td>{{ $pieces->order['denomination'] }}</td>
                    </tr>                                       
                    </table>
                </div>
            </div>
            <div class="col-xs-6">            
                <div class="table-responsive">
                    <table class="table">                   
                    <tr>
                        <th>Pieza n°:</th>
                        <td>{{ $pieces->order['code'] }}</td>
                    </tr>                    
                    </table>
                </div>
            </div>
        </div>
               
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <p class="lead">Datos de las Herramientas</p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Posición</th>
                            <th>Herramienta</th>                  
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pieces->tools as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->tool }}</td>                          
                            <td>El snort testosterone trophy driving gloves handsome</td>                        
                        </tr>
                    @endforeach                   
                    </tbody>
                </table>
            </div>       
        </div>
        <!-- <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                <address>
                    <strong>Admin, Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (804) 123-5432<br>
                    Email: info@almasaeedstudio.com
                </address>
            </div>            
            <div class="col-sm-4 invoice-col">
                To
                <address>
                    <strong>John Doe</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (555) 539-1037<br>
                    Email: john.doe@example.com
                </address>
            </div>        
            <div class="col-sm-4 invoice-col">
                <b>Invoice #007612</b><br>
                <br>
                <b>Order ID:</b> 4F3S8J<br>
                <b>Payment Due:</b> 2/22/2014<br>
                <b>Account:</b> 968-34567
            </div>      
        </div> -->
        <div class="row"> 
            <div class="col-xs-4">
                <p class="lead">Datos de Mordaza</p>

                <div class="table-responsive">
                    <table class="table">
                    <tr>
                        <th style="width:50%">Número:</th>
                        <td>{{ $pieces->gag['number_gag'] }}</td>
                    </tr>
                    <tr>
                        <th>Diametro:</th>
                        <td>{{ $pieces->gag['diameter'] }}</td>
                    </tr>
                    <tr>
                        <th>Tipo:</th>
                        <td>{{ $pieces->gag['type_gag'] }}</td>
                    </tr>
                    <tr>
                        <th>Categoria:</th>
                        <td>{{ $pieces->gag['category_gag'] }}</td>
                    </tr>
                    </table>
                </div>
            </div>          
            <div class="col-xs-4">
                <p class="lead">Datos del Programa</p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Nombre: </th>
                            <td>{{ $pieces->program['name_program'] }}</td>
                        </tr>
                        <tr>
                            <th>Número:</th>
                            <td>{{ $pieces->program['number_program'] }}</td>
                        </tr>
                        <tr>
                            <th>Parte:</th>
                            <td>{{ $pieces->program['part_program'] }}</td>
                        </tr>                        
                    </table>
                </div>
            </div>                 
            <div class="col-xs-4">
                <p class="lead">Datos de Mecanizado</p>

                <div class="table-responsive">
                    <table class="table">
                    <tr>
                        <th style="width:50%">Tiempo mec:</th>
                        <td>{{ $pieces->time }}</td>
                    </tr>
                    <tr>
                        <th>Operario:</th>
                        <td>{{ $pieces->user }}</td>
                    </tr>                    
                    </table>
                </div>
            </div>        
        </div>

        <div class="row no-print">
            <div class="col-xs-12"> 
                <!-- <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button> -->
                <!-- <a href="{{ url('admin/pieces/exportpdf') }}" class="btn btn-primary pull-right"  target="_blank" style="margin-right: 5px;"><i class="fa fa-download"></i> Export PDF</a> -->
            </div>
        </div>     
    </section>
@stop
