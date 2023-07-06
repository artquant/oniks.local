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
		<link rel="stylesheet" href="<?php echo CSS ?>main.css">
		<script src="<?php echo JS ?>jquery.js"></script>
		<script src="<?php echo JS ?>aq.js"></script>
		<script src="<?php echo  JS ?>func.js"></script>
		<?php if (Sessions::check('iduser')) : ?>
		<script>
			$(function() {
				$('#header_user_avatar').on('click', function(e) {

					e.stopPropagation();

					if ($('.header-user-popup').css('display') == 'none') {
						$('.header-user-popup').css({display: 'block'}).animate({opacity: 1, top: '-10px'}, 250);
					}
				});

				$('.header-user-popup').bind('click', function(e) {
					e.stopPropagation();
				});

				$(document).bind('click', function(e) {
						if ($('.header-user-popup').css('display') == 'block') {
							$('.header-user-popup').animate({opacity: 0, top: '+10px'}, 250, function() {
								$('.header-user-popup').css({display: 'none'});
							});
						}
					});
			});
		</script>
		<?php endif ?>
	</head>
	<body>
		<header class="header-container fx fx-jc-center fx-ai-stretch">
			<div class="header fx fx-ai-center fx-jc-between fx-wrap">
				<a href="/" class="logo fx-inline"></a>
				<nav class="header-menu">
					<a href="/" class="animate">Главная</a>
					<a href="/afisha" target="_blank" class="animate">Афиша</a>
					<a href="/contacts" target="_blank" class="animate">Контакты</a>
				</nav>
			<?php if (Sessions::check('iduser')): ?>
				<div class="header-user-container fx fx-ai-center pos-rel">
					<span class="header-user-name"><?php echo USER['name'] ?></span>
					<img src="<?php echo AVATAR . USER['avatar'] ?>" alt="" class="user-avatar" id="header_user_avatar">
					<div class="header-user-popup pos-abs">
						<div class="header-user-popup-info fx fx-dir-col fx-ai-center">
							<img src="<?php echo AVATAR . USER['avatar'] ?>" alt="" class="user-avatar">
							<span class="header-user-popup-fullname"><?php echo USER['surname'] ?> <?php echo USER['name'] ?></span>
							<span class="header-user-popup-email"><?php echo USER['email'] ?></span>
							<div class="header-user-popup-bottom-line"></div>
							<nav class="header-user-popup-menu fx fx-dir-col">
							<?php if (USER['access'] == 2) : ?>
								<a href="/account/theatres">
									<span class="header-user-popup-menu-icon"><i class="fa-solid fa-camera-movie"></i></span>
									<span class="header-user-popup-menu-text">Мой кинотеатр</span>
								</a>
								<a href="/account/afisha">
									<span class="header-user-popup-menu-icon"><i class="fa-solid fa-rectangle-vertical-history"></i></span>
									<span class="header-user-popup-menu-text">Мои афиши</span>
								</a>
							<?php endif ?>
							<?php if (USER['access'] == 9) : ?>
								<a href="/admin" target="_blank">
									<span class="header-user-popup-menu-icon"><i class="fa-solid fa-screwdriver-wrench"></i></span>
									<span class="header-user-popup-menu-text">Админка</span>
								</a>
							<?php endif ?>
								<a href="/account">
									<span class="header-user-popup-menu-icon"><i class="fa-solid fa-gear"></i></span>
									<span class="header-user-popup-menu-text">Профиль</span>
								</a>
								<a href="/logout">
									<span class="header-user-popup-menu-icon"><i class="fa-solid fa-circle-xmark"></i></span>
									<span class="header-user-popup-menu-text">Выйти</span>
								</a>
							</nav>
						</div>
					</div>
				</div>
			<?php else : ?>
				<a href="/auth" class="auth-icon"><i class="fa-regular fa-right-to-bracket"></i></a>
			<?php endif ?>
			</div>
		</header>
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