## LezWatch Library

Code shared by all LezWatch sites

## Description

Instead of an MU Plugin, this is a library of code that is called by the sub-plugins. This way updates can be segmented. It lives in `/wp-content/library/`

Features include:

* Disabled comments on media files
* Customized Login Pages
* And ...

### Assets

* Amazon API
* CSS
    * Author Box shortcode
    * Symbolicons on Admin
    * WP Admin tweaks
* Images
    * Diane flipping people off
    * login page icons
* FacetWP Pagination JS

### Features

* Dashboard
    * Custom column for featured images in posts lists
    * Removal of self pings
* Embeds
    * DisneyABCPress videos
    * Gleam
    * GoFundMe
    * Indiegogo
* Shortcodes (See details below)
    * Badges
    * Copyright Year
    * Number of Posts
* Upgrades (everything auto updates)

#### Custom Shortcodes

_Badges_

Insert Bootstrap badge code as a shortcode not HTML

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

### Gutenberg Blocks

For development information, please read [gutenberg/README.md](the Gutenberg Readme)

* Featured Image
* Spoiler Warning - Insert and edit
* Private Notes - Only displays in the editor.

_Featured Image_

Allows featured images to be added to post content. This will **not** make the image show in-line, it's for the backend only.

_Private Note_


### Plugins

Support for specific plugins.

* Jetpack:
  * Show Feedback in "Right Now"
  * Custom Icon for Feedback in "Right Now"
  * Mark feedbacks as having been answered
  * Protection from spammers and harassers

* Comment Probation:
  * Forked due to lack of support and changes needed for WP 5.5

## Development

Update code like you normally would. If you don't want to push it anywhere, make a local branch. Always remember, merge to **development** first. If that works, do a pull request to **master** and when it's done, it'll update properly.

At this time, there are no 3rd party libraries.

### Deployment

Pushes to branches are automatically deployed via Codeship as follows:

* Development: [lezwatchtvcom.stage.site](https://lezwatchtvcom.stage.site)
* Main: [lezwatchtv.com](https://lezwatchtv.com), [lezwatchcommercials.com](https://lezwatchcommercials.com), [lezpress.com](https://lezpress.com)
