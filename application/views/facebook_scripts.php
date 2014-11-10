<script>
	window.fbAsyncInit = function() {
		FB.init({
		    appId: '<?php echo $this->config->item("facebook")["app_id"]; ?>',            
		    status: true,
		    xfbml: true,
		    cookie: true // Crucial for PHP SDK
		});

		// Check login status
		FB.getLoginStatus(function(response) {
			
			// User login status has changed, but Facebook PHP SDK session is not refreshed
			// Let's reload the page to update the session
			var	fb_token = '<?php echo $this->session->userdata("fb_token") ?>' || undefined;
			if (response.status === 'connected' && fb_token === undefined ||
				response.status === 'unknown' && fb_token !== undefined) {
				window.location.reload(true);
			}
			
			if (response.status === 'not_authorized') {
				// User did not authorize our app
				FB.login(
					function(login_response) {
						if (login_response.status === 'connected') {
							goToMainPage();
						}
					},
					{
						scope: '<?php echo $this->config->item("facebook")["permissions"] ?>'
					}
				);
			}
		});
	}

	function goToMainPage() {
        var app_url = '<?php echo $this->config->item("facebook")["app_path"]; ?>';
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