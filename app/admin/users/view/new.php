<?php echo $this->reqContent($req_content) ?>
<div class="main-content">
	<div class="form-container">
		<div class="page-title-container">
			<?php echo Ajax::url('/admin/users', '&laquo; Вернуться назад') ?>
			<span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Создание пользователя</span>
		</div>
		<form action="/admin/users/add" method="POST" onsubmit="return formSubmit(this)">
			<div class="form-element-container">
				<div class="placeholder">Имя</div>
				<input type="text" name="name" id="name" class="form-element">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Фамилия</div>
				<input type="text" name="surname" id="surname" class="form-element">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Email</div>
				<input type="text" name="email" id="email" class="form-element">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Пароль</div>
				<input type="password" name="password" id="password" class="form-element">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Повторите пароль</div>
				<input type="password" name="replay_password" id="replay_password" class="form-element">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Телефон</div>
				<input type="text" name="phone" id="phone" class="form-element">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Кинотеатр</div>
				<select name="theatres" id="theatres" class="form-element full">
					<option value="0">Нет</option>
				<?php foreach ($theatres as $cinema) : ?>
					<option value="<?php echo $cinema->id ?>"><?php echo $cinema->name ?></option>
				<?php endforeach ?>
				</select>
			</div>
			<div class="form-element-container">
				<div class="placeholder">Доступ</div>
				<select name="access" id="access" class="form-element full">
				<?php foreach ($user_access as $key => $value) : ?>
					<option value="<?php echo $key ?>"><?php echo $value ?></option>
				<?php endforeach ?>
				</select>
			</div>
			<div class="form-element-container fx fx-jc-center">
				<button type="submit" class="form-element full">
					<span>Сохранить</span>
				</button>
			</div>
		</form>
	</div>
</div>
<script>
	$('#theatres, #access').aq('select', {
		width: '100%',
		height: '44px'
	});
</script>