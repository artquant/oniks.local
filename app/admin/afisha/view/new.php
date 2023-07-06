<?php echo $this->reqContent($req_content) ?>
<div class="main-content">
	<div class="form-container">
		<div class="page-title-container fx fx-jc-start fx-ai-center">
			<?php echo Ajax::url('/admin/afisha', '&laquo; Вернуться назад') ?>
			<span class="page-title-text">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Добавление афиши</span>
			<span class="page-title-date">&nbsp;- <?php echo Date::dateFormat($date) ?></span>
		</div>
		<form action="/admin/afisha/add" method="POST" onsubmit="return formSubmit(this)">
			<div class="form-element-container">
				<div class="placeholder">Дата</div>
				<input type="date" class="form-element date" name="date[]" id="date_0" value="<?php echo $date ?>">
			</div>
			<div class="form-element-container fx fx-jc-center">
				<button type="button" class="form-element full" onclick="addDateInput(this); return false;">
					<span>Добавить Дату</span>
				</button>
			</div>
			<div class="form-element-container">
				<div class="placeholder">Премьера</div>
				<select name="premieres" class="form-element full" id="premieres">
				<?php foreach ($premieres as $premier) : ?>
					<option value="<?php echo $premier->id ?>"><?php echo $premier->title ?></option>
				<?php endforeach ?>
				</select>
			</div>
			<div class="form-element-container fx fx-jc-center">
				<button type="submit" class="form-element full">
					<span>Добавить</span>
				</button>
			</div>
		</form>
	</div>
</div>
<script>
	$('#premieres, #theatres').aq('select', {
		width: '100%',
		height: '44px'
	});

	$('.date').aq('calendar', {
		container: '#app'
	});

	function addDateInput(elem) {
		const form_element_container = $('<div>').addClass(['form-element-container', 'pos-rel']);
		const placeholder = $('<div>').addClass('placeholder').html('Дата');
		const input = $('<input>').attr({type: "date", name: 'date[]'}).addClass(['form-element', 'date']);
		const btn_del = $('<div>').attr('title', 'Удалить').addClass('btn-del-date-input').html('<i class="fa-regular fa-circle-xmark"></i>');

		form_element_container.append(placeholder, input, btn_del);
		$(elem).parent().before(form_element_container);

		input.attr('id', 'date_' + ($('.date').length - 1));

		input.aq('calendar', {
			container: '#app'
		});

		btn_del.on('click', function() {
			$(this).parent().remove();

			for (let i = 0; i < $('.date').length; i++) {
				$('.date').eq(i).attr('id', 'date_' + i);
			}
		});
	}
</script>