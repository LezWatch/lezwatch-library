<?php
/*
Plugin Name: Global Advertising
Description: Advertising Code for the LeZWatch Network
Version: 1.0
Author: Mika Epstein
*/

class LP_Advertising {
	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
		add_filter( 'widget_text', 'do_shortcode' );
	}

	/**
	 * Init
	 */
	public function init() {
		add_shortcode( 'amazon-ads', array( $this, 'amazon_ads' ) );
		add_shortcode( 'affiliates', array( $this, 'affiliates' ) );
	}

	/*
	 * Display Affiliate Ads
	 *
	 * Usage: [affiliates type={random|genesis|facetwp|liquidweb} size={heightxwidth}]
	 *
	 * Currently all ads are 300x250 for ... reasons
	 *
	 * @since 1.0
	*/

	public function affiliates( $atts ) {

		$attr = shortcode_atts( array(
			'type'  => 'random',
			'size'  => '300x250',
		), $atts );

		$type = sanitize_text_field( $attr['type'] );
		$size = sanitize_text_field( $attr['size'] );

		$valid_sizes  = array( '300x250' );
		$valid_types  = array( 'genesis', 'facetwp', 'dreamhost', 'yikes' );

		if ( $type == 'random' || !in_array( $type, $valid_types) )
			$type = $valid_types [ array_rand( $valid_types ) ];


		if ( !in_array( $size, $valid_sizes) )
			$size = '300x250';

		$genesis = array(
			'125x125' => '<a target="_blank" href="http://shareasale.com/r.cfm?b=965932&amp;u=728549&amp;m=28169&amp;urllink=&amp;afftrack="><img src="https://i.shareasale.com/image/28169/9888BF0AC9006B0B5DA071FA0974EE72.png" border="0" alt="StudioPress Sites" /></a>',
			'160x600' => '<a target="_blank" href="http://shareasale.com/r.cfm?b=255469&amp;u=728549&amp;m=28169&amp;urllink=&amp;afftrack="><img src="https://i.shareasale.com/image/28169/160x600.png" border="0" alt="Genesis Framework for WordPress" /></a>',
			'250x250' => '<a target="_blank" href="http://shareasale.com/r.cfm?b=241697&amp;u=728549&amp;m=28169&amp;urllink=&amp;afftrack="><img src="https://i.shareasale.com/image/28169/250x250.jpg" border="0" alt="StudioPress Premium WordPress Themes" /></a>',
			'300x250' => '<a target="_blank" href="http://shareasale.com/r.cfm?b=255472&amp;u=728549&amp;m=28169&amp;urllink=&amp;afftrack="><img src="https://i.shareasale.com/image/28169/300x250.png" border="0" alt="Genesis Framework for WordPress" /></a>',
		);

		$facetwp = array(
			'300x250' => '<a href="https://facetwp.com/?ref=91&campaign=LezPress"><img src="' . plugins_url( "images/facetwp-300x250.png", __FILE__ ) . '"></a>',
		);

		$dreamhost = array(
			'300x250' => '<a href="https://dreamhost.com/dreampress/"><img src="' . plugins_url( "images/dreamhost-300x250.png", __FILE__ ) . '"></a>',
		);

		$liquidweb = array(
			'125x125' => '<a href="//liquidweb.evyy.net/c/294289/388066/4464"><img src="//a.impactradius-go.com/display-ad/4464-388066" border="0" alt="Liquid Web Dedicated Servers" width="125" height="125"/></a><img height="0" width="0" src="//liquidweb.evyy.net/i/294289/388066/4464" style="position:absolute;visibility:hidden;" border="0" />',
			'160x600' => '<a href="//liquidweb.evyy.net/c/294289/386647/4464"><img src="//a.impactradius-go.com/display-ad/4464-386647" border="0" alt="" width="160" height="600"/></a><img height="0" width="0" src="//liquidweb.evyy.net/i/294289/386647/4464" style="position:absolute;visibility:hidden;" border="0" />',
			'250x250' => '<a href="//liquidweb.evyy.net/c/294289/297274/4464"><img src="//a.impactradius-go.com/display-ad/4464-297274" border="0" alt="Liquid Web Managed Word Press" width="250" height="250"/></a><img height="0" width="0" src="//liquidweb.evyy.net/i/294289/297274/4464" style="position:absolute;visibility:hidden;" border="0" />',
			'300x250' => '<a href="//liquidweb.evyy.net/c/294289/386651/4464"><img src="//a.impactradius-go.com/display-ad/4464-386651" border="0" alt="" width="300" height="250"/></a><img height="0" width="0" src="//liquidweb.evyy.net/i/294289/386651/4464" style="position:absolute;visibility:hidden;" border="0" />',
		);

		$yikes = array(
			'300x250' => '<a href="https://www.yikesinc.com"><img src="' . plugins_url( "images/yikes-300x250.png", __FILE__ ) . '"></a>',
		);

		$advert = '<!-- BEGIN Affiliate Ads --><div class="affiliate-ads ' . sanitize_html_class( $attr['type'] ) . '">';

		switch ( $type ) {
			case 'genesis':
				$advert .= $genesis[ $size ];
				break;
			case 'facetwp':
				$advert .= $facetwp[ $size ];
				break;
			case 'liquidweb':
				$advert .= $liquidweb[ $size ];
				break;
			default:
				$advert .= $yikes[ $size ];
		}

		$advert .= '</div><!-- END Affiliate Ads -->';

		return $advert;
	}

	/*
	 * Display Amazon Ads
	 *
	 * Usage: [amazon-ads type={banner|gift-card} size={468x30}]
	 *
	 * @since 1.0
	*/
	public function amazon_ads( $atts ) {

		$attr = shortcode_atts( array(
			'type'  => 'gift-card',
			'size'  => '468x30',
		), $atts );

		switch ( $attr['size'] ) {
			case '120x600':
				$width  = '120';
				$height = '600';
				$linkid = 'df6784c1de12263d667401e69a4893e7';
				$p      = '11';
			break;
			default:
				$width  = '468';
				$height = '60';
				$linkid = '21f97ff04402ba07089dfcf071a36c6c';
				$p      = '13';
		}

		$gift_card_ads = '
			<div class="alignleft">
				<script type="text/javascript">
				    amzn_assoc_ad_type = "banner";
					amzn_assoc_marketplace = "amazon";
					amzn_assoc_region = "US";
					amzn_assoc_placement = "assoc_banner_placement_default";
					amzn_assoc_campaigns = "gift_certificates";
					amzn_assoc_banner_type = "category";
					amzn_assoc_isresponsive = "true";
					amzn_assoc_banner_id = "1G274HKHXM7QERC7YAG2";
					amzn_assoc_tracking_id = "lezpress-20";
					amzn_assoc_linkid = "d1494a48a27537cf8ecaa3b732b56b2d";
				</script>
				<script src="//z-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&Operation=GetScript&ID=OneJS&WS=1"></script>
		    </div>';

		$banner_ads = '
			<div class="alignleft">
				<script type="text/javascript">
					amzn_assoc_ad_type = "banner";
					amzn_assoc_marketplace = "amazon";
					amzn_assoc_region = "US";
					amzn_assoc_placement = "assoc_banner_placement_default";
					amzn_assoc_banner_type = "ez";
					amzn_assoc_p = "' . $p . '";
					amzn_assoc_width = "' . $width . '";
					amzn_assoc_height = "' . $height . '";
					amzn_assoc_tracking_id = "lezpress-20";
					amzn_assoc_linkid = "' . $linkid . '";;
			    </script>
			    <script src="//z-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&Operation=GetScript&ID=OneJS&WS=1"></script>
			</div>
		';

		$native_ads = '<script src="//z-na.amazon-adsystem.com/widgets/onejs?MarketPlace=US&adInstanceId=03c364f2-4dd2-4fdf-85ea-299766f94353"></script>';

		// Show the ad based on what you picked...
		$ads = '<!-- BEGIN Amazon Ads --><div class="amazon-ads ' . sanitize_html_class( $attr['type'] ) . '">';
		switch ( $attr['type'] ) {
			case 'native':
				$ads .= $native_ads;
			case 'banner':
				$ads .= $banner_ads;
			case 'gift-card':
			default:
				$ads .= $gift_card_ads;
		}
		$ads .= '</div><!-- END Amazon Ads -->';

		return $ads;
	}

}

new LP_Advertising();