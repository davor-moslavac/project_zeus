<form class="{% if form.name is defined %}{{form.name}} {% endif %}form-horizontal" action="{{form.getAction()}}" method="POST" enctype="multipart/form-data">

{% for element in form %}

	{% set type = form.getType(element) %}
	{% set messages = form.getMessagesFor(element.getName()) %}
	{%  set id = element.getAttribute('id') %}

	{% if type is 'hidden' %}

		{{element}}

	{% elseif type is 'submit' %}
		<div class="form-group {% if messages|length > 0 %} has-error{% endif %}">
			<div class="col-lg-offset-3 col-lg-9 col-md-offset-3 col-md-9 col-sm-offset-4 col-sm-8 col-xs-offset-0 col-xs-12">
				<button class="{{element.getAttribute('class')}}" type="submit" {% if id is defined %} id="{{element.getAttribute('id')}}" {% endif %}>{{element.getAttribute('value')}}</button>
			</div>
		</div>

	{% elseif type is 'radio' %}

		<div class="form-group {% if messages|length > 0 %} has-error{% endif %}">
			<div class="col-xs-12">
				<label for="{{element.getName()}}">{{element.getLabel()}}{% if messages|length > 0 %} ({% for message in messages %}{{message}}{% endfor %}) {% endif %}</label>
			</div>
			<div class="btn-group col-xs-12" data-toggle="buttons">
				{{element}}
			</div>
		</div>

	{% elseif type is 'checkbox' %}

		<div data-id="{{element.getLabel()}}" class="form-group {% if messages|length > 0 %} has-error{% endif %}">
			<div class="col-xs-12">
				<label for="{{element.getName()}}">{{element.getLabel()}}{% if messages|length > 0 %} ({% for message in messages %}{{message}}{% endfor %}) {% endif %}</label>
			</div>
			<div class="btn-group col-xs-12" data-toggle="buttons">
				{{element}}
			</div>
		</div>

	{% elseif type is 'check' %}
		<div class="form-group {% if messages|length > 0 %} has-error{% endif %}">
			<div class="col-lg-offset-3 col-lg-9 col-md-offset-3 col-md-9 col-sm-offset-4 col-sm-8 col-xs-offset-0 col-xs-12">
				<div class="checkbox">
					<label>
						{{element}} {{element.getLabel()}}
					</label>
				</div>
			</div>
		</div>

	{% else %}

		<div class="form-group {% if messages|length > 0 %} has-error{% endif %}">

			<label class="col-lg-3 col-md-3 col-sm-4 col-xs-12 control-label {% if messages|length > 0 %} error {% endif %}" for="{{element.getName()}}">{{element.getLabel()}}{% if messages|length > 0 %} ({% for message in messages %}{{message}}{% endfor %}) {% endif %}</label>

			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
				{{element}}
			</div>
		</div>

	{% endif %}

{% endfor %}

</form>
