<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name=viewport content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<title><?php echo $title ?></title>
		<link rel="stylesheet" href="<?php echo FONTS ?>awesome/all.min.css">
		<link rel="stylesheet" href="<?php echo FONTS ?>gilroy/gilroy.css">
		<link rel="stylesheet" href="<?php echo CSS ?>aq.css">
		<link rel="stylesheet" href="<?php echo CSS ?>aqUI.css">
		<link rel="stylesheet" href="<?php echo CSS ?>admin.css">
		<script src="<?php echo JS ?>jquery.js"></script>
		<script src="<?php echo JS ?>maskedinput.js"></script>
		<script src="<?php echo JS ?>aq.js"></script>
		<script src="<?php echo JS ?>func.js"></script>
	</head>
	<body>
		<main class="app" id="app">
			<?php echo $content ?>
		</main>
	</body>
</html>