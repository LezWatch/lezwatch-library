/**
 * Gutenberg Blocks
 *
 * All blocks related JavaScript files should be imported here.
 * You can create a new block folder in this dir and include code
 * for that block here as well.
 *
 * All blocks should be included here since this is the file that
 * Webpack is compiling as the input file.
 */

// Author Box
import './author-box/block.js';

// Listicles
import './listicle/listicle.js'; // Main Listicle (the dl)
import './listicle/listitem.js'; // List Items (includes dt and dd)
import './listicle/listdt.js';   // The title of the item
import './listicle/listdd.js';   // Free text!

// Spoiler
import './spoiler/block.js';
