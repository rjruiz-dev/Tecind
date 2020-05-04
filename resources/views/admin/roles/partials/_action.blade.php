@can('update', $roles)
    <a href="{{ $url_edit }}" class="modal-show edit" id="btn-btn-edit" title="Editar: {{ $roles->name}}"><i class="fa fa-edit text-success"></i></a> | 
@endcan

@can('delete', $roles)
    @if($roles->id !==1) 
        <a href="{{ $url_destroy }}" class="btn-delete" title="{{ $roles->name}}"><i class="fa fa-trash text-danger"></i></a>
    @endif
@endcan

