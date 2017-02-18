{% if level == 'public' %}

<header class="navbar navbar-default">
	<div class="container-fluid">
		
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			{{ link_to(null, 'class': 'navbar-brand', 'Zeus')}}
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				{#
				{%- set menus = [
				'About': 'about'
				] -%}

				{%- for key, value in menus %}
				{% if value == dispatcher.getControllerName() %}
				<li class="active">{{ link_to(value, key) }}</li>
				{% else %}
				<li>{{ link_to(value, key) }}</li>
				{% endif %}
				{%- endfor -%}
				#}
				<!-- Get data from DB -->

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" id="dropdownBrowse" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						Browse
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" aria-labelledby="dropdownBrowse">
						{%- set media = [
						'All': '/media',
						'Movies': '/media/movies',
						'TV Shows': '/media/tvshows',
						'Animes': '/media/animes'
						] -%}

						{%- for key, value in media %}
						{% if value == dispatcher.getControllerName() %}
						<li class="active">{{ link_to(value, key) }}</li>
						{% else %}
						<li>{{ link_to(value, key) }}</li>
						{% endif %}
						{%- endfor -%}
					</ul>
				</li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				
				<form action="#" method="get" class="searchform navbar-form navbar-left" role="search">
					<input type="hidden" value="search" name="view">
					<div class="input-group">
						<input type="text"  name="searchword" required class="form-control" placeholder="Search" name="q">
						<div class="input-group-btn">
							<a href="#" class="btn btn-default dropdown-toggle" id="dropdownSearch" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Category <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownSearch">
								<li><a href="#">All</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">Movies</a></li>
								<li><a href="#">TV Shows</a></li>
								<li><a href="#">Anime</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">Users</a></li>
							</ul>
						</div>
						<div class="input-group-btn">
							<button class="btn btn-default" type="submit">Search</button>
						</div>
					</div>
				</form>
				
				{#
				<form class="navbar-form navbar-left">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>
					<div class="form-group dropdown">
						<a href="#" class="dropdown-toggle" id="dropdownSearch" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							Dropdown
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" aria-labelledby="dropdownSearch">
							<li><a href="#">All</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">Movies</a></li>
							<li><a href="#">TV Shows</a></li>
							<li><a href="#">Anime</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">Users</a></li>
						</ul>
					</div>
					<button id="btnSearch" type="submit" class="btn btn-default">Search</button>
					{{ link_to('search', 'advanced') }}
				</form>
				#}
				{%- if not(logged_in is empty) %}
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" id="dropdownMessages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						Messages
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMessages">
						<li><a href="#">Message #1</a></li>
						<li><a href="#">Message #2</a></li>
						<li><a href="#">Message #3</a></li>
						<li><a href="#">Message #4</a></li>
					</ul>
				</li>
				<li>{{ link_to('users', 'Users Panel') }}</li>
				<li>{{ link_to('session/logout', 'Logout') }}</li>
				{% else %}
				<li>{{ link_to('session/login', 'Login') }}</li>
				{% endif %}
			</ul>
		</div>

	</div>
</header>

{% elseif level == 'private' %}

<header class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			{{ link_to(null, 'class': 'navbar-brand', 'Zeus')}}
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">

				{%- set menus = [
				'Users': 'users',
				'Profiles': 'profiles',
				'Permissions': 'permissions'
				] -%}

				{%- for key, value in menus %}
				{% if value == dispatcher.getControllerName() %}
				<li class="active">{{ link_to(value, key) }}</li>
				{% else %}
				<li>{{ link_to(value, key) }}</li>
				{% endif %}
				{%- endfor -%}

			</ul>
			<ul class="nav navbar-nav navbar-right">          


				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ auth.getName() }} <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>{{ link_to('users/changePassword', 'Change Password') }}</li>
					</ul>
				</li>
				<li>{{ link_to('session/logout', 'Logout') }}</li>
			</ul>
		</div>
	</div>
</header>

{% endif %}