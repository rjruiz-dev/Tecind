@can('Update orders', $ordenes)
| <a href="{{ $url_edit }}" class="modal-show edit" title="Editar:  {{ $ordenes->denomination }} | {{ $ordenes->code }}"><i class="fa fa-edit text-success"></i></a> | 
@endcan