<div class="form-box">
	<form action="/admin/afisha/theatres-add" method="POST" id="auth-form" onsubmit="return formSubmit(this)">
		<input type="text" name="afisha_id" value="<?php echo $query['id'] ?>" class="dp-none">
		<input type="date" name="date" value="<?php echo $date ?>" class="dp-none">
		<div class="form-element-container">
			<div class="placeholder">Кинотеатр</div>
			<select name="theatres_id" class="form-element full" id="theatres">
			<?php foreach ($theatres as $cinema) : ?>
				<option value="<?php echo $cinema->id ?>"><?php echo $cinema->name ?></option>
			<?php endforeach ?>
			</select>
		</div>
		<div class="form-element-container">
			<div class="placeholder">Время</div>
			<input type="time" name="time[]" class="form-element time" id="time_0">
		</div>
		<div class="form-element-container fx fx-jc-center">
			<button type="button" class="form-element full" onclick="addTimeInput(this); return false;">
				<span>Добавить время</span>
			</button>
		</div>
		<div class="form-element-container">
			<div class="placeholder">Мин. цена билета</div>
			<input type="text" name="min_price" class="form-element" id="min_price">
		</div>
		<div class="form-element-container fx fx-jc-center">
			<button type="submit" class="form-element full">
				<span>Сохранить</span>
			</button>
		</div>
	</form>
</div>
<script>
	$('#theatres').aq('select', {
		width: '100%',
		height: '44px'
	});

	function addTimeInput(elem) {
		const form_element_container = $('<div>').addClass(['form-element-container', 'pos-rel']);
		const placeholder = $('<div>').addClass('placeholder').html('Дата');
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
</script>