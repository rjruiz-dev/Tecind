$('body').on('click', '.modal-show', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');     

    $('#modal-title').text(title);
    $('#modal-btn-delete').text(me.hasClass('btn btn-warning') ? '' : 'Cerrar');     
    $('#modal-btn-save').removeClass('hide')
    .text(me.hasClass('edit') ? 'Actualizar' : 'Crear');     

    $.ajax({
        url: url,
        dataType: 'html',
        success: function (response) {
            $('#modal-body').html(response);  
           
            var date = new Date();
            date.setDate(date.getDate());

            $('#datepicker').datepicker({
                autoclose: true,
                todayHighlight: true,
                startDate: date,      
                language: 'es'
            }).datepicker("setDate", new Date()); 
           
            $('#order_id').select2({
                placeholder: 'Selecciona orden',
                tags: false               
            });          

            $('#machine_id').select2({
                placeholder: 'Selecciona maquina cnc',
                tags: true            
            });
                       
            $('#minute').timepicker({
                showInputs: false,                   
                minuteStep: 1,       
                secondStep: 1,         
                showSeconds: true,
                showMeridian: false,
                defaultTime: false                    
            });

            $('#preparation_time').timepicker({
                showInputs: false,                   
                minuteStep: 1,       
                secondStep: 1,         
                showSeconds: true,
                showMeridian: false,
                defaultTime: false                    
            });

            var machine_idSelect = $('#machine_id');            
            var category_maq = $('#category_maq'); 
            var csrf_token = $('meta[name="csrf-token"]').attr('content');   

            machine_idSelect.on('change', function() {                
                var id = $(this).val();               
                obtenerDetalleDeMachine(id)               
            });  

            function obtenerDetalleDeMachine(id) {
                $.ajax({                  
                    url: '/admin/pieces/showMachine/' + id,
                    type: 'GET',
                    data: {            
                        '_token': csrf_token
                    },
                    dataType: 'json',
                    success: function (response) {

                        console.log(response);                       
                        llenarInputsMachine(response);
                    },
                    error: function () { 
                        console.log(error);
                        alert('Hubo un error obteniendo el detalle del legajo!');
                    }
                })
            }

            function llenarInputsMachine(data) {               
                category_maq.val(data.category_maq);                            
            }

            var order_idSelect = $('#order_id');
            var denomination= $('#denomination');
            var code = $('#code');    
            var user = $('#user');      
            var quantity = $('#quantity'); 
            var amount = $('#amount');      
            // var user = $('#user');                          
            var csrf_token = $('meta[name="csrf-token"]').attr('content');    
           
            order_idSelect.on('change', function() {
           
                var id = $(this).val();             
                obtenerDetalleDeTime(id)
               
            });            
        
            function obtenerDetalleDeTime(id) {
                $.ajax({                  
                    url: '/admin/times/' + id,
                    type: 'GET',
                    data: {            
                        '_token': csrf_token
                    },
                    dataType: 'json',
                    success: function (response) {
                    
                        console.log(response);                      
                        llenarInputs(response);
                    },
                    error: function () { 
                        console.log(error);
                        alert('Hubo un error obteniendo el detalle del tiempo!');
                    }
                })
            }
           
            function llenarInputs(data) {
                           
                denomination.val(data.denomination);  
                code.val(data.code);    
                quantity.val(data.quantity);  
                amount.val(data.quantity);                 
                user.val(data.user.name);    
               
            }           
        }
    }); 

    $('#modal').modal('show');      
});


$('#modal-btn-save').click(function (event) {
    event.preventDefault();

    var form = $('#modal-body form'),
        url = form.attr('action'),
        method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';        

    form.find('.help-block').remove();
    form.find('.form-group').removeClass('has-error');
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    
    $.ajax({
        url : url,
        method: method,
        data : form.serialize(),
        success: function (response) {
            form.trigger('reset');
            $('#modal').modal('hide');
            $('#datatable').DataTable().ajax.reload();       
            
            swal({
                type : 'success',
                title : '¡Éxito!',
                text : '¡Se han guardado los datos!'
            });
        },
        error : function (xhr) {
            var res = xhr.responseJSON;
            if ($.isEmptyObject(res) == false) {
                $.each(res.errors, function (key, value) {
                    $('#' + key)
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block"><strong>' + value + '</strong></span>');
                });
            }
        }
    })
});

$('body').on('click', '.btn-delete', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    swal({
        title: '¿Seguro que quieres eliminar a : ' + title + ' ?',
        text: '¡No podrás revertir esto!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, bórralo!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    '_method': 'DELETE',
                    '_token': csrf_token
                },
                success: function (response) {
                    $('#datatable').DataTable().ajax.reload();
                    swal({
                        type: 'success',
                        title: '¡Éxito!',
                        text: '¡Los datos han sido eliminados!'
                    });
                },
                error: function (xhr) {
                    swal({
                        type: 'error',
                        title: 'Ups...',
                        text: '¡Algo salió mal!'
                    });
                }
            });
        }
    });
});

$('body').on('click', '.btn-show', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');

    $('#modal-title').text(title);
    $('#modal-btn-save').addClass('hide');

    $.ajax({
        url: url,
        dataType: 'html',
        success: function (response) {
            $('#modal-body').html(response);
        }
    });

    $('#modal').modal('show');
});