<div class="afisha-container fx fx-dir-col">
<?php if ($db) : ?>
<?php foreach ($db as $afisha) : ?>
	<div class="afisha-item fx fx-wrap">
		<div class="afisha-poster fx fx-jc-center fx-ai-center">
			<img src="<?php echo PREMIERES . $afisha->premieres_id . D_S . $afisha->poster ?>" alt="Постер">
		</div>
		<div class="afisha-details fx fx-dir-col">
			<div class="afisha-film-info fx">
				<div class="afisha-film-more-icon fx fx-jc-center fx-ai-center" title="Подробная иформация о фильме" onclick="premierShow(<?php echo $afisha->premieres_id ?>)">
					<i class="fa-light fa-circle-info"></i>
				</div>
				<span class="afisha-film-title"><?php echo $afisha->title ?></span>
				<div class="afisha-age-restriction<?php if (($afisha->age_restrictions == 18)) echo ' adult' ?>"><?php echo $afisha->age_restrictions ?>+</div>
			</div>
			<div class="afisha-genre">
				<?php echo implode(', ', Genre::getNameByIn($afisha->genre_id)) ?>
			</div>
			<div class="afisha-theatres-container fx fx-dir-col">
				<div class="afisha-theatres-title fx fx-jc-center fx-ai-center">Кинотеатры</div>
				<?php if (array_key_exists($afisha->id, $theatres_info)) : ?>
					<div class="afisha-cinema-container fx fx-dir-col fx-jc-evenly">
					<?php foreach ($theatres_info[$afisha->id] as $cinema) : ?>
						<div class="afisha-cinema-item fx fx-dir-col">
							<div class="afisha-cinema-info fx fx-jc-between fx-ai-center fx-wrap">
								<div class="afisha-cinema-name"><span class="afisha-cinema-address-icon" onclick="cinemaInfo(this, '<?php echo $cinema['city'] ?>', '<?php echo $cinema['address'] ?>', '<?php echo Core::phoneСorrect($cinema['phone']) ?>')"><i class="fa-light fa-location-crosshairs"></i></span><?php echo $cinema['name'] ?></div>
								<div class="afisha-cinema-halls">
									<span class="afisha-cinema-halls-label">Зал:</span>
									<span class="afisha-cinema-hall"><?php echo $cinema['halls'] ?></span>
								</div>
								<div class="afisha-cinema-price">
									<span class="afisha-cinema-price-text">от</span>
									<span class="afisha-cinema-price-number"><?php echo $cinema['min_price'] ?></span>
									<span class="afisha-cinema-price-symbol"><?php echo MONEY_SYMBOL['ru'] ?></span>
								</div>
							</div>
							<div class="afisha-cinema-time-show fx">
							<?php foreach (explode(',' ,$cinema['time_show']) as $time) : ?>
								<span class="afisha-cinema-time"><?php echo $time ?></span>
							<?php endforeach ?>
							</div>
						</div>
					<?php endforeach ?>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
<?php endforeach ?>
<?php else : ?>
	<?php echo Message::nothingFound('На текущую дату событий не найдено', false) ?>
<?php endif ?>
	<div class="button-scroll-top">
		<i class="fa-sharp fa-regular fa-up-to-dotted-line"></i>
	</div>
</div>
<script>
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('.button-scroll-top').fadeIn();
		} else {
			$('.button-scroll-top').fadeOut();
		}
	});

	$('.button-scroll-top').on('click', function() {
		$("html, body").animate({
			scrollTop: 0
		}, 200);

		return false;
	});

	$('.afisha-film-more-icon').aq('tooltip', {
		container: '#app'
	});

	function cinemaInfo(elem, city, adress, phone) {
		$(elem).aq('tooltipBox', {
			container: '#app',
			text: '<div class="afisha-cinema-info-container"><div class="afisha-cinema-info-address">г. ' + city + ' ' + adress + '</div><div class="afisha-cinema-info-phone">' + phone + '</div></div>'
		});
	}

	function premierShow(id) {
		$().aq('box', {
			container: '#app',
			title: 'Информация',
			ajax: {
				url: '/premieres/more',
				method: 'POST',
				data: {'id': id}
			}
		});
	}
</script>