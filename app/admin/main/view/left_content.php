<?php

$url = explode('/', trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/'));

$class_main = (!isset($url[1])) ? ['class' => 'active'] : [];
$class_users = (isset($url[1]) AND $url[1] == 'users') ? ['class' => 'active'] : [];
$class_premieres = (isset($url[1]) AND $url[1] == 'premieres') ? ['class' => 'active'] : [];
$class_theatres = (isset($url[1]) AND $url[1] == 'theatres') ? ['class' => 'active'] : [];
$class_afisha = (isset($url[1]) AND $url[1] == 'afisha') ? ['class' => 'active'] : [];

?>
<div class="left-container fx fx-dir-col fx-ai-center fx-jc-between">
	<div class="header-admin">
		<div class="header-admin-avatar">
			<img src="<?php echo AVATAR . USER['avatar'] ?>" alt="" width="60" height="60">
		</div>
		<div class="admin-name"><?php echo USER['name'] ?></div>
	</div>
	<nav class="admin-menu fx fx-dir-col fx-jc-center">
		<?php echo Ajax::url('/admin', '<i class="fa-solid fa-house-day"></i>Главная', $class_main) ?>
		<?php echo Ajax::url('/admin/users', '<i class="fa-solid fa-users-gear"></i>Пользователи', $class_users) ?>
		<?php echo Ajax::url('/admin/premieres', '<i class="fa-solid fa-film-simple"></i>Премьеры', $class_premieres) ?>
		<?php echo Ajax::url('/admin/theatres', '<i class="fa-solid fa-camera-movie"></i>Кинотеатры', $class_theatres) ?>
		<?php echo Ajax::url('/admin/afisha', '<i class="fa-solid fa-rectangle-vertical-history"></i>Афиша', $class_afisha) ?>
	</nav>
	<div class="left-container-footer">

	</div>
</div>