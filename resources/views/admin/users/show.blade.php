<div class="row">
    <div class="col-md-4">    
        <div class="box box-primary">        
            <div class="box-body box-profile">            
                <img class="profile-user-img img-responsive img-circle" 
                    src="/adminlte/img/user4-128x128.jpg" 
                    alt="{{ $user->name}}">
                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                
                <p class="text-muted text-center">{{ $user->getRoleNames()->implode(', ') }}</p>
                
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Email</b> <a class="pull-right">{{ $user->email }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Publicaciónes</b> <a class="pull-right">{{ $user->posts->count() }}</a>
                    </li>
                    @if ($user->roles->count())                    
                        <li class="list-group-item">
                            <b>Roles</b> <a class="pull-right">{{ $user->getRoleNames()->implode(', ') }}</a>
                        </li>
                    @endif                    
                </ul>
                <!-- <a href="#" class="btn btn-primary btn-block"><b>Editar</b></a> -->
            </div>
        <!-- /.box-body -->
        </div>
    </div> 
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Publicaciónes</h3>
            </div>
            <div class="box-body">
                @forelse($user->posts as $post)
                    <a href="{{ route('posts.show', $post) }}" target="_blank">
                        <strong>{{ $post->title }}</strong>
                    </a>
                    <br>
                    <small class="text-muted">Publicado el {{ $post->published_at->format('d/m/Y') }}</small>
                    <P class="text-muted">{{ $post->excerpt }}</P>
                    @unless($loop->last)
                        <hr>
                    @endunless 
                @empty
                    <small class="tex-muted">No tiene ninguna publicación</small>                        
                @endforelse
            </div>
        </div>
    </div>       
    <div class="col-md-2">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Roles</h3>
            </div>
            <div class="box-body">
                @forelse($user->roles as $role)
                    <strong>{{ $role->name }}</strong>
                    @if ( $role->permissions->count() )
                        <br>                     
                        <small class="text-muted">Permisos: {{ $role->permissions->pluck('display_name')->implode(', ') }}</small>
                        
                    @endif                   
                    @unless ($loop->last)
                        <hr>
                    @endunless
                @empty
                    <small class="tex-muted">No tiene ningún rol asignado</small>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Permisos adicionales</h3>
            </div>
            <div class="box-body">
                @forelse($user->permissions as $permission)
                    <strong>{{ $permission->name}}</strong>                    
                    @unless ($loop->last)
                        <hr>
                    @endunless
                @empty
                <small class="text-muted">No tiene permisos adicionales</small>
                @endforelse
            </div>
        </div>
    </div>  
</div>
    


