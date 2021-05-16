This project was originally bootstrapped with [Create Guten Block](https://github.com/ahmadawais/create-guten-block) and as of May 2021, it has been ported to the official [Create Block](https://developer.wordpress.org/block-editor/handbook/tutorials/create-block/wp-plugin/) tool.

## About

These are the various Blocks for the block based editor (aka Gutenberg), available from Wordpress 5.0 and up.

## Development Notes

The source code is located in `/src/` - that's where most (if not all) of your work will happen. When built, the new code will deploy to the `/build/` folder.

The overall code is called from the `/build/_main.php` file.

* `src/index.js` - A list of all the separate JS files included

_Featured Image_
* `src/featured-image/block.js`

_Private Note Box_
* `src/private-note/block.js`

_Spoiler Warning Box_
* `src/spoiler/block.js`

### Notes

Gutenberg is _very_ sensitive to changes, which can invalidate a block and cause it to no longer output properly. Unless you've written in deprecation clauses, be careful when editing.

1. Do _not_ rename any functions
2. Do _not_ change the output

Basically, leave it alone as much as possible. You can safely fiddle with CSS a lot of the time, but that's often it.

## Installation and Building

* `$ npm install` - Install and update things.
* `$ npm start` - Starts the build for development.
* `$ npm run build` - Builds the code for production.
* `$ npm run format` - Formats files.
* `$ npm run lint:css` - Lints CSS files.
* `$ npm run lint:js` - Lints JavaScript files.
* `$ npm run packages-update` - Updates WordPress packages to the latest version.
