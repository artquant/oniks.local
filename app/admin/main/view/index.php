<?php echo $this->reqContent($req_content) ?>
<div class="main-content">
	<div class="main">
		<div class="admin-access-ip-container">
			<div class="admin-access-ip">
				<h4 class="admin-access-ip-title">Список разрешённых IP адресов для админки</h4>
				<form action="/admin/main/ip-save" method="POST" onsubmit="return formSubmit(this)">
					<div class="form-element-container">
						<input type="text" name="access_ip" id="access_ip" class="form-element full" value="<?php echo $access_ip->ip ?>">
					</div>
					<div class="form-element-container fx fx-jc-center">
						<button type="submit" class="form-element">
							<span>Сохранить</span>
						</button>
					</div>
				</form>
			</div>
		</div>
		<div class="admin-users_group-container fx">
			<div class="admin-users-list">
				<h4 class="admin-users-title">Администраторы</h4>
				<div class="users-list fx-inline fx-dir-col">
				<?php foreach ($admin_users as $admin) : ?>
					<?php echo Ajax::url('/admin/users/edit?id=' . $admin->id, $admin->surname . ' ' . $admin->name) ?>
				<?php endforeach ?>
				</div>
			</div>
			<div class="admin-users-list">
				<h4 class="admin-users-title">Киномодераторы</h4>
				<div class="users-list fx-inline fx-dir-col cinema-moderator">
				<?php foreach ($cinema_users as $admin) : ?>
					<?php echo Ajax::url('/admin/users/edit?id=' . $admin->id, $admin->surname . ' ' . $admin->name, ['title' => '<div>' . $admin->theatres_name . '</div><div>' . $admin->city . ' ' . $admin->address . '</div><div>' . Core::phoneСorrect($admin->phone) . '</div>']) ?>
				<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('.cinema-moderator a').aq('tooltip', {
		container: '#app'
	});
</script>