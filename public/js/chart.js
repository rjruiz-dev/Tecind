var cxt;
var myChart;

function selectStatus() {   
    $.ajax({        
        url: '/admin/dashboard/selectStatus',
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

function getChartData(status) {   
    $.ajax({
        url: '/admin/dashboard/getChart/' + status,     
        // url: '/admin/dashboard/getChart/' + user + '/' + status,
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        dataType: 'json',
        success: function (response) {             
            // console.log(response);
            var order = [];
            var operator = []; 
            var colors = []; 

            for (var i in response.orders) {
                order.push(response.orders[i].orders_by_user);
                operator.push(response.orders[i].name);
                colors.push(response.orders[i].color);
                            
            }           
            renderChart(order, operator, colors);           
        },       
        error: function (response) {       
            console.log(response.orders);
        }
    });
}

function renderChart(order, operator, colors) {
    ctx = document.getElementById("orders").getContext('2d');
    myChart = new Chart(ctx, {  
        type: 'bar',    
        data: {
            labels: operator,
            datasets: [{
                label: 'Terminadas',
                data: order,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: colors,//"#229954",
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
// selectOperator()
selectStatus();

// $('#operator').select2({
//     placeholder: 'Selecciona un operario',
//     tags: false              
// });

$('#status').select2({
    placeholder: 'Selecciona un estado',
    tags: false              
});

// $('#operator').on('change', function() {
//     var user = $("#operator").val();
//     var optionUser = $("option:selected", '#operator').text(); 
             
    
//     if (optionUser == 'Seleccione')
//     {
//         getChartData();

//     // } else if (optionStatu == 'Seleccione') {

//     //     getChartData();      

//     } else{
       
//         getChartData(user);           
//     }           
// }); 


$('#status').on('change', function() {
    var statu = $("#status").val();
    console.log(statu);
    var optionStatu = $("option:selected", '#status').text(); 
    console.log(optionStatu);
    // getChartData(statu);        
    
    if (optionStatu == 'Seleccione' )
    {
        getChartData();

    } else {

        getChartData(statu);           
    }           
}); 

getChartData();


// $("#renderBtn").click(
//     function () {
//         getChartData();
//     }
// );


// $("#loadingMessage").html('<img src="./giphy.gif" alt="" srcset="">');    
// $("#loadingMessage").html("Error");

// url: '/admin/dashboard/getChart',

// var data =  response.orders; 
// var labels = response.users;      

// renderChart(data, labels);

// alert(value);
// var value =  $("option:selected", selectOption).val(); 
//var text = $("option:selected", selectOption).text();    

//  myChart.data.labels = optionStatu;
// if (text == 'Seleccione') {
// myChart.data.labels  = user,
// myChart.data.backgroundColor = color,
// myChart.data.datasets[0].data = order;
// } else {        
// myChart.data.labels = user;
// myChart.data.backgroundColor = color,
// myChart.data.datasets[0].data = order.statu;        
// }
// myChart.update();  
