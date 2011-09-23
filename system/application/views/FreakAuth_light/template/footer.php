<div data-role="footer"  > 
		<h4><?php
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		
		$matchesArray= array('iPad' => 'Apple iPad',
							 'Opera'=> 'Opera',
							 'Chrome' => 'Google Chrome',
							 'Safari' => 'Safari',
							 'iPhone OS 4'=> 'iPhone 4',
							 'iPhone' => 'iPhone',
							 'Firefox' => 'Firefox',
							 'HTC_Wildfire' => 'HTC Wildfire',
							 'HTC Wildfire'=> 'HTC Wildfire',
							 'HTC Desire' => 'HTC Desire',
							 'HTC_Desire' => 'HTC Desire',
							 'Galaxy'	=> 'Samsung Galaxy'
							 );
	    $operatingsystemArray= array('Macintosh' => 'Mac','Mac' => 'Mac',
									 'Windows'=> 'Windows',
								 );
	
	$currentAgent = "copyright @ sendsms2india 2011";				 
	foreach($matchesArray as $key=>$value)
	{
		if(preg_match("/$key/i", $useragent))
		{
			$currentAgent = $value;
			break;
		}
	}
	
	$currentOs = "";				 
	foreach($operatingsystemArray as $key=>$value)
	{
		if(preg_match("/$key/i", $useragent))
		{
			$currentOs = $value;
			break;
		}
	}
		 print($currentAgent.' '.$currentOs); ?></h4>
</div>
</div>
<!-- Piwik -->
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://analytics.goforexpert.com/" : "http://analytics.goforexpert.com/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 3);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://analytics.goforexpert.com/piwik.php?idsite=3" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->
</body>
</html>