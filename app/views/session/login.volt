{{ content() }}

<div class="row">
	<div class="col-lg-12">
		<h2>Login</h2>
	</div>
	
	<div class="col-lg-12">
		
		{{ form('class': 'form-horizontal') }}

		<div class="form-group">
			<div class="col-lg-12">
				{{ form.render('email') }}
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-12">
				{{ form.render('password') }}
			</div>

		</div>
		<div class="form-group">
			<div class="col-lg-12">
				{{ form.render('go') }}
			</div>

		</div>
		<div class="form-group">
			<div class="col-lg-2">{{ form.label('remember') }}</div>
			<div class="col-lg-10">
				{{ form.render('remember') }}
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-12">
				{{ link_to("session/forgotPassword", "Forgot my password") }}
			</div>
		</div>

		{{ form.render('csrf', ['value': security.getToken()]) }}

		</form>
	</div>
</div>