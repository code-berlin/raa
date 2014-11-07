<script>
	window.fbAsyncInit = function() {
		FB.init({
		    appId: <?php echo $this->config->item('facebook')['app_id']; ?>,            
		    status: true,
		    xfbml: true,
		    cookie: true // Crucial for PHP SDK
		});

		// Check login status
		FB.getLoginStatus(function(response) {
			console.dir(response);
			if (response.status === 'not_authorized') {
				// User did not authorize our app
				FB.login(
					function(login_response) {
						if (login_response.status === 'connected') {
							goToMainPage();
						}
					},
					{
						scope: <?php echo $this->config->item('facebook')['permissions'] ?>
					}
				);
			}
		});
	}

	function goToMainPage() {
        var app_url = "<?php echo $this->config->item('facebook')['app_path']; ?>";
    	window.top.location = app_url;
    }
</script>

<script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/de_DE/all.js";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<div id="fb-root"></div>