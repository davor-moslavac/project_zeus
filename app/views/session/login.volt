{{ content() }}

<div class="row">
	<div class="col-lg-12">
		<h2>Login</h2>
	</div>
	<div class="col-sm-12">
		<h3>Connect with us</h3>
		<div>
			<div>{{ link_to('session/loginSocial/Facebook', 'Facebook') }}</div>
            <div>{{ link_to('session/loginSocial/Twitter', 'Twitter') }}</div>
            <div>{{ link_to('session/loginSocial/Google', 'Google') }}</div>
		</div>
	</div>

	<div class="col-lg-12">
		
		{% include "components/Form.volt" %}
		
	</div>
</div>