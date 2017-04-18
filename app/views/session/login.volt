{{ content() }}

<div class="row">
	<div class="col-lg-12">
		<h2>Login</h2>
	</div>

	<div class="col-lg-12">
		
		{% include "components/Form.volt" %}
		
	</div>

	<div class="col-lg-12">
		<h3>Social login</h3>
		<div class="text-center">
			{{ link_to('session/loginSocial/Facebook', 'class': 'btn btn-social btn-facebook', '<i class="fa fa-facebook"></i>Sign in with Facebook') }}
            {{ link_to('session/loginSocial/Twitter', 'class': 'btn btn-social btn-twitter', '<i class="fa fa-twitter"></i>Sign in with Twitter') }}
            {{ link_to('session/loginSocial/Google', 'class': 'btn btn-social btn-google', '<i class="fa fa-google"></i>Sign in with Google') }}
		</div>
	</div>
</div>