<?php if ($theatres_date_show AND $theatres_date_show->theatres_id == USER['theatres_id']) : ?>
	<div class="form-box">
	<form action="/afisha/theatres-save" method="POST" id="auth-form" onsubmit="return formSubmit(this)">
	<input type="text" name="theatres_date_show_id" value="<?php echo $theatres_date_show->id ?>" class="dp-none">
		<div class="form-element-container">
			<div class="placeholder">Время</div>
			<input type="time" name="time[]" class="form-element time" id="time_0" value="<?php echo $time_show[0] ?>">
		</div>
		<?php array_shift($time_show); foreach ($time_show as $key => $time) : ?>
		<div class="form-element-container pos-rel">
			<div class="placeholder">Время</div>
			<input type="time" name="time[]" id="time_<?php echo $key + 1 ?>" class="form-element time" value="<?php echo $time ?>">
			<div class="btn-del-date-input" title="Удалить" onclick="delTimeInput(this)">
				<i class="fa-regular fa-circle-xmark"></i>
			</div>
		</div>
		<?php endforeach ?>
		<div class="form-element-container fx fx-jc-center">
			<button type="button" class="form-element full" onclick="addTimeInput(this); return false;">
				<span>Добавить время</span>
			</button>
		</div>
		<?php if (!empty($theatres_halls)) : ?>
		<div class="form-element-container">
			<div class="placeholder">Зал</div>
			<select name="halls" id="halls" class="form-element">
			<?php foreach (explode(',', $theatres_halls) as $hall) : ?>
				<option value="<?php echo $hall ?>"<?php if ($hall == $theatres_date_show->halls) echo ' selected' ?>><?php echo $hall ?></option>
			<?php endforeach ?>
			</select>
		</div>
		<?php endif ?>
		<div class="form-element-container">
			<div class="placeholder">Мин. цена билета</div>
			<input type="text" name="min_price" class="form-element" id="min_price" value="<?php echo $theatres_date_show->min_price ?>">
		</div>
		<div class="form-element-container fx fx-jc-center">
			<button type="submit" class="form-element full">
				<span>Сохранить</span>
			</button>
		</div>
	</form>
</div>
<script>
	$('#halls').aq('select', {
		width: '100%',
		height: '44px'
	});

	function addTimeInput(elem) {
		const form_element_container = $('<div>').addClass(['form-element-container', 'pos-rel']);
		const placeholder = $('<div>').addClass('placeholder').html('Время');
		const input = $('<input>').attr({type: "time", name: 'time[]'}).addClass(['form-element', 'time']);
		const btn_del = $('<div>').attr('title', 'Удалить').addClass('btn-del-date-input').html('<i class="fa-regular fa-circle-xmark"></i>');

		form_element_container.append(placeholder, input, btn_del);
		$(elem).parent().before(form_element_container);

		input.attr('id', 'time_' + ($('.form-element.time').length - 1));

		btn_del.on('click', function() {
			$(this).parent().remove();

			for (let i = 0; i < $('.form-element.time').length; i++) {
				$('.form-element.time').eq(i).attr('id', 'time_' + i);
			}
		});
	}

	function delTimeInput(elem) {
		$(elem).parent().remove();

		for (let i = 0; i < $('.form-element.time').length; i++) {
			$('.form-element.time').eq(i).attr('id', 'time_' + i);
		}
	}
</script>
<?php else : ?>
<?php echo Message::nothingFound('По вашему запросу ничего не найдено', false) ?>
<?php endif ?>