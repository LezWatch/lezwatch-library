<?php
/*
Plugin Name: Google Ads
Description: Shortcode to Insert Google Ads
Version: 1.0
Author: Mika Epstein
*/

function lez_google_ads_shortcode($atts) {

	$ads = '
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- Responsive -->
		<ins class="adsbygoogle"
		     style="display:block"
		     data-ad-client="ca-pub-7868382837959636"
		     data-ad-slot="8167384707"
		     data-ad-format="auto"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	';

	return $ads;
}

add_shortcode('google-ads', 'lez_google_ads_shortcode');
