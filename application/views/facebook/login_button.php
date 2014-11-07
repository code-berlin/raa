<?php $permissions = $this->config->item('facebook')['permissions']; ?>

<div class="fb-login-button" data-max-rows="1" data-size="large" data-show-faces="false" data-auto-logout-link="false" onlogin="goToMainPage();" data-scope="<?php echo $permissions; ?>"></div>