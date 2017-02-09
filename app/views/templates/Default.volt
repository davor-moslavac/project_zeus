<html>
	<head>
		<title>Welcome to Vökuró</title>
		{{ assets.outputCss('style') }}
	</head>
	<body>

		{% include "/components/Header.volt" %}

		<main>
			{% block content %}
			{% endblock %}
		</main>
		
		{% include "/components/Footer.volt" %}

		{{ assets.outputJs('scripts') }}
	</body>

</html>