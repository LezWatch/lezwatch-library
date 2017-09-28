<?php
/*
Library: Global Advertising
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
		add_shortcode( 'amazon-bounties', array( $this, 'amazon_bounties' ) );
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
			'300x250' => '<a target="_blank" href="http://shareasale.com/r.cfm?b=255472&amp;u=728549&amp;m=28169&amp;urllink=&amp;afftrack="><img src="https://i.shareasale.com/image/28169/300x250.png" border="0" alt="Genesis Framework for WordPress" /></a>',
		);

		$facetwp = array(
			'300x250' => '<a href="https://facetwp.com/?ref=91&campaign=LezPress"><img src="' . WP_CONTENT_URL . '/library/advertising/images/facetwp-300x250.png"></a>',
		);

		$dreamhost = array(
			'300x250' => '<a href="https://dreamhost.com/dreampress/"><img src="' . WP_CONTENT_URL . '/library/advertising/images/dreamhost-300x250.png"></a>',
		);

		$yikes = array(
			'300x250' => '<a href="https://www.yikesinc.com"><img src="' . WP_CONTENT_URL . '/library/advertising/images/yikes-300x250.png"></a>',
		);

		$advert = '<!-- BEGIN Affiliate Ads --><div class="affiliate-ads ' . sanitize_html_class( $attr['type'] ) . '">';

		switch ( $type ) {
			case 'genesis':
				$advert .= $genesis[ $size ];
				break;
			case 'facetwp':
				$advert .= $facetwp[ $size ];
				break;
			case 'dreamhost':
				$advert .= $dreamhost[ $size ];
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
			<div class="amazon-ads">
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
			<div class="amazon-ads">
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

	/*
	 * Display Amazon Bounties
	 *
	 * Usage: [amazon-bounties size=""]
	 *
	 * Valid sizes: 300x250, 160x600, 728x90, 300x600
	 * Default: 300x250
	 *
	 * @since 1.0
	*/

	public function amazon_bounties( $atts ) {

		$attr = shortcode_atts( array(
			'size'  => '300x250',
		), $atts );

		$bounties        = array();

		$bounties_300250 = array( 
			'hbo-2020'      => array( 
				'expires'   => '2020-12-01',
				'banner_id' => '11XR3BAGVDW8V1CS1SR2', 
				'linkid'    => '4911c201ef21008a67f629c4745c8d59' ,
				'campaign'  => 'amazonvideosubs'
				), 
			'hbo-2017'      => array(
				'expires'   => '2017-12-30',
				'banner_id' => '17V0HBPP6E0CA2YD83G2', 
				'linkid'    => 'b66058bd84eac1f6e1a00e36224411ac',
				'campaign'  => 'amazonvideosubs'
				), 
			'outlander-2020'=> array( 
				'expires'   => '2020-06-08',
				'banner_id' => '0NAE4QVSPV9WBX705Q02', 
				'linkid'    => 'c8a2d6e4e9d8c3043a360edddd16cd65',
				'campaign'  => 'amazonvideosubs'
				),
			'showtime-2020' => array( 
				'expires'   => '2020-12-31',
				'banner_id' => '1D4BYT6626ZE612AYY82', 
				'linkid'    => '8c44a7c89f6d17fcbc7520e12f6e8d19',
				'campaign'  => 'amazonvideosubs'
				),
			'primeent'      => array( 
				'expires'   => 'ongoing',
				'banner_id' => '0AYXCYJJ9PEFSXH6QP02',
				'linkid'    => 'ccab416cb595e275df2791325eb2367b',
				'campaign'  => 'primeent'
				),
			'firetv-2017'   => array( 
				'expires'   => '2017-12-31',
				'banner_id' => '1E8K86THMZ6SY8Y2SH02',
				'linkid'    => 'f12a50b3d8a00a436189261002ac80f7',
				'campaign'  => 'amzn_smp_firetvedition'
				),
			'britbox'       => array( 
				'expires'   => 'ongoing',
				'banner_id' => '1AQGHMAACGH04WKQ1YG2',
				'linkid'    => 'd45fe5a514960324926ae983dfb7a827',
				'campaign'  => 'amazonvideosubs'
				),
			);

		$bounties_160600 = array( 
			'shameless'     => array( 
				'expires'   => '2020-12-31',
				'banner_id' => '08ZZRWXWXFEVHYCASCR2', 
				'linkid'    => '605851501c5f3bc4d86c97419de9c8a2' ,
				'campaign'  => 'amazonvideosubs'
				), 
			'westworld'     => array( 
				'expires'   => '2020-12-31',
				'banner_id' => '10MCTXD1DJ0K6ACX0KG2', 
				'linkid'    => '5c2a2f020b3e96d8daee238ed92dad0f' ,
				'campaign'  => 'amazonvideosubs'
				), 
			'outlander'     => array( 
				'expires'   => '2020-12-31',
				'banner_id' => '096WSZC10BTDR26Z8YR2', 
				'linkid'    => 'bf8765a9aa039cac14a4e4d946fd3e8a' ,
				'campaign'  => 'amazonvideosubs'
				), 
			'twinpeaks'     => array( 
				'expires'   => '2020-12-31',
				'banner_id' => '0K1QMMQGG293DT46SZ82', 
				'linkid'    => 'e1d660836ce282fcd9d92461994fdc87' ,
				'campaign'  => 'amazonvideosubs'
				), 
			'gameofthrones' => array( 
				'expires'   => '2020-12-31',
				'banner_id' => '1KAXW3M068GBRWGGR282', 
				'linkid'    => 'd23b0739507877f14aca96ee1f5e48f6' ,
				'campaign'  => 'amazonvideosubs'
				), 
			'britbox' => array( 
				'expires'   => '2020-12-31',
				'banner_id' => '1451M1TK3PKR29C2YBR2', 
				'linkid'    => 'bc81d7076d2ca29a4ef9bbdd36ba4d93' ,
				'campaign'  => 'amazonvideosubs'
				), 
			);

		switch ( $attr['size'] ) {
			case '160x600':
				$all_bounties = $bounties_160600;
				$width  = '160';
				$height = '600';
				$amzn_assoc_p = '14';
				break;
			default:
				$all_bounties = $bounties_300250;
				$width  = '300';
				$height = '250';
				$amzn_assoc_p = '12';
		}
			
		// Exclude anything expired
		foreach ( $all_bounties as $a_bounty => $value ) {
			$expires = strtotime( $value['expires'] );
			
			if ( $value['expires'] == 'ongoing' || $expires >= time() ) {
				$bounties[$a_bounty] = $value;
			}
		}

		// Pick a random valid bounty
		$bounty = $bounties [ array_rand( $bounties ) ];

		// Build the ad
		$ads = '
			<div class="amazon-ads">
				<script type="text/javascript">
					amzn_assoc_ad_type = "banner";
					amzn_assoc_marketplace = "amazon";
					amzn_assoc_region = "US";
					amzn_assoc_placement = "assoc_banner_placement_default";
					amzn_assoc_campaigns = "'. $bounty['campaign'] .'";
					amzn_assoc_banner_type = "promotions";
					amzn_assoc_p = "'. $amzn_assoc_p .'";
					amzn_assoc_banner_id = "'. $bounty['banner_id'] .'";
					amzn_assoc_width = "'. $width .'";
					amzn_assoc_height = "'. $height .'";
					amzn_assoc_tracking_id = "lezpress-20";
					amzn_assoc_linkid = "'. $bounty['linkid'] .'";
				</script>
				<script src="//z-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&Operation=GetScript&ID=OneJS&WS=1"></script>
			</div>
		';
		
		return $ads;

	}

}

new LP_Advertising();