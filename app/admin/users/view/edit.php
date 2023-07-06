<?php echo $this->reqContent($req_content) ?>
<div class="main-content">
	<div class="form-container">
		<div class="page-title-container">
			<?php echo Ajax::url('/admin/users', '&laquo; Вернуться назад') ?>
			<span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Редактирование пользователя</span>
		</div>
		<?php if ($user): ?>
		<form action="/admin/users/save" method="POST" onsubmit="return formSubmit(this)">
			<input type="text" name="id" value="<?php echo $user->id ?>" class="dp-none">
			<div class="form-element-container">
				<div class="placeholder">Имя</div>
				<input type="text" name="name" id="name" class="form-element" value="<?php echo $user->name ?>">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Фамилия</div>
				<input type="text" name="surname" id="surname" class="form-element" value="<?php echo $user->surname ?>">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Email</div>
				<input type="text" name="email" id="email" class="form-element" value="<?php echo $user->email ?>">
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
				<input type="text" name="phone" id="phone" class="form-element" value="<?php echo $user->phone ?>">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Кинотеатр</div>
				<select name="theatres" id="theatres" class="form-element full">
					<option value="0">Нет</option>
				<?php foreach ($theatres as $cinema) : ?>
					<option value="<?php echo $cinema->id ?>"<?php if ($user->theatres_id == $cinema->id) echo ' selected' ?>><?php echo $cinema->name ?></option>
				<?php endforeach ?>
				</select>
			</div>
			<div class="form-element-container">
				<div class="placeholder">Доступ</div>
				<select name="access" id="access" class="form-element full">
				<?php foreach ($user_access as $key => $value) : ?>
					<option value="<?php echo $key ?>"<?php if ($user->access == $key) echo ' selected' ?>><?php echo $value ?></option>
				<?php endforeach ?>
				</select>
			</div>
			<div class="form-element-container">
				<label for="isBlock" class="aqUI-checkbox">
					<input type="checkbox" id="isBlock" name="isBlock"<?php if ($user->isBlock) echo ' checked' ?>>
					<?php if ($user->isBlock): ?>
					<span>Разблокировать</span>
					<?php else : ?>
					<span>Заблокировать</span>
					<?php endif ?>
				</label>
			</div>
			<div class="form-element-container fx fx-jc-center">
				<button type="submit" class="form-element full">
					<span>Сохранить</span>
				</button>
			</div>
		</form>
		<?php else : ?>
			<?php echo Message::nothingFound('Произошла ошибка! Пользователь не найден', false) ?>
		<?php endif ?>
	</div>
</div>
<script>
	$('#theatres, #access').aq('select', {
		width: '100%',
		height: '44px'
	});
</script>