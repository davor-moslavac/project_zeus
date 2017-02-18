<!DOCTYPE html>
<html>
	<head>

		{% include "scripts/googleAds.volt" %}

		<title>Media Ratings</title>
   		{{ assets.outputCss('style') }}
	</head>
	<body>

		{{ content() }}

		{{ assets.outputJs('scripts') }}
	</body>
</html>