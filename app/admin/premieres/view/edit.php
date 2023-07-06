<?php echo $this->reqContent($req_content) ?>
<div class="main-content">
<?php if ($premier) : ?>
	<div class="form-container">
		<div class="page-title-container">
			<?php echo Ajax::url('/admin/premieres', '&laquo; Вернуться назад') ?>
			<span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Редактирование премьеры</span>
		</div>
		<form action="/admin/premieres/save" method="POST" id="auth-form" onsubmit="return formSubmit(this)">
			<input type="text" name="id" value="<?php echo $premier->id ?>" class="dp-none">
			<div class="form-element-container fx fx-jc-center fx-ai-center poster-container"  style="height: 600px;">
				<label for="poster" class="btn-poster-file">Выберите Постер</label>
				<input type="file" name="poster" id="poster" accept="image/jpeg, image/jpg">
				<div class="poster-preview-container" title="Нажмите, чтобы удалить">
					<img src="<?php echo PREMIERES . $premier->id . D_S . $premier->poster ?>" alt="">
				</div>
			</div>
			<div class="form-element-container">
				<div class="placeholder">Название премьеры</div>
				<input type="text" name="title" id="title" class="form-element" value="<?php echo $premier->title ?>">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Выход в прокат (год)</div>
				<input type="text" name="release" id="release" class="form-element" minlength="4" maxlength="4" value="<?php echo $premier->year_release ?>">
			</div>
			<div class="form-element-container checkbox-container fx fx-dir-col">
				<div class="placeholder">Страна производства</div>
				<div class="fx fx-dir-col checkbox-list country">
				<?php foreach ($countries as $country) : ?>
					<label for="country_<?php echo $country->id ?>" class="aqUI-checkbox">
						<input type="checkbox" name="country[]" id="country_<?php echo $country->id ?>" value="<?php echo $country->id ?>"<?php if (in_array($country->id, explode(',', $premier->country_id))) echo ' checked' ?>>
						<span><?php echo $country->country_ru ?></span>
					</label>
				<?php endforeach ?>
				</div>
			</div>
			<div class="form-element-container checkbox-container fx fx-dir-col">
				<div class="placeholder">Жанр</div>
					<div class="fx fx-dir-col checkbox-list genre">
					<?php foreach ($genres as $genre) : ?>
						<label for="genre_<?php echo $genre->id ?>" class="aqUI-checkbox">
							<input type="checkbox" name="genre[]" id="genre_<?php echo $genre->id ?>" value="<?php echo $genre->id ?>"<?php if (in_array($genre->id, explode(',', $premier->genre_id))) echo ' checked' ?>>
							<span><?php echo $genre->name ?></span>
						</label>
					<?php endforeach ?>
				</div>
			</div>
			<div class="form-element-container">
				<div class="placeholder">В ролях (через запятую)</div>
				<input type="text" name="actors" id="actors" class="form-element" value="<?php echo $premier->actors ?>">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Возрастное ограничение (например: 12)</div>
				<input type="text" name="age_restrictions" id="age_restrictions" class="form-element" maxlength="2" value="<?php echo $premier->age_restrictions ?>">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Режиссёр (если несколько, через запятую)</div>
				<input type="text" name="director" id="director" class="form-element" value="<?php echo $premier->director ?>">
			</div>
			<div class="form-element-container">
				<div class="placeholder">Описание</div>
				<textarea name="description" id="description" class="form-element"><?php echo $premier->description ?></textarea>
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
	$('.poster-preview-container img').on('click', function() {
		$(this).parent().remove();
		$('.poster-container').css({height: '44px'});
	});

	$('#poster').on('change', function() {
		const elem = this;
		const reader = new FileReader();
		const file = this.files.item(0);
		const container = $(this).parent();
		const poster_preview = $('<div>').addClass('poster-preview-container').attr('title', 'Нажите, чтобы удалить');

		reader.readAsDataURL(file);
		reader.onloadend = function(){
			poster_preview.html('<img src="' + reader.result + '" width="100%">');

			container.append(poster_preview);
			$('.form-notice').remove();
			container.css({height: '600'});
		};

		poster_preview.on('click', function() {
			this.remove();
			$(elem).val(null);
			$('.form-notice').remove();
			container.css({height: '44px'});
		});
	});
</script>
<?php else : ?>
	<?php echo Message::nothingFound() ?>
<?php endif ?>