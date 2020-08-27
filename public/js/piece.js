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
                   
            $('#machine_id').select2({
                placeholder: 'Selecciona maquina cnc',
                tags: true            
            });  
                  
            $('#order_id').select2({
                placeholder: 'Nombre',
                tags: true,
                tokenSeparators: [',']
            }); 

            $('#part_piece').select2({
                placeholder: 'Parte',
                tags: true,
                tokenSeparators: [',']
            });  

            $('#tools').select2({
                tags: true
            });
            
            $('#number_gag').select2({
                placeholder: 'Selecciona número',
                tags: false,              
            }); 
                
            $("#code").keyup(function () {
                var value = $(this).val();
                $("#name_program").val(value);
            });

            $("#part_piece").change(function(){
                var val = $(this).val();             
                $("#part_program").val(val);
            });

            $("#code").inputmask("9999-9999-9/9", {         
                "clearIncomplete": true
            });
            $("#name_program").inputmask("9999-9999-9/9", {
                "clearIncomplete": true
            });
            $("#number_program").inputmask("9999", {
                "clearIncomplete": true
            });
            $("#number_gag").inputmask("999", {
                "clearIncomplete": true
            });
            // $("#diameter").inputmask("999", {
            //     "clearIncomplete": true
            // });
            $('#time').timepicker({
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
                     
            var number_gagSelect = $('#number_gag');            
            var diameter = $('#diameter');    
            var type_gag = $('#type_gag');    
            var category_gag = $('#category_gag');   
            var csrf_token = $('meta[name="csrf-token"]').attr('content');    
           
            number_gagSelect.on('change', function() {                
                var id = $(this).val();               
                obtenerDetalleDeGag(id)               
            }); 
            
            function obtenerDetalleDeGag(id) {
                $.ajax({                  
                    url: '/admin/pieces/showGag/' + id,
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
                        alert('Hubo un error obteniendo el detalle del legajo!');
                    }
                })
            }
           
            function llenarInputs(data) {                
                diameter.val(data.diameter);     
                type_gag.val(data.type_gag);     
                category_gag.val(data.category_gag);                            
            }   
            
            var order_idSelect = $('#order_id');            
            var code = $('#code');
            var user = $('#user');
            var name_program = $('#name_program');
            
           order_idSelect.on('change', function() {                
                var id = $(this).val();               
                obtenerDetalleDeOrder(id)               
            });

            function obtenerDetalleDeOrder(id) {
                $.ajax({                  
                    url: '/admin/pieces/showOrder/' + id,
                    type: 'GET',
                    data: {            
                        '_token': csrf_token
                    },
                    dataType: 'json',
                    success: function (response) {

                        console.log(response);                       
                        llenarInputsOrder(response);
                    },
                    error: function () { 
                        console.log(error);
                        alert('Hubo un error obteniendo el detalle del legajo!');
                    }
                })
            }

            function llenarInputsOrder(data) {                
                code.val(data.code);   
                name_program.val(data.code); 
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

function refresh_graph(){
    //     url: '/admin/dashboard/getOrders/'+ $('#select_users').val()+'/'+$('#select_status').val()+'/0',
}

$('#select_status').change(function(){
    refresh_graph();
})

// $(this).val()
$('#select_users').change(function(){
    refresh_graph();
    // vue.getOperarios($(this).val());

    // $.ajax({
    //     // url: 'companies/' + id,
    //     url: '/admin/dashboard/getOrders/'+ $(this).val()+'/0/0',
    //     type: 'GET',
    //     data: {            
    //         '_token': 'csrf_token'
    //     },
    //     dataType: 'json',
    //     success: function (response) {
    //         // acá podés loguear la respuesta del servidor
    //         // console.log(response);
    //         alert(response);
            
    //     },
    //     error: function () { 
    //         console.log(error);
    //         alert('Hubo un error obteniendo!');
    //     }
    // })
    
});


