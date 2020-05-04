function selectOperator() {   
    $.ajax({        
        url: '/admin/reports/selectOperator',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        dataType: 'json',
        success: function (response) {
             //console.log(response);
            // var selectOperator =  $('#operator'); 
                     
            for (var i in response.operators) {
                $('#operator').append('<option value='+response.operators[i].id+'>'+response.operators[i].text+'</option>');            
            }   
            //  console.log(response.operators); 
        //    getOperator(selectOperator);                         
        },       
        error: function (response) {       
            // console.log(response.operators);
            alert(response);
        }
    });
}

function selectStatus() {   
    $.ajax({        
        url: '/admin/reports/selectStatus',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        dataType: 'json',
        success: function (response) {
            //  console.log(response);
                                
            for (var i in response.status) {
                $('#status').append('<option value='+response.status[i].id+'>'+response.status[i].text+'</option>');            
            }   
             console.log(response.status); 
      
        },       
        error: function (response) {       
            // console.log(response.status);
            alert(response);
        }
    });
}

function getChartData(user) {   
    $.ajax({
        url: '/admin/reports/getChart/' + user,     
        // url: '/admin/reports/getChart/' + user + '/' + status,
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        dataType: 'json',
        success: function (response) {             
            // console.log(response);
            var order = [];
            var operator = []; 

            for (var i in response.orders) {
                order.push(response.orders[i].orders_by_user);
                operator.push(response.orders[i].name);                        
            }           
            renderChart(order, operator);           
        },       
        error: function (response) {       
            console.log(response.orders);
        }
    });
}

function renderChart(order, operator) {
    var ctx = document.getElementById("orders").getContext('2d');   

    var myChart = new Chart(ctx, {  
        type: 'bar',    
        data: {
            labels: operator,
            datasets: [{
                label: 'Ordenes',
                data: order,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: "#229954",
                borderWidth: 1,
                yAxisID: 'Ordenes',
                xAxisID: 'Operarios',
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    id: "Ordenes",
                    ticks: {
                        beginAtZero: true
                        // suggestedMin: 0,
                        // suggestedMax: 10  
                        // stepSize: 1                         
                        // callback: function (value, index, values) {
                        //     return float2dollar(value);
                        // }
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Ordenes'
                    }
                }],
                xAxes: [{
                    id: "Operarios",
                    scaleLabel: {
                        display: true,
                        labelString: 'Operarios'
                    }

                }],
            },
            title: {
                display: true,
                text: "Ordenes de trabajo"
            },
            // legend: {
            //     display: true,
            //     labels: {
            //         fontColor: 'rgb(255, 99, 132)'
            //     }
            // },
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                  fontColor: "#17202A",
                }
            },
        }        
    });   
    
    
}
selectOperator()
selectStatus();

$('#operator').select2({
    placeholder: 'Selecciona un operario',
    tags: false              
});

$('#status').select2({
    placeholder: 'Selecciona un estado',
    tags: false              
});

$('#operator').on('change', function() {
    var user = $("#operator").val();
    var optionUser = $("option:selected", '#operator').text(); 
             
    
    if (optionUser == 'Seleccione')
    {
        getChartData();

    // } else if (optionStatu == 'Seleccione') {

    //     getChartData();      

    } else{
       
        getChartData(user);           
    }           
}); 


// $('#status').on('change', function() {
//     var statu = $("#status").val();
//     var optionStatu = $("option:selected", '#status').text(); 
//     // getChartData(statu);        
    
//     if (optionStatu == 'EN PROCESO' )
//     {
//         getChartData();

//     } else {

//         getChartData(statu);           
//     }           
// }); 

// getChartData();


// $("#renderBtn").click(
//     function () {
//         getChartData();
//     }
// );


// $("#loadingMessage").html('<img src="./giphy.gif" alt="" srcset="">');    
// $("#loadingMessage").html("Error");

// url: '/admin/reports/getChart',

// var data =  response.orders; 
// var labels = response.users;      

// renderChart(data, labels);

// alert(value);
// var value =  $("option:selected", selectOption).val(); 
//var text = $("option:selected", selectOption).text();    

//myChart.data.labels = selectOption;
//if (text == 'All') {
// myChart.data.labels  = text,
//myChart.data.datasets[0].data = console.log(order);
//} else {        
// myChart.data.labels = text;
// myChart.data.datasets[0].data = order;        
//}
//myChart.update();   