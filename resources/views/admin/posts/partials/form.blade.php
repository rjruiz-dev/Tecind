<div class="row">    
    {!! Form::model($post, [
        'route' => $post->exists ? ['admin.posts.update', $post->id] : 'admin.posts.store',   
        'method' => $post->exists ? 'PUT' : 'POST'
    ]) !!}      
    
    <div class="col-md-8">  
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Publicación</h3>
            </div>             
            <div class="box-body">
                {{ csrf_field() }}
                <div class="form-group">                            
                    {!! Form::label('title', 'Titulo de la publicación') !!}                    
                    {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Ingresa aqui el titulo de la publicación']) !!}
                </div>                      

                <div class="form-group">
                    <label>Contenido de la publicación</label>
                    <textarea name="body" id="body" rows="10" class="form-control" placeholder="Ingresa el contenido completo de la publicacion">{{ old('body', $post->body)}}</textarea>
                </div>               
                
                <div class="form-group">
                    <label>Contenido embebido (iframe)</label>
                    <textarea name="iframe" id="iframe" rows="2" class="form-control" placeholder="Ingresa contenido embebido (iframe) de audio o video">{{ old('iframe', $post->iframe)}}</textarea>
                </div>                 
            </div>            
        </div>
    </div>
    <div class="col-md-4">        
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Detalles de la publicación</h3>                
            </div>            
            <div class="box-body">     

                <div class="form-group">
                    <label>Fecha de publicación:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>                      
                        <input name="published_at" 
                            class="form-control pull-right"                                                       
                            value="{{ old('published_at', $post->published_at ? $post->published_at->format('m/d/Y') : null) }}"                            
                            type="text"
                            id="datepicker"
                            placeholder= "Selecciona una fecha">                       
                    </div>                  
                </div>         

                <div class="form-group">  
                    <label>Categorias</label>
                    <select name="category_id" id="category_id" class="form-control select2">
                        <option value="">Selecciona una categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>                   
                </div>

                <div class="form-group">
                    <label>Etiquetas</label>
                    <select name="tags[]" id="tags" class="form-control select2" 
                            multiple="multiple"                            
                            data-placeholder="Selecciona una o mas etiquetas" style="width: 100%;">
                        @foreach($tags as $tag)
                            <option {{ collect( old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }} value="{{ $tag->id}}"> {{ $tag->name }} </option>
                        @endforeach
                    </select>
                </div>              

                <div class="form-group">
                    <label>Extracto de la publicación</label>
                    <textarea name="excerpt" id="excerpt" rows="5" class="form-control" placeholder="Ingresa un extracto de la publicación">{{ old('excerpt', $post->excerpt)}}</textarea>
                </div>

                <div class="form-group">              
                   <div class="dropzone"></div>
                </div>                
            </div>
        </div>
    </div>    
    {!! Form::close() !!}
    @if($post->photos->count()) 
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Imagenes de la publicación</h3>                
                </div> 
                <div class="row box-body">                                    
                    @foreach ($post->photos as $photo)
                        <form  class="col-md-2" method="POST"  title="{{ $photo->id }}" action="{{ route('admin.photos.destroy', $photo) }}">                                           
                            <div>                        
                                <button class="btn btn-danger btn-xs delete" title="{{ $photo->id }}" style="position: absolute">
                                    <i class="fa fa-remove"></i>
                                </button>
                                <img class="img-responsive" src="{{ url($photo->url) }}">
                            </div>                         
                        </form>            
                    @endforeach                              
                </div>
            </div>
        </div>
    @endif              
</div>

<script>
    var myDropzone = new Dropzone('.dropzone', {         
        url: '/admin/posts/{{ $post->url }}/photos',
        paramName: 'photo',
        acceptedFiles: 'image/*',    
        addRemoveLinks: true,
        dictRemoveFile: "Eliminar imagen" ,
        maxFilesize: 3, //2
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        },
        dictDefaultMessage: 'Arrastra las imagenes aqui para subirlas'     
    });          
    

    myDropzone.on('error', function(file, res){       
        var msg = res.errors.photo[0];               
        $('.dz-error-message:last > span').text(msg);
    });

    Dropzone.autoDiscover = false;

    $('.delete').on('click', function (event) {
    event.preventDefault();

    var me = $(this.form),
        url = me.attr('action'),
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
                        $('#modal').modal('hide');                    
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
</script>
