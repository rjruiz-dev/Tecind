var cxt1;
var myChart1;

function timeToSeconds(time) {

    var parts = time.split(":");
    var valueInSeconds = 0;
    var secondsInTimeUnit = [3600, 60, 1];

    for (j = 0; j < parts.length; j++) {
      valueInSeconds = valueInSeconds + secondsInTimeUnit[j] * parseInt(parts[j]);
    }
    
    return valueInSeconds;
}

function  selectPieces() {   
    $.ajax({        
        url: '/admin/dashboard/selectPieces',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        dataType: 'json',
        success: function (response) {
            //  console.log(response);
                                
            for (var i in response.pieces) {
                $('#pieces').append('<option value='+response.pieces[i].id+'>'+response.pieces[i].text+'</option>');            
            }   
             console.log(response.pieces); 
      
        },       
        error: function (response) {       
            // console.log(response.pieces);
            alert(response);
        }
    });
}

function getChartDataPiece(name) {   
    $.ajax({
        url: '/admin/dashboard/getChartPiece/' + name,  
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        dataType: 'json',
        success: function (response) {             
            console.log(response);
            var time = [];
            var amount = [];
            var operator = [];                    

            for (var i in response.pieces) {

                time.push(timeToSeconds(response.pieces[i].time));               
                amount.push(response.pieces[i].quantity);
                operator.push(response.pieces[i].name);                                
            }       
            renderChartPiece(operator, time);           
        },       
        error: function (response) {       
            console.log(response.time);
            console.log(response.operator);
        }
    });
}



function renderChartPiece(operator, time, amount) {
    ctx1 = document.getElementById("times").getContext('2d');
    myChart1 = new Chart(ctx1, {  
        type: 'bar',    
        data: {                       
            labels: operator,
            datasets: [{
                label: 'Tiempo',
                data: time,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                yAxisID: 'Tiempos',
                xAxisID: 'Operarios',
            }],
        },
        options: {
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.datasets[tooltipItem.datasetIndex].label || '';
                        if (label) {
                            label += ': ';
                        }
                      var mins = parseInt(parseInt(tooltipItem.yLabel)/60);
                      var seconds = parseInt(tooltipItem.yLabel) - mins*60;
                      mins =  mins+":"+(seconds < 10 ? "0" : "") +seconds;                  
                      return label + mins;
                    }
                }
            },
            scales: {
                yAxes: [{
                    id: "Tiempos",
                    ticks: {
                        beginAtZero: true,
                        stepSize: 30, //step every 30 seconds
                        callback: function(label, index, labels) {
                            if (parseInt(label) % 30 == 0) {
                                //convert seconds to mm:ss format
                                var mins = parseInt(parseInt(label)/60);
                                var seconds = parseInt(label) - mins*60;
                                return mins+":"+(seconds < 10 ? "0" : "") +seconds;
                            } else {
                                return "";
                            }
                        }
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Tiempos'
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
                text: "Tiempos de trabajo"
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

selectPieces();

$('#pieces').select2({
    placeholder: 'Selecciona un operario',
    tags: false              
});

$('#pieces').on('change', function() {
    var piece = $("#pieces").val();
    console.log(piece);
    var optionPiece = $("option:selected", '#pieces').text(); 
    console.log(optionPiece);
      
    
    if (optionPiece == 'Seleccione' )
    {
        getChartDataPiece();

    } else {

        getChartDataPiece(optionPiece);       
    }           
}); 

