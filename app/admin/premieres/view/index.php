<?php echo $this->reqContent($req_content) ?>
<div class="main-content">
	<div class="main">
		<div class="premieres-search-container fx fx-ai-center pos-rel">
			<input type="text" class="search" id="search" placeholder="Для поиска нажмите интер" value="<?php echo $search ?>">
			<span class="search-icon pos-abs">
				<i class="fa-regular fa-magnifying-glass"></i>
			</span>
			<?php echo Ajax::url('/admin/premieres/new', '<i class="fa-solid fa-plus"></i>', ['class' => 'btn-add', 'title' => 'Добавить премьеру']) ?>
		</div>
		<div class="premieres-container grid">
		<?php foreach ($premieres as $premiere) : ?>
			<div class="premier-box">
				<div class="premier-poster">
					<img src="<?php echo PREMIERES . $premiere->id . D_S . $premiere->poster ?>" alt="">
				</div>
				<div class="premier-title">
					<?php echo mb_strimwidth($premiere->title, 0, 23 ,'...') ?>
				</div>
				<div class="premier-genre">
					<?php echo implode(', ', Genre::getNameByIn($premiere->genre_id)) ?>
				</div>
				<div class="premier-settings fx fx-jc-evenly">
					<?php echo Ajax::url('/admin/premieres/edit?id=' . $premiere->id, '<i class="fa-solid fa-gear"></i>', ['class' => 'premier-btn-edit', 'title' => 'Изменить']) ?>
					<div class="premier-btn-del" title="Удалить" onclick="tooltipBoxDelete(this, <?php echo $premiere->id ?>)">
						<i class="fa-solid fa-trash"></i>
					</div>
				</div>
			</div>
		<?php endforeach ?>
		</div>
		<?php echo $pagination ?>
	</div>
</div>
<script>
	function tooltipBoxDelete(element, id) {
		$(element).aq('tooltipBox', {
			text: '<div class="tooltip-box-message-delete"><div class="tooltip-box-text">Удалить премьеру?</div><button class="tooltip-box-btn" onclick="deletePremier(' + id + ')">Удалить</button></div>',
			container: '#app'
		});
	}

	function deletePremier(id) {
		$.ajax({
			url: '/admin/premieres/del',
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

	$('.premier-btn-edit, .premier-btn-del').aq('tooltip', {
		container: '#app'
	});

	$('.btn-add').aq('tooltip', {
		position: 'left',
		container: '#app'
	});

	$('#search').on('keydown', function(e) {
		if (this.value.length >= 3 && eventKey(e) === 13) {
			ajax.Url({
				href: '/admin/premieres?search=' + this.value
			});
		}
	});

	$('#search').on('input', function() {
		if (this.value.length <= 0) {
			ajax.Url({
				href: '/admin/premieres'
			});
		}
	});
</script>