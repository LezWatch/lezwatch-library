## LezWatch Library

Code shared by all LezWatch sites

## Description

Instead of an MU Plugin, this is a library of code that is called by the sub-plugins. This way updates can be segmented. It lives in `/wp-content/library/`

Features include:

* Disabled comments on media files
* Customized Login Pages
* And ...

### Advertising

Global Advertising code

_Display Affiliate Ads_

Usage: `[affiliates type={random|genesis|facetwp|dreamhost} size={heightxwidth}]`

(Currently all ads are 300x250 for ... reasons)

_Display Amazon Ads_

Usage: `[amazon-ads type={banner|gift-card} size={468x30}]`

### Assets

* CSS for Author Box shortcode
* CSS for Symbolicons on Admin
* Images (Diane flipping people off)
* FacetWP Pagination JS
* Symbolicons
* Symbolicons Color

### Features

* Dashboard
    * Custom column for featured images in posts lists
    * Removal of self pings
* Embeds (Work in Classic Editor and Gutenberg)
    * Indiegogo
    * Gleam
    * DisneyABCPress videos
* Shortcodes (See Details Below)
    * Author Box
    * Badges
    * Copyright Year
    * Gleam Embed
    * Glossary
    * Number of Posts
    * Spoiler Warning
* Upgrades (everything auto updates)

#### Shortcodes

Custom Shortcodes:

_Author Box_

Usage: `[author-box users=username]`

_Badges_

Insert Bootstrap badge code as a shortcode not HTML

Usage: `[badge url=LINK class="class class" role="role"]TEXT[/badge]`

_Copyright Year_

Usage: `[copyright year=(start year) text=(copyright text)]`

Attributes:
* year = (int) start year. (default: current year)
* text = (text) copyright message. (default: &copy; )

_Gleam_

Usage: `[gleam url="https://gleam.io/iR0GQ/gleam-demo-competition"]Gleam Demo Competition[/gleam]`

_Glossary_

Show Category Icons used for taxonomies.

Usage: `[glossary taxonomy=TAXONOMY]`

_IndieGoGo_

Usage: `[indiegogo url=URL]`

_Number of Posts via shortcodes_

Usage: `[numposts data="posts" posttype="post type" term="term slug" taxonomy="taxonomy slug"]`

Attributes:
* data = `[posts|taxonomy]`
* posttype = post type
* term = term slug
* taxonomy = taxonomy slug

_Spoilers_

Usage: `[spoilers]` or `[spoilers warning="OMG SPIDERS!!!"]`

### Gutenberg Widgets

* Spoiler Warning - Insert and edit

### Plugins

Support for specific plugins.

* Jetpack:
  * Show Feedback in "Right Now"
  * Custom Icon for Feedback in "Right Now"
  * Mark feedbacks as having been answered

### Vendor

Vendor code used by Composer. _DO NOT_ exclude from GitHub or deploys.

* AWS SDK (Official)

## Development

Update code like you normally would. If you don't want to push it anywhere, make a local branch. Always remember, merge to **development** first. If that works, do a pull request to **master** and when it's done, it'll update properly.

To update libraries, run `composer update`

### Deployment

Pushes to branches are automatically deployed via Codeship as follows:

* Development: [lwtv.dream.press](https://lwtv.dream.press)
* Master: [lezwatchtv.com](https://lezwatchtv.com), [lezwatchcommercials.com](https://lezwatchcommercials.com), [lezpress.com](https://lezpress.com)
