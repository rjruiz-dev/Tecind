@can('view', $posts)
    <a href="{{ $url_show }}" title="Detalle: {{ $posts->title}}" target="_blank"><i class="fa fa-eye text-primary"></i></a> | 
@endcan

@can('update', $posts)
    <a href="{{ $url_edit }}" class="modal-show edit" title="Editar: {{ $posts->title}}"><i class="fa fa-edit text-success"></i></a> | 
@endcan

@can('delete', $posts)
    <a href="{{ $url_destroy }}" class="btn-delete" title="Eliminar: {{ $posts->title}}"><i class="fa fa-trash text-danger"></i></a>
@endcan

