{{ content() }}

<div class="row">
	<div class="col-lg-9 col-lg-offset-3 col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-6 col-xs-12 col-xs-offset-0">
		<h2>Login</h2>
	</div>

	<div class="col-lg-12">
		
		{% include "components/Form.volt" %}
		
	</div>

	<div class="col-lg-9 col-lg-offset-3 col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-6 col-xs-12 col-xs-offset-0">
		<h3>Social login</h3>
		<div>
			{{ link_to('session/loginSocial/Facebook', 'class': 'btn btn-social btn-facebook', '<i class="fa fa-facebook"></i>Sign in with Facebook') }}
            {{ link_to('session/loginSocial/Twitter', 'class': 'btn btn-social btn-twitter', '<i class="fa fa-twitter"></i>Sign in with Twitter') }}
            {{ link_to('session/loginSocial/Google', 'class': 'btn btn-social btn-google', '<i class="fa fa-google"></i>Sign in with Google') }}
		</div>
	</div>
</div>