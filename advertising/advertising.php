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
		$valid_types  = array( 'facetwp', 'dreamhost', 'yikes' );

		if ( $type == 'random' || !in_array( $type, $valid_types) )
			$type = $valid_types [ array_rand( $valid_types ) ];

		if ( !in_array( $size, $valid_sizes) )
			$size = '300x250';

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
			case 'facetwp':
				$advert .= $facetwp[ $size ];
				break;
			case 'dreamhost':
				$advert .= $dreamhost[ $size ];
				break;
			case 'yikes':
			default:
				$advert .= $yikes[ $size ];
		}

		$advert .= '</div><!-- END Affiliate Ads -->';

		return $advert;
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
			'britbox'       => array( 
				'expires'   => 'ongoing',
				'banner_id' => '1AQGHMAACGH04WKQ1YG2',
				'linkid'    => 'd45fe5a514960324926ae983dfb7a827',
				'campaign'  => 'amazonvideosubs'
				),
			'cbsaa-2018'    => array( 
				'expires'   => '2018-12-31',
				'banner_id' => '15WAHRRCWADG8X4F09G2', 
				'linkid'    => '94ff1a1d5d6749cef092f31d769e1b4f' ,
				'campaign'  => 'primevideochannels'
				), 
			'hbo-2018'      => array( 
				'expires'   => '2018-12-31',
				'banner_id' => '1E0AR7ZBTK5HEDE0CM82', 
				'linkid'    => 'e3d8633a5dbaed2d73ac74ea0d11a65d' ,
				'campaign'  => 'primevideochannels'
				), 
			);

		$bounties_160600 = array( 
			'shameless-2020' => array( 
				'expires'    => '2020-12-31',
				'banner_id'  => '08ZZRWXWXFEVHYCASCR2', 
				'linkid'     => '605851501c5f3bc4d86c97419de9c8a2' ,
				'campaign'   => 'amazonvideosubs'
				), 
			'westworld-2020' => array( 
				'expires'    => '2020-12-31',
				'banner_id'  => '10MCTXD1DJ0K6ACX0KG2', 
				'linkid'     => '5c2a2f020b3e96d8daee238ed92dad0f' ,
				'campaign'   => 'amazonvideosubs'
				), 
			'outlander-2020' => array( 
				'expires'    => '2020-12-31',
				'banner_id'  => '096WSZC10BTDR26Z8YR2', 
				'linkid'     => 'bf8765a9aa039cac14a4e4d946fd3e8a' ,
				'campaign'   => 'amazonvideosubs'
				), 
			'twinpeaks-2020' => array( 
				'expires'    => '2020-12-31',
				'banner_id'  => '0K1QMMQGG293DT46SZ82', 
				'linkid'     => 'e1d660836ce282fcd9d92461994fdc87' ,
				'campaign'   => 'amazonvideosubs'
				), 
			'got-2020'       => array( 
				'expires'    => '2020-12-31',
				'banner_id'  => '1KAXW3M068GBRWGGR282', 
				'linkid'     => 'd23b0739507877f14aca96ee1f5e48f6' ,
				'campaign'   => 'amazonvideosubs'
				), 
			'britbox-2020'   => array( 
				'expires'    => '2020-12-31',
				'banner_id'  => '1451M1TK3PKR29C2YBR2', 
				'linkid'     => 'bc81d7076d2ca29a4ef9bbdd36ba4d93' ,
				'campaign'   => 'amazonvideosubs'
				), 
			'showtime-2018'  => array( 
				'expires'    => '2018-12-31',
				'banner_id'  => '0ETV0M1DQEFGJ83G8M02', 
				'linkid'     => 'ead9f36a13eb274af4df2051c9f87966' ,
				'campaign'   => 'primevideochannels'
				), 
			'starz-2018'     => array( 
				'expires'    => '2018-12-31',
				'banner_id'  => '0N482BNAZMAW3F4223G2', 
				'linkid'     => '4a7ef3d12a2a1546fce85885d2c89e42' ,
				'campaign'   => 'primevideochannels'
				), 
			'cbs-2018'       => array( 
				'expires'    => '2018-12-31',
				'banner_id'  => '1RSA96WAH3YGF1HZHCG2', 
				'linkid'     => '8179fed0d8e02494c62e84a76085dfe3' ,
				'campaign'   => 'primevideochannels'
				), 
			'hbo-2018'       => array( 
				'expires'    => '2018-12-31',
				'banner_id'  => '0TZTZKMZNERPRPZYXN82', 
				'linkid'     => '4e5b3071cb78edebbceb9bf99fc7f710' ,
				'campaign'   => 'primevideochannels'
				), 
			'westworld-2018' => array( 
				'expires'    => '2018-12-31',
				'banner_id'  => '068G1JD09XF3D3H7QXG2', 
				'linkid'     => 'b3f825e632dd8ff260a3ef363e05ae45' ,
				'campaign'   => 'primevideochannels'
				), 
			'britbox-2018'   => array( 
				'expires'    => '2018-12-31',
				'banner_id'  => '062FRX60FAE1CTM89V82', 
				'linkid'     => '6a32a23a758b0b8183f887d9088877d5' ,
				'campaign'   => 'primevideochannels'
				), 
			'prime-2018'     => array( 
				'expires'    => '2018-12-31',
				'banner_id'  => '1KDYJTM5G5NPVXW1V2R2', 
				'linkid'     => '2c1ad740dc275afccec6feb6a7e9a5e7' ,
				'campaign'   => 'primevideochannels'
				), 
			'got-2018'       => array( 
				'expires'    => '2018-12-31',
				'banner_id'  => '06BB0SBR8G81YR8KW9R2', 
				'linkid'     => 'ac02c962ab5b66869371e9cb7122e3e9' ,
				'campaign'   => 'primevideochannels'
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
		$ads = '<!-- BEGIN Amazon Ads --><div class="affiliate-ads amazon amazon-bounties"><iframe src="//rcm-na.amazon-adsystem.com/e/cm?o=1&p=' . $amzn_assoc_p . '&l=ur1&category=' . $bounty['campaign'] . '&banner='. $bounty['banner_id'] . '&f=ifr&lc=pf4&linkID=' . $bounty['linkid'] . '&t=lezpress-20&tracking_id=lezpress-20" width="' . $width . '" height="' . $height . '" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe></div><!-- END Amazon Ads -->';

		return $ads;

	}

}

new LP_Advertising();