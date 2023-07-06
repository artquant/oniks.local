<div class="auth-container fx fx-jc-center fx-ai-center">
	<div class="auth-box fx fx-dir-row fx-wrap">
		<div class="auth-logo fx fx-jc-center fx-ai-center">
			<img src="<?php echo SVG ?>logo.svg" alt="" width="150">
		</div>
		<div class="auth-form">
			<form action="/auth/send" data-ajax="false" method="POST" id="auth-form" onsubmit="return formSubmit(this)">
				<div class="form-element-container">
					<input type="text" name="email" id="email" class="form-element" placeholder="email">
				</div>
				<div class="form-element-container">
					<input type="password" name="password" id="password" class="form-element" placeholder="пароль">
				</div>
				<div class="form-element-container fx fx-dir-row fx-jc-between fx-ai-center">
					<label for="sd" class="aqUI-checkbox">
						<input type="checkbox" name="sd" id="sd"<?php echo $sd ?>>
						<span>сохранить данные</span>
					</label>
					<a href="/recovery">Забыли пароль?</a>
				</div>
				<div class="form-element-container fx fx-jc-center">
					<button type="submit" class="form-element full">
						<span>Авторизация</span>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>