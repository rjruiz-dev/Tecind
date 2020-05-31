<template>   
    <main class="main">
        <!-- Breadcrumb -->
        <!-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
        </ol> -->
        <div class="cointener-fluid">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- grafico de ordenes -->
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Ordenes de los dos ultimos meses en curso</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">       
                                    <!-- <div class="col-md-6">                         -->
                                        <div class="card card-chart">
                                            <div class="card-header">
                                                <h4>Ordenes</h4>
                                            </div>
                                            <div class="card-content">
                                                <div class="ct-chart">
                                                    <canvas id="ordenes">
                                                    </canvas>
                                                </div>                               
                                            </div>
                                            <div class="card-footer">
                                                <p>Ordenes de los ultimos 2 meses en curso.</p>
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                </div> 
                            </div> 
                        </div> 
                        <!-- grafico de estado de orden -->
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Estados de las ordenes del dia</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">                            
                                    <div class="card card-chart">
                                        <div class="card-header">
                                            <h4>Estado</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="ct-chart">
                                                <canvas id="estados">
                                                    
                                                </canvas>
                                            </div>                               
                                        </div>
                                        <div class="card-footer">
                                            <p>Estados de las ordenes del dia.</p>
                                        </div>
                                    </div>
                                </div> 
                            </div>                          
                        </div>                           
                    </div>                   
                </div>
            </div>
        </div>
    </main>   
</template>

<script>    
   
    export default {          
        data (){
            return {
                varOrdenes:null,
                charOrdenes:null,
                ordenes:[],
                varTotalOrdenes:[],               
                varMesOrdenes:[],              

                varEstados:null,
                charEstados:null,
                estados:[],
                varTotalEstados:[],
                varMesEstados:[],

        
            }              
        },
        methods : {
            getOrdenes(){
                let me=this;
                var url= '/admin/dashboard/getChartBar';
                axios.get(url).then(function (response) {
                    //  console.log(response);
                    var respuesta = response.data;
                    me.ordenes = respuesta.ordenes;
                    // //cargamos los datos del chart
                    me.loadOrdenes();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getEstados(){
                let me=this;
                var url= '/admin/dashboard/getChartDoughnut';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.estados = respuesta.estados;
                    //cargamos los datos del chart
                    me.loadEstados();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },   
            
            
            loadOrdenes(){
                let me=this;
                me.ordenes.map(function(x){
                    me.varMesOrdenes.push(x.mes);
                    me.varTotalOrdenes.push(x.total);
                  
                });
                me.varOrdenes=document.getElementById('ordenes').getContext('2d');

                me.charOrdenes = new Chart(me.varOrdenes, {
                    type: 'bar',
                    data: {
                        labels: me.varMesOrdenes,
                        datasets: [{
                            label: 'Ordenes',
                            data: me.varTotalOrdenes,
                            backgroundColor: 'rgba(52, 152, 219 , 0.5)',
                            borderColor: 'rgba(52, 152, 219 , 0.5)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            },
            loadEstados(){
                let me=this;
                me.estados.map(function(x){
                    me.varMesEstados.push(x.mes);
                    me.varTotalEstados.push(x.total);
                });
                me.varEstados=document.getElementById('estados').getContext('2d');

                me.charEstados = new Chart(me.varEstados, {
                    type: 'doughnut',
                    data: {
                        labels: me.varMesEstados,
                        datasets: [{
                            label: 'Estados',
                            data: me.varTotalEstados,                        
                            backgroundColor: [       
                                'rgba(183, 149, 11, 0.5)',
                                'rgba(25, 111, 61, 0.5)',                      
                                'rgba(123, 36, 28, 0.5)',                             
                            ],
                          
                            borderColor: [  
                            'rgba(183, 149, 11, 0.5)',   
                            'rgba(25, 111, 61, 0.5)',                      
                            'rgba(123, 36, 28, 0.5)',                                          
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            }           
         
                             
        }, 
         
        mounted() {
            this.getOrdenes();
            this.getEstados();
                     
        }        

    }

</script>


