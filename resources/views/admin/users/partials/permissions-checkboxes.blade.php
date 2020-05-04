@foreach( $permissions as $id => $name )


<div class="checkbox col-sm-6">
    <label>
        <input name="permissions[]" type="checkbox" value="{{ $name }}"
            {{ $user->permissions->contains($id) ? 'checked':'' }}>                            
        {{ $name }}                           
    </label>   
</div>  
  
  
@endforeach 
