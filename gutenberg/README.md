This project was bootstrapped with [Create Guten Block](https://github.com/ahmadawais/create-guten-block).

## About

These are the various Gutenblocks

## Development Notes

The source code is located in `/src/` - that's where most (if not all) of your work will happen. When built, the new code will deploy to the `/dist/` folder.

The overall code is called from the `/gutenberg/_main.php` file.

* `blocks.js` - A list of all the separate JS files included

_Author Box_
* `author-box/block.js`

_Listicle_
* `/listicle/listicle.js` - The main listicle file
* `/listicle/listitem.js` - Individual list items (this is only usable inside the Listicles block)
* `/listicle/listdt.js` - The list title
* `/listicle/listdd.js` - The list content (this allows you to add as many sub blocks as you can)

### Notes

Gutenberg is _very_ sensitive to changes, which can invalidate a block and cause it to no longer output properly. Unless you've written in deprecation clauses, be careful when editing.

1. Do _not_ rename any functions
2. Do _not_ change the output

Basically, leave it alone as much as possible.

## Installation and Building

1. `npm install`
    - Install the components you'll need
2. `npm start`
    - Use to compile and run the block in development mode.
    - Watches for any changes and reports back any errors in your code.
    - This will create usable, but not compressed, code.
3. `npm run build`
    - Use to build production code for your block inside `dist` folder.
    - Runs once and reports back the gzip file sizes of the produced code.

You can find the most recent version of the official CGB guide [here](https://github.com/ahmadawais/create-guten-block).