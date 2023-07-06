<?php echo $this->reqContent($req_content) ?>
<div class="main-content">
	<div class="main">
		<div class="user-search-container fx fx-ai-center pos-rel">
			<input type="text" class="search" id="search" value="<?php echo $search ?>" placeholder="Введите фамилию или email">
			<span class="search-icon pos-abs">
				<i class="fa-regular fa-magnifying-glass"></i>
			</span>
			<?php echo Ajax::url('/admin/users/new', '<i class="fa-solid fa-plus"></i>', ['class' => 'btn-add', 'title' => 'Добавить пользователя'], ) ?>
		</div>
		<div class="users-list-container fx fx-dir-col">
		<?php if ($list_users) : ?>
		<?php foreach ($list_users as $user) : ?>
			<div class="user-list fx fx-jc-between">
				<div class="user-list-info fx fx-ai-center">
					<div class="user-avatar fx fx-jc-center fx-ai-center pos-rel">
						<img src="<?php echo AVATAR . $user->avatar ?>" width="50" height="50" alt="">
						<span class="user-avatar-access"><?php echo mb_substr(USER_ACCESS[$user->access], 0, 1) ?></span>
					</div>
					<div class="user-fio">
						<?php echo $user->surname ?> <?php echo $user->name ?>
						<div class="user-phone"><?php echo Core::phoneСorrect($user->phone) ?></div>
					</div>
					<div class="user-email"><?php echo $user->email ?></div>
					<div class="user-ip ta-center"><?php echo $user->ip ?></div>
					<div class="user-is-block ta-center"><?php if ($user->isBlock) echo 'заблокирован' ?></div>
				</div>
				<div class="user-setting fx fx-ai-center">
					<div class="user-menu-icon">
						<span title="Редактировать">
							<?php echo Ajax::url('/admin/users/edit?id=' . $user->id, '<i class="fa-solid fa-pencil"></i>') ?>
						</span>
						<span title="Удалить">
							<i class="fa-solid fa-trash-xmark"></i>
						</span>
					</div>
				</div>
			</div>
		<?php endforeach ?>
		<?php echo $pagination ?>
		<?php endif ?>
		</div>
	</div>
</div>

<script>
	$('.btn-add').aq('tooltip', {
		position: 'left',
		container: '#app'
	});

	$('.user-menu-icon span').aq('tooltip', {
		container: '#app'
	});

	$('#search').on('keydown', function(e) {
		if (this.value.length >= 3 && eventKey(e) === 13) {
			ajax.Url({
				href: '/admin/users?search=' + this.value
			});
		}
	});

	$('#search').on('input', function() {
		if (this.value.length <= 0) {
			ajax.Url({
				href: '/admin/users'
			});
		}
	});
</script>