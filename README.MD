## LezWatch Library

Code shared by all LezWatch sites

## Description

Instead of an MU Plugin, this is a library of code that is called by the sub-plugins. This way updates can be segmented. It lives in `/wp-content/library/`

Features include:

* Disabled comments on media files
* Customized Login Pages
* And ...

### Assets

* CSS
    * Author Box shortcode
    * Symbolicons on Admin
    * WP Admin tweaks
* Images
    * Diane flipping people off
    * login page icons
* FacetWP Pagination JS

### Blocks

For development information, please read [blocks/README.md](the Gutenberg Readme)

* Featured Image
* Private Notes
* Spoiler Warning

_Featured Image_

Allows featured images to be added to post content. This will **not** make the image show in-line, it's for the backend only.

_Private Note_

Shows a private note, meant for editors only, usually when we have to remove content by actor request.

_Spoiler Warning_

Inserts a boilerplate, editable, block that warns people about spoilers.

### Features

* Clickjacking
  * Some SAMEORIGIN protection which doesn't really do much but makes 'security reporters' hush
* Dashboard
  * Custom column for featured images in posts lists
  * Removal of self pings
* Embeds
  * DisneyABCPress videos
  * Gleam
  * GoFundMe
  * Indiegogo
* GutenSlam
  * make Block Editor stop being such a dillhole and forget preferences.
* Shortcodes
  * Badges
  * Copyright Year
  * Number of Posts
* Spammers
  * Extracts list of spammer emails and domains
* Upgrades (everything auto updates)

#### Custom Shortcodes

_Badges_

Insert Bootstrap badge code as a shortcode.

Usage: `[badge url=LINK class="class class" role="role"]TEXT[/badge]`

_Copyright Year_

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

**Deprecated**

The following shortcodes shouldn't be used anymore. They've been replaced with Gutenberg Blocks.

* Author Box:  `[author-box users=username]`
* Embed Gleam: `[gleam url="https://gleam.io/iR0GQ/gleam-demo-competition"]Gleam Demo Competition[/gleam]`
* Embed IndieGoGo: `[indiegogo url=URL]`
* Glossary: `[glossary taxonomy=TAXONOMY]`
* Spoilers: `[spoilers]` or `[spoilers warning="OMG SPIDERS!!!"]`

### Plugins

Support for specific plugins.

* Comment Probation:
  * Forked due to lack of support and changes needed for WP 5.5

* Gravity Forms:
  * Protection from spammers via disallowed keys

* Jetpack:
  * Show Feedback in "Right Now"
  * Custom Icon for Feedback in "Right Now"
  * Mark feedbacks as having been answered
  * Protection from spammers via disallowed keys

## Development

Update code like you normally would. If you don't want to push it anywhere, make a local branch. Always remember, merge to **development** first. If that works, do a pull request to **production** and when it's done, it'll update properly.

At this time, there are **no** 3rd party libraries.

### Deployment

Pushes to branches are automatically deployed via Github Actions as follows:

* Development: [lezwatchtvcom.stage.site](https://lezwatchtvcom.stage.site)
* Main: [lezwatchtv.com](https://lezwatchtv.com), [lezwatchcommercials.com](https://lezwatchcommercials.com), [lezpress.com](https://lezpress.com), [docs.lezwatchtv.com](https://docs.lezwatchtv.com)
