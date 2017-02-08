<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Vökuró</title>
		<link href="/third-party/css/bootstrap.min.css" rel="stylesheet">
		{{ stylesheet_link('css/style.css') }}
	</head>
	<body>

		{% include "components/Header.volt" %}

		{{ content() }}

		<script src="/third-party/js/jquery-3.1.1.min.js"></script>
		<script src="/third-party/js/bootstrap.min.js"></script>
	</body>
</html>