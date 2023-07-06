<?php if ($is_theatres) : ?>
	<div class="user-theatres-container">
		<h1 class="title">Управление кинотеатром</h1>
		<form action="/account/theatres-save" method="POST" onsubmit="return formSubmit(this)">
			<div class="form-element-container">
				<div class="placeholder">Название</div>
				<input type="text" name="name" id="name" class="form-element" value="<?php echo $theatres->name ?>">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Город</div>
				<input type="text" name="city" id="city" class="form-element" value="<?php echo $theatres->city ?>">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Адрес</div>
				<input type="text" name="address" id="address" class="form-element" value="<?php echo $theatres->address ?>">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Телефон</div>
				<input type="text" name="phone" id="phone" class="form-element" value="<?php echo $theatres->phone ?>">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Кинозалы (через запятую)</div>
				<input type="text" name="halls_name" id="halls_name" class="form-element" value="<?php echo $theatres->halls_name ?>">
			</div>
			<div class="form-element-container fx fx-jc-center">
				<button type="submit" class="form-element full">
					<span>Изменить</span>
				</button>
			</div>
		</form>
	</div>
<?php else : ?>
<?php echo Message::nothingFound('Доступ запрещен') ?>
<?php endif ?>