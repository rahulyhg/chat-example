<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="/css/bootstrap-theme.min.css"/>
	<link rel="stylesheet" href="/base.css"/>
	<link rel="stylesheet" href="/style.css"/>
</head>
<body>
	<div id="app"><app /></div>
	<script>
		var apiUrl = 'http://localhost:8905';
		var modules = {}
	</script>
	<script src="/vue.js"></script>
	<script src="/vuex.js"></script>
	<script src="/vueCookie.js"></script>
	<script src="/jquery.min.js"></script>
	<script src="/moment.min.js"></script>
	<script src="/dot-object.min.js"></script>
	<script>
		window.moment = modules.moment
	</script>
	<script src="/app.js?<?= filemtime(__DIR__ . '/app.js'); ?>"></script>
</body>
</html>