<form class="{% if form.name is defined %}{{form.name}} {% endif %}form-horizontal" {% if form.action is defined %}action="{{form.action}}"{% endif %} method="POST" enctype="multipart/form-data">

{% for element in form %}

	{% set type = form.getType(element) %}
	{% set messages = form.getMessagesFor(element.getName()) %}
	{%  set id = element.getAttribute('id') %}

	{% if type is 'hidden' %}

		{{element}}

	{% elseif type is 'submit' %}
		<div class="form-group form-group-inline">
			<div class="col-xs-12 pad-10">
				<button class="{{element.getAttribute('class')}}" type="submit" {% if id is defined %} id="{{element.getAttribute('id')}}" {% endif %}>{{element.getAttribute('value')}}</button>
			</div>
		</div>

	{% elseif type is 'cancel' %}
		<div class="form-group form-group-inline">
			<div class="col-xs-12 pad-10">
				{{element}}
			</div>
		</div>

	{% elseif type is 'next' %}
		<div class="form-group form-group-inline">
			<div class="col-xs-12 pad-10">
				{{element}}
			</div>
		</div>

	{% elseif type is 'radio' %}

		<div class="form-group">
			<div class="col-xs-12 pad-10">
				<label {% if messages|length > 0 %}class="error" {% endif %}for="{{element.getName()}}">{{element.getLabel()}}{% if messages|length > 0 %} ({% for message in messages %}<?php echo $t->_((string) $message) ?>{% endfor %}) {% endif %}</label>
			</div>
			<div class="btn-group col-xs-12 pad-10" data-toggle="buttons">
				{{element}}
			</div>
		</div>

	{% else %}

		<div class="form-group">
			<div class="col-xs-12 pad-10">
				<label {% if messages|length > 0 %}class="error" {% endif %}for="{{element.getName()}}">{{element.getLabel()}}{% if messages|length > 0 %} ({% for message in messages %}<?php echo $t->_((string) $message) ?>{% endfor %}) {% endif %}</label>
			</div>
			<div class="col-xs-12 pad-10">
				{{element}}
			</div>
		</div>

	{% endif %}

{% endfor %}

</form>
