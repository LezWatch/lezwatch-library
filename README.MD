## LezWatch Library

Code shared by all LezWatch sites

## Description

Instead of an MU Plugin, this is a library of code that is called by the sub-plugins. This way updates can be segmented.

Includes:

* Automatic upgrades for themes, plugins, and core WordPress (Skipping Akismet, Hello Dolly, and the default themes).

### Advertising

Global Advertising code

_Display Affiliate Ads_

Usage: `[affiliates type={random|genesis|facetwp|dreamhost} size={heightxwidth}]`

(Currently all ads are 300x250 for ... reasons)

_Display Amazon Ads_

Usage: `[amazon-ads type={banner|gift-card} size={468x30}]`

### Assets

* AWS Phar
* CSS for Author Box shortcode
* CSS for Symbolicons
* JS for CatSignal
* Symbolicons
* Symbolicons Color

### Dashboard customizations

* Prevent self pings by interlinks
* Show Feedback in "Right Now"
* Custom Icon for Feedback in "Right Now"
* Custom column with icon for featured images in posts

### Shortcodes

Custom Shortcodes:

_Display Copyright Year_

Usage: `[copyright year=(start year) text=(copyright text)]`

Attributes:

* year = (int) start year. (default: current year)
* text = (text) copyright message. (default: &copy; )

_Number of Posts via shortcodes_

Usage: `[numposts data="posts" posttype="post type" term="term slug" taxonomy="taxonomy slug"]`

Attributes:
* data = `[posts|taxonomy]`
* posttype = post type
* term = term slug
* taxonomy = taxonomy slug

_Display Author Box_

Usage: `[author-box users=username]`

_Socialicons_

Shortcodes to support SVGs for Social Icons (Twitter, Facebook, Tumblr, Google+)

## Deployment

Pushes to the `master` branch are automatically deployed via Codeship to:

* lezwatchtv.com
* lwtv.dream.press
* lezwatchcommercials.com