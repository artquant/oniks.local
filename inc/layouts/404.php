<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name=viewport content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<title><?php echo $title ?></title>
		<link rel="icon" href="favicon.svg">
		<link rel="stylesheet" href="<?php echo FONTS ?>awesome/all.min.css">
		<link rel="stylesheet" href="<?php echo FONTS ?>gilroy/gilroy.css">
		<link rel="stylesheet" href="<?php echo CSS ?>404.css">
	</head>
	<body>
		<main class="app" id="app">
			<?php echo $content ?>
		</main>
	</body>
</html>