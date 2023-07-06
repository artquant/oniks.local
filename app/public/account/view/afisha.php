<?php if ($is_theatres) : ?>
<div class="main fx fx-dir-col">
	<div class="calendar-afisha-container fx fx-dir-col fx-ai-center">
		<div class="calendar-afisha-title"><h1 class="title">Управление афишами</h1></div>
		<div class="calendar-afisha fx fx-wrap">
			<?php echo $afisha_calendar ?>
		</div>
	</div>
	<div class="calendar-afisha-btn-add fx fx-jc-center">
		<a href="/afisha/new?date=<?php echo $date ?>">Добавить афишу</a>
	</div>
	<?php if ($db) : ?>
		<div class="afisha-container">
		<?php foreach ($db as $afisha) : ?>
			<div class="afisha-box fx">
				<div class="poster fx fx-jc-center fx-ai-center">
					<img src="<?php echo PREMIERES . $afisha->premieres_id . D_S . $afisha->poster ?>" alt="">
				</div>
				<div class="info fx fx-dir-col">
					<div class="film-name fx fx-ai-start">
						<?php echo $afisha->title ?>
						<div class="age"><?php echo ($afisha->age_restrictions == 18) ? '<span class="red">' .$afisha->age_restrictions . '+</span>' : $afisha->age_restrictions . '+' ?></div>
					</div>
					<div class="genre">
						<?php echo implode(', ', Genre::getNameByIn($afisha->genre_id)) ?>
					</div>
					<div class="afisha-theatres-container fx fx-jc-center fx-ai-center">
						<?php if (array_key_exists($afisha->id, $theatres_info)) : ?>
						<div class="afisha-cinema-container fx fx-dir-col">
						<?php foreach ($theatres_info[$afisha->id] as $cinema) : ?>
							<div class="cinema-box">
								<div class="cinema-info fx fx-jc-between">
									<span class="name"><?php echo $cinema['name'] ?></span>
									<div class="settings fx pos-rel">
										<div title="Редактировать" class="btn-edit-afisha-cinema" onclick="theatresEdit(<?php echo$cinema['theatres_date_show_id'] ?>)">
											<i class="fa-regular fa-gear"></i>
										</div>
										<div title="Удалить" class="btn-del-afisha-cinema" onclick="theatresDel(this, <?php echo$cinema['theatres_date_show_id'] ?>)">
											<i class="fa-regular fa-circle-xmark"></i>
										</div>
									</div>
								</div>
								<div class="cinema-time-show fx">
								<?php foreach (explode(',' ,$cinema['time_show']) as $time) : ?>
									<span class="time"><?php echo $time ?></span>
								<?php endforeach ?>
								</div>
							</div>
						<?php endforeach ?>
						</div>
						<?php else : ?>
						<div class="title fx fx-jc-center fx-ai-center">Сеансы<span class="theatres-add-button" title="Добавить сеанс" onclick="theatresAdd(<?php echo $afisha->id ?>, '<?php echo $date ?>')"><i class="fa-regular fa-circle-plus"></i></span>
						</div>
						<?php endif ?>
					</div>
				</div>
			</div>
		<?php endforeach ?>
		</div>
	<?php else : ?>
		<?php echo Message::nothingFound('На текущую дату событий не найдено', false) ?>
	<?php endif ?>
</div>
<script>
	$('.theatres-add-button, .btn-edit-afisha-cinema, .btn-del-afisha-cinema').aq('tooltip', {
		container: '#app'
	});

	function theatresAdd(id, date) {
		$().aq('box', {
			container: '#app',
			title: 'Добавление сеанса кинотеатра',
			ajax: {
				url: '/afisha/theatres-new',
				method: 'POST',
				data: {
					'id'  : id,
					'date': date
				}
			}
		});
	}

	function theatresEdit(id) {
		$().aq('box', {
			container: '#app',
			title: 'Редактирование сеанса кинотеатра',
			ajax: {
				url: '/afisha/theatres-edit',
				method: 'POST',
				data: {
					'id': id
				}
			}
		});
	}

	function theatresDel(elem, id) {
		$(elem).aq('tooltipBox', {
			text: '<div class="tooltip-box-message-delete"><div class="tooltip-box-text">Удалить кинотеатр?</div><button class="tooltip-box-btn" onclick="deleteCinema(' + id + ')">Удалить</button></div>',
			container: '#app',
			position: 'left'
		});
	}

	function deleteCinema(id) {
		$.ajax({
			url: '/afisha/theatres-del',
			method: 'POST',
			dataType: 'json',
			data: {'id': id, 'url': window.location.href},
			success: function(data) {
				if (data.url) {
					ajax.Reload({
						href: window.location.href,
						top : false
					});
				}
			}
		});
	}
</script>
<?php else : ?>
<?php echo Message::nothingFound('Доступ запрещен') ?>
<?php endif ?>