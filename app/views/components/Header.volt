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
				'Home': 'index',
				'About': 'about'
				] -%}

				{%- for key, value in menus %}
				{% if value == dispatcher.getControllerName() %}
				<li class="active">{{ link_to(value, key) }}</li>
				{% else %}
				<li>{{ link_to(value, key) }}</li>
				{% endif %}
				{%- endfor -%}

			</ul>
			

			<form class="navbar-form navbar-left">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>

			<ul class="nav navbar-nav navbar-right">
				{%- if not(logged_in is empty) %}
				<li>{{ link_to('users', 'Users Panel') }}</li>
				<li>{{ link_to('session/logout', 'Logout') }}</li>
				{% else %}
				<li>{{ link_to('session/login', 'Login') }}</li>
				{% endif %}
			</ul>
		</div>
	</div>
</header>