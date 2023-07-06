<?php echo $this->reqContent($req_content) ?>
<div class="main-content">
	<div class="main">
		<div class="header-title fx fx-jc-between fx-ai-center">Кинотеатры<?php echo Ajax::url('/admin/theatres/new', '<i class="fa-solid fa-plus"></i>', ['class' => 'btn-add', 'title' => 'Добавить кинотеатр']) ?></div>
		<div class="theatres-container grid">
		<?php foreach ($theatres as $cinema) : ?>
			<div class="cinema-container fx fx-jc-between">
				<div class="cinema-img fx fx-jc-center fx-ai-center">
					<img src="<?php echo IMG ?>cinema-icon.jpg" alt="" width="100px" height="100px">
				</div>
				<div class="cinema-details fx fx-dir-col fx-jc-between">
					<div class="cinema-name fx">
						<span class="cinema-label">Кинотеатр:</span>
						<span><?php echo $cinema->name ?></span>
					</div>
					<div class="cinema-city fx">
						<span class="cinema-label">Город:</span>
						<span><?php echo $cinema->city ?></span>
					</div>
					<div class="cinema-address fx">
						<span class="cinema-label">Адрес:</span>
						<span><?php echo $cinema->address ?></span>
					</div>
					<div class="cinema-phone fx">
						<span class="cinema-label">Телефон:</span>
						<span><?php echo Core::phoneСorrect($cinema->phone) ?></span>
					</div>
				</div>
				<div class="cinema-settings fx fx-jc-end fx-ai-center pos-rel">
					<div class="cinema-menu-icon">
						<i class="fa-regular fa-ellipsis-vertical cinema-icon-bar" onclick="cinemaMenuSettings('#c<?php echo $cinema->id ?>')"></i>
						<div class="menu-settings fx" id="c<?php echo $cinema->id ?>">
							<?php echo Ajax::url('/admin/theatres/edit?id=' . $cinema->id, '<i class="fa-solid fa-gear"></i>', ['class' => 'cinema-btn-edit', 'title' => 'Изменить']) ?>
							<div class="cinema-btn-del" title="Удалить" onclick="tooltipBoxDelete(<?php echo $cinema->id ?>)">
								<i class="fa-solid fa-trash"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach ?>
		</div>
		<?php echo $pagination ?>
	</div>
</div>
<script>
	$('.btn-add').aq('tooltip', {
		position: 'left',
		container: '#app'
	});

	$('.cinema-btn-edit, .cinema-btn-del').aq('tooltip', {
		container: '#app'
	});

	function cinemaMenuSettings(element) {
		if ($(element).css('display') === 'none') {
			$(element).css({display: 'block'});
			$(element).animate({width: '+=68px', opacity: 1, right: '+=10px'}, 200);
		} else {
			$(element).animate({width: '0', opacity: 0, right: '-=10px'}, 200, function() {
				$(element).css({display: 'none'});
			});
		}
	}

	function tooltipBoxDelete(id) {
		if (confirm('Удалить кинотеатр')) {
			$.ajax({
				url: '/admin/theatres/del',
				method: 'POST',
				dataType: 'json',
				data: {'id': id, 'url': window.location.href},
				success: function(data) {
					if (data.url) {
						ajax.Reload({
							href: window.location.href
						});
					}
				}
			});
		}
	}
</script>