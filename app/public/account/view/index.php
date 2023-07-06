<div class="user-profile-container fx fx-dir-col">
	<div class="user-profile-info fx fx-dir-col fx-ai-center">
		<div class="user-profile-avatar-container">
			<img src="<?php echo AVATAR . $user['avatar'] ?>" alt="avatar" class="user-profile-avatar">
		</div>
		<div class="user-profile-info-item"><?php echo $user['email'] ?></div>
		<div class="user-profile-info-item">
			<span class="label">Дата регистрации:</span>
			<span><?php echo Date::showDateString($user['dateReg']) ?></span>
		</div>
	</div>
</div>