<?php echo $this->reqContent($req_content) ?>
<div class="main-content">
	<div class="form-container">
		<div class="theatres-container">
			<div class="page-title-container">
				<?php echo Ajax::url('/admin/theatres', '&laquo; Вернуться назад') ?>
				<span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Добавление кинотеатра</span>
			</div>
			<form action="/admin/theatres/add" method="POST" onsubmit="return formSubmit(this)">
				<div class="form-element-container">
					<div class="placeholder">Название кинотеатра</div>
					<input type="text" name="name" id="name" class="form-element">
				</div>
				<div class="form-element-container">
					<div class="placeholder">Город</div>
					<input type="text" name="city" id="city" class="form-element">
				</div>
				<div class="form-element-container">
					<div class="placeholder">Адрес</div>
					<input type="text" name="address" id="address" class="form-element">
				</div>
				<div class="form-element-container">
					<div class="placeholder">Телефон</div>
					<input type="text" name="phone" id="phone" class="form-element">
				</div>
				<div class="form-element-container">
					<div class="placeholder">Название залов (через запятую)</div>
					<input type="text" name="halls_name" id="halls_name" class="form-element">
				</div>
				<div class="form-element-container fx fx-jc-center">
					<button type="submit" class="form-element full">
						<span>Добавить</span>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$('#phone').mask('+7 (999) 999-99-99');
</script>