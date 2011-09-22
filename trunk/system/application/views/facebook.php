<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<title>Send Sms 2 India facebook Connect</title>
		
		<style type="text/css">

		body {
		 background-color: #fff;
		 margin: 40px;
		 font-family: Lucida Grande, Verdana, Sans-serif;
		 font-size: 14px;
		 color: #4F5155;
		}

		a {
		 color: #003399;
		 background-color: transparent;
		 font-weight: normal;
		}

		h1 {
		 color: #444;
		 background-color: transparent;
		 border-bottom: 1px solid #D0D0D0;
		 font-size: 16px;
		 font-weight: bold;
		 margin: 24px 0 2px 0;
		 padding: 5px 0 6px 0;
		}

		code {
		 font-family: Monaco, Verdana, Sans-serif;
		 font-size: 12px;
		 background-color: #f9f9f9;
		 border: 1px solid #D0D0D0;
		 color: #002166;
		 display: block;
		 margin: 14px 0 14px 0;
		 padding: 12px 10px 12px 10px;
		}
		
		</style>
		
	</head>
	<body>
		<div class="my-account">
		
		<?php if(isset($link)) {echo $link; }?>
		<?php if(isset($me)) print_r($me);?>
		please wait
		</div>
		<div id="fb-root"></div>
	<script>
      window.fbAsyncInit = function() {
        FB.init({
          appId   : '<?php echo facebook_app_id()?>',
          session : <?php echo json_encode(getFbSessions()); ?>, // don't refetch the session when PHP already has it
          status  : true, // check login status
          cookie  : true, // enable cookies to allow the server to access the session
          xfbml   : true // parse XFBML
        });

        // whenever the user logs in, we refresh the page
        FB.Event.subscribe('auth.login', function() {
          window.location.reload();
        });
      };

      (function() {
        var e = document.createElement('script');
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>
	
	</body>
</html>