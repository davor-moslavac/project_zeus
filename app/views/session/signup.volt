{{ content() }}

<div class="row">
	<div class="col-lg-12">
		<h2>Sign Up</h2>
	</div>
	
	<div class="col-lg-12">
		
		{{ form('class': 'form-horizontal') }}

		<div class="form-group">
			<div class="col-lg-2">{{ form.label('name') }}</div>
			<div class="col-lg-10">
				{{ form.render('name') }}
				{{ form.messages('name') }}
			</div>
		</div>
		<div class="form-group">
			<div class="col-lg-2">{{ form.label('email') }}</div>
			<div class="col-lg-10">
				{{ form.render('email') }}
				{{ form.messages('email') }}
			</div>

		</div>
		<div class="form-group">
			<div class="col-lg-2">{{ form.label('password') }}</div>
			<div class="col-lg-10">
				{{ form.render('password') }}
				{{ form.messages('password') }}
			</div>

		</div>
		<div class="form-group">
			<div class="col-lg-2">{{ form.label('confirmPassword') }}</div>
			<div class="col-lg-10">
				{{ form.render('confirmPassword') }}
				{{ form.messages('confirmPassword') }}
			</div>

		</div>
		<div class="form-group">
			<div class="col-lg-12">
				{{ form.render('terms') }} {{ form.label('terms') }}
				{{ form.messages('terms') }}
				</div>
		</div>
		<div class="form-group">
			<div class="col-lg-12">
				{{ form.render('Sign Up') }}
			</div>
			
		</div>

		{{ form.render('csrf', ['value': security.getToken()]) }}
		{{ form.messages('csrf') }}	

		</form>
	</div>
</div>

