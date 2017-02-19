<div class="row">
	<div class="col-lg-12">
		<h1>{{title}}</h1>
	</div>
</div>

<div class="row">
	{% if router.getControllerName() == "social" %}
	{% for user in users %}
		{% include "components/UserElement.volt" %}
	{% endfor %}
	{% elseif router.getControllerName() == "media" %}
		{% include "components/MediaElement.volt" %}
	{% endif %}
</div>