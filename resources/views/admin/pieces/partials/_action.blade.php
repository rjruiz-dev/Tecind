@can('view', $pieces)
    <a href="{{ $url_show }}" title="Detalle: {{ $pieces->order['denomination'] }}" target="_blank"><i class="fa fa-eye text-primary"></i></a> | 
@endcan

@can('update', $pieces)
   <a href="{{ $url_edit }}" class="modal-show edit" title="Editar: {{ $pieces->order['denomination'] }}"><i class="fa fa-edit text-success"></i></a> |  
@endcan


    


