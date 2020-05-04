<nav class="custom-wrapper" id="menu">
    <div class="pure-menu"></div>
    <ul class="container-flex list-unstyled">     
        <li>
            <a href="{{ route('pages.home') }}" 
                class="text-uppercase {{ request()->routeIs('pages.home') ? 'active' : '' }}">
                Inicio
            </a>
        </li>
        <li>
            <a href="{{ route('pages.about') }}" class="text-uppercase {{ request()->routeIs('pages.about') ? 'active' : '' }}">
                Nosotros
            </a>
        </li>
        <li>
            <a href="{{ route('pages.archive') }}" class="text-uppercase {{ request()->routeIs('pages.archive') ? 'active' : '' }}">
                Archivo
            </a>
        </li>
        <!-- <li>
            <a href="{{ route('pages.contact') }}" class="text-uppercase {{ request()->routeIs('pages.contact') ? 'active' : '' }}">
                Contacto
            </a>
        </li>  -->
        <li>
            {!! Form::open(['route' => 'pages.search', 'method' => 'GET', 'class' => 'sidebar-form', 'role' =>'search']) !!}			
			<div class="input-group">
			    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Titulo de Post']) !!}			
				<span class="input-group-btn">
					<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		    {!! Form::close() !!}            
        </li>       
    </ul>    
</nav>





   
    
