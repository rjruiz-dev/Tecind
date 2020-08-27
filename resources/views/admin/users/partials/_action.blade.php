@can('View users', $usuarios)
    <a href="{{ $url_show }}" class="btn-show" title="Detalle: {{ $usuarios->name}}"><i class="fa fa-eye text-primary"></i></a> | 
@endcan

@can('Update users', $usuarios)
    <a href="{{ $url_edit }}" class="modal-show edit" id="btn-btn-edit" title="Editar: {{ $usuarios->name}}"><i class="fa fa-edit text-success btn-btn-edit-user"></i></a> | 
@endcan

@can('Delete users', $usuarios)
    <a href="{{ $url_destroy }}" class="btn-delete" title="{{ $usuarios->name}}"><i class="fa fa-trash text-danger"></i></a>
@endcan

<!-- class="modal-show edit" -->