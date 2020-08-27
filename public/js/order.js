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

            $('#date').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy',          
                startDate: date,              
                language: 'es'
            });   
            
            $('#motivo').css('display', 'none');
            
            $('#status').change( function() {
                if( $(this).val() === '3'){
                    $('#motivo').css('display', 'inline');
                   
                }else{
                    $('#motivo').css('display', 'none');
                }
            });

            $('#name_company').select2({
                placeholder: 'Selecciona un cliente',
                tags: false ,                   
            });

            $('#status').select2({
                placeholder: 'Selecciona un estado',
                tags: false              
            });
                        
            $('#denomination').select2({
                placeholder: 'Selecciona un producto',
                tags: true,
                tokenSeparators: [',']
            });

            $('#name').select2({
                placeholder: 'Selecciona un operario',
                tags: true,
                tokenSeparators: [',']
            });

            $("#code").inputmask("9999-9999-9/9", {         
                "clearIncomplete": true
            });

            $("#order").inputmask("999999", {         
                "clearIncomplete": true
            });
            
            var name_companySelect = $('#name_company');
            var phone_company = $('#phone_company');
            var name_client = $('#name_client');
            var phone_client = $('#phone_client');
            var email = $('#email');            
            var csrf_token = $('meta[name="csrf-token"]').attr('content');    
            // console.log (name_companySelect);
            name_companySelect.on('change', function() {
                // console.log ('la compañía ha cambiado');
                var id = $(this).val();
                // console.log('id del Company seleccionado: ' + id);
                obtenerDetalleDeCompany(id)
               
            });            
        
            function obtenerDetalleDeCompany(id) {
                $.ajax({
                    // url: 'companies/' + id,
                    url: '/admin/orders/' + id,
                    type: 'GET',
                    data: {            
                        '_token': csrf_token
                    },
                    dataType: 'json',
                    success: function (response) {
                        // acá podés loguear la respuesta del servidor
                        console.log(response);
                        // le pasás la data a la función que llena los otros inputs
                        llenarInputs(response);
                    },
                    error: function () { 
                        console.log(error);
                        alert('Hubo un error obteniendo el detalle de la Compañía!');
                    }
                })
            }
           
            function llenarInputs(data) {
                // $clientes->company['phone_company']
                phone_company.val(data.company.phone_company);  
                name_client.val(data.name_client);    
                phone_client.val(data.phone_client);    
                email.val(data.email);    
            } 
            
            var denomination_Select = $('#denomination');            
            var code = $('#code');
                        
            denomination_Select.on('change', function() {                
                var id = $(this).val();               
                obtenerDetalleDeOrder(id)               
            });

            function obtenerDetalleDeOrder(id) {
                $.ajax({                  
                    url: '/admin/orders/showOrder/' + id,
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


