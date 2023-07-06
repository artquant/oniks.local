<?php if ($premier) : ?>
<div class="premier-box-container fx">
	<div class="premier-box-poster fx fx-jc-center">
		<img src="<?php echo PREMIERES . $premier->id . D_S . $premier->poster ?>" alt="Постер" width="200px" height="300px">
	</div>
	<div class="premier-box-details fx fx-dir-col">
		<div class="premier-box-info">
			<span class="premier-box-label">Название фильма:</span>
			<span class="premier-box-text"><?php echo $premier->title ?></span>
		</div>
		<div class="premier-box-info">
			<span class="premier-box-label">Выход в прокат:</span>
			<span class="premier-box-text"><?php echo $premier->year_release ?></span>
		</div>
		<div class="premier-box-info">
			<span class="premier-box-label">Страна:</span>
			<span class="premier-box-text"><?php echo implode(', ', Country::getNameByIn($premier->country_id)) ?></span>
		</div>
		<div class="premier-box-info">
			<span class="premier-box-label">Жанр:</span>
			<span class="premier-box-text"><?php echo implode(', ', Genre::getNameByIn($premier->genre_id)) ?></span>
		</div>
		<div class="premier-box-info">
			<span class="premier-box-label">В ролях:</span>
			<span class="premier-box-text"><?php echo $premier->actors ?></span>
		</div>
		<div class="premier-box-info">
			<span class="premier-box-label">Режиссёр:</span>
			<span class="premier-box-text"><?php echo $premier->director ?></span>
		</div>
		<div class="premier-box-info">
			<span class="premier-box-label">Возрастное ограничение:</span>
			<span class="premier-box-text"><?php echo $premier->age_restrictions ?>+</span>
		</div>
		<div class="premier-box-about-text fx fx-jc-center">О фильме</div>
		<div class="premier-box-about"><?php echo $premier->description ?></div>
	</div>
</div>
<?php else : ?>
<?php echo Message::nothingFound('По вашему запросу ничего не найдено', false) ?>
<?php endif ?>