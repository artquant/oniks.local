<?php echo $this->reqContent($req_content) ?>
<div class="main-content">
<?php if ($cinema) : ?>
	<div class="form-container">
		<div class="page-title-container">
			<?php echo Ajax::url('/admin/theatres', '&laquo; Вернуться назад') ?>
			<span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Редактирование кинотеатра</span>
		</div>
		<form action="/admin/theatres/save" method="POST" id="auth-form" onsubmit="return formSubmit(this)">
			<input type="text" name="id" value="<?php echo $cinema->id ?>" class="dp-none">
			<div class="form-element-container">
				<div class="placeholder">Название кинотеатра</div>
				<input type="text" name="name" id="name" class="form-element" value="<?php echo $cinema->name ?>">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Адрес</div>
				<input type="text" name="city" id="city" class="form-element" value="<?php echo $cinema->city ?>">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Адрес</div>
				<input type="text" name="address" id="address" class="form-element" value="<?php echo $cinema->address ?>">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Телефон</div>
				<input type="text" name="phone" id="phone" class="form-element" value="<?php echo $cinema->phone ?>">
			</div>
			<div class="form-element-container">
					<div class="placeholder">Название залов (через запятую)</div>
					<input type="text" name="halls_name" id="halls_name" class="form-element" value="<?php echo $cinema->halls_name ?>">
				</div>
			<div class="form-element-container fx fx-jc-center">
				<button type="submit" class="form-element full">
					<span>Сохранить</span>
				</button>
			</div>
		</form>
	</div>
	<script>
		$('#phone').mask('+7 (999) 999-99-99');
	</script>
<?php else : ?>
	<?php echo Message::nothingFound() ?>
<?php endif ?>
</div>