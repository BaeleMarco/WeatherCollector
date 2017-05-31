<!DOCTYPE html>
<html>
<head>
	<?php
		$title = "WeatherCollector";
		require_once('pages/head.php');
		require_once('php/functions.php');
	?>
</head>
<body>
<?php
	$page = returnPageName("$_SERVER[REQUEST_URI]");
	require_once('pages/header.php');

	?>
		<h1 class="center">What‽</h1>
		<p class="center">Your browser did something unexpected. Please contact us if the problem persists.</p>
	<?php

	require_once('pages/footer.php');
?>
</body>
</html>