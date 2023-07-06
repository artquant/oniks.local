<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name=viewport content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<title><?php echo $title ?></title>
		<meta name="description" content="<?php echo $des ?>">
		<meta name="keywords" content="<?php echo $key ?>">
		<meta property="og:type" content="website">
		<meta property="og:site_name" content="<?php echo SITENAME ?> Афиша">
		<meta property="og:url" content="<?php echo Request::protocol() . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">
		<meta property="og:title" content="<?php echo $title ?>">
		<meta property="og:description" content="<?php echo $des ?>">
		<link rel="stylesheet" href="<?php echo FONTS ?>awesome/all.min.css">
		<link rel="stylesheet" href="<?php echo FONTS ?>gilroy/gilroy.css">
		<link rel="stylesheet" href="<?php echo CSS ?>aq.css">
		<link rel="stylesheet" href="<?php echo CSS ?>aqUI.css">
		<link rel="stylesheet" href="<?php echo CSS ?>afisha.css">
		<script src="<?php echo JS ?>jquery.js"></script>
		<script src="<?php echo JS ?>aq.js"></script>
		<script src="<?php echo  JS ?>func.js"></script>
		<script>
			$(function() {
				dateTime('#date_time');

				$('.calendar-afisha-day .afisha-link').on('click', function() {
					$('.calendar-afisha-day').children().removeClass('active');
					$(this).addClass('active');
				});
			});
		</script>
	</head>
	<body>
		<header class="header-container fx fx-jc-center fx-ai-stretch">
			<div class="header fx fx-ai-center fx-jc-between fx-wrap">
				<a href="/" class="home-link"><i class="fa-duotone fa-house-laptop"></i></a>
				<?php echo Ajax::url('/afisha', null, ['class' => 'logo fx-inline']) ?>
				<div class="date-time" id="date_time"></div>
			</div>
		</header>
		<div class="calendar-afisha-container fx fx-dir-col fx-ai-center">
			<div class="calendar-afisha-title">Афиша событий в ДНР</div>
			<div class="calendar-afisha fx fx-wrap">
				<?php echo CalendarAfisha::html($_GET['date'] ?? date('Y-m-d'), 6, 15) ?>
			</div>
		</div>
		<main class="app" id="app">
			<?php echo $content ?>
		</main>
		<footer class="footer fx fx-ai-stretch">
			<div class="footer-container fx fx-jc-between fx-ai-center">
				<div class="footer-media">
					<span class="footer-meta-copy">&copy; 2023</span>
					<span class="footer-meta-site">ONIKS - медия сервис</span>
				</div>
				<div class="footer-author">Разработка<span class="footer-name-author"><a href="https://vk.com/id118522128" target="_blank"><i class="fa-brands fa-vk"></i> ARTQUANT</a></span></div>
			</div>
		</footer>
	</body>
</html>