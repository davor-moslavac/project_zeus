<!DOCTYPE html>
<html>
	<head>
		<title>Welcome</title>
   		{{ assets.outputCss('style') }}
	</head>
	<body>

		{{ content() }}

		{{ assets.outputJs('scripts') }}
	</body>
</html>