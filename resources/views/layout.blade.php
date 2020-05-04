<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="@yield('meta-description', 'Este es el blog de Tecind s.a')">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('meta-title', 'Tecind s.a'. " | Blog")</title>
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->
	<link rel="stylesheet" href="/css/normalize.css">
	<link rel="stylesheet" href="/css/framework.css">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/responsive.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">	
	<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
	<link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css"> 
	@stack('styles')

</head>
<body>
	<div id="app">
		<div class="preload"></div>
		<header class="space-inter">
			<div class="container container-flex space-between">
				<figure class="logo"><img src="/img/tecind.png" alt=""></figure>
				@include('partials.nav')
				<!-- <nav class="custom-wrapper" id="menu">
					<div class="pure-menu"></div>
					<ul class="container-flex list-unstyled">
						<li><a href="{{ route('pages.home') }}" class="text-uppercase">Home</a></li>
						<li><a href="{{ route('pages.about') }}" class="text-uppercase">About</a></li>
						<li><a href="{{ route('pages.archive') }}" class="text-uppercase">Archive</a></li>
						<li><a href="{{ route('pages.contact') }}" class="text-uppercase">Contact</a></li>
					</ul>
				</nav> -->
			</div>		
		</header>	 				

		<!-- Contenido --> 
		@yield('content')

		<section class="footer">
			<footer>
				<div class="container">
					<figure class="logo"><img src="/img/tecind.png" alt=""></figure>
					<nav>
						<ul class="container-flex space-center list-unstyled">
							<li>
								<a href="{{ route('pages.home') }}" class="text-uppercase c-white">Inicio</a>
							</li>
							<li>
								<a href="{{ route('pages.about') }}" class="text-uppercase c-white">Nosotros</a>
							</li>
							<li>
								<a href="{{ route('pages.archive') }}" class="text-uppercase c-white">Archivo</a>
							</li>
							<li>
								<a href="{{ route('pages.contact') }}" class="text-uppercase c-white">Contacto</a>
							</li>
						</ul>
					</nav>
					<div class="divider-2"></div>
					<p>Nunc placerat dolor at lectus hendrerit dignissim. Ut tortor sem, consectetur nec hendrerit ut, ullamcorper ac odio. Donec viverra ligula at quam tincidunt imperdiet. Nulla mattis tincidunt auctor.</p>
					<div class="divider-2" style="width: 80%;"></div>
					<p>© 2017 - Zendero. All Rights Reserved. Designed & Developed by <span class="c-white">Agencia De La Web</span></p>
					<ul class="social-media-footer list-unstyled">
						<li><a href="#" class="fb"></a></li>
						<li><a href="#" class="tw"></a></li>
						<li><a href="#" class="in"></a></li>
						<li><a href="#" class="pn"></a></li>
					</ul>
				</div>
			</footer>
		</section>
	</div>
	@stack('scripts')

	 <!-- <script src="{{ asset('js/app.js') }}"></script> -->

	<!-- <script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
	
	<script type="text/javascript">
		var route = "{{ url('search') }}";
		$('#search').typeahead({
			source:  function (term, process) {
			return $.get(route, { term: term }, function (data) {
					return process(data);

				});
			}
					 
		});		
	</script> -->

</body>
</html>