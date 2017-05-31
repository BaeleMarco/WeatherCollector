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

	//not dynamic because on first load $page is going to be empty
	require_once('pages/body_index.php');

	require_once('pages/footer.php');
?>
</body>
</html>