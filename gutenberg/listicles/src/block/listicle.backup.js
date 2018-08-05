/**
 * External dependencies
 */
import { times, property, omit } from 'lodash/times';
import classnames from 'classnames';
import memoize from 'memize';

/**
 * WordPress dependencies
 */
const { __, sprintf } = wp.i18n;
const { PanelBody, RangeControl } = wp.components;
const { Fragment } = wp.element;
const { createBlock, registerBlockType } = wp.blocks;
const { InspectorControls, InnerBlocks } = wp.editor;

/**
 * Internal dependencies
 */
import './style.scss';
import './editor.scss';

/**
 * Allowed blocks constant is passed to InnerBlocks precisely as specified here.
 * The contents of the array should never change.
 * The array should contain the name of each block that is allowed.
 * In columns block, the only block we allow is 'lez-library/listitem'.
 *
 * @constant
 * @type {string[]}
*/
const ALLOWED_BLOCKS = [ 'lez-library/listitem' ];

/**
 * Returns the layouts configuration for a given number of items.
 *
 * @param {number} items Number of items in the listicle.
 *
 * @return {Object[]} Layout configuration.
 */
const getItemsTemplate = memoize( ( items ) => {
	return times( items, () => [ 'lez-library/listitem' ] );
} );

registerBlockType( 'lez-library/listicles', {

	title: 'Listicles',
	icon: 'excerpt-view',
	category: 'layout',
	attributes: {
		items: {
			type: 'number',
			default: 2,
		},
	},

	description: __( 'Add a block that displays multiple list items, and put whatever you want in each list item.' ),

	supports: {
		align: [ 'wide', 'full' ],
	},

	edit: function( props, setAttributes ) {

		const { items } = props.attributes;
		const classes = classnames( props.className, 'listicle' );

		// Creates a <p class='wp-block-cgb-block-single-block'></p>.
		return (
			<Fragment>
				<InspectorControls>
					<PanelBody>
                    // Status here. If you try to change the number it fails:
                    // TypeError: t is not a function. (In 't({items:e})', 't' is an instance of Object)
						<RangeControl
							label={ 'Items' }
							value={ items }
							onChange={ ( nextItems ) => {
								setAttributes( {
									items: nextItems,
								} );
							} }
							min={ 2 }
							max={ 16 }
						/>
					</PanelBody>
				</InspectorControls>
				<dl className={ classes }>
					<dt>This is a title</dt>
                    // These don't show at all as an option, fuck if I know.
					<InnerBlocks
						allowedBlocks={ ALLOWED_BLOCKS }
					/>
				</dl>
			</Fragment>
		);
	},

	// The "save" property must be specified and must be a valid function.
	save: function( props ) {
		const { items } = props.attributes;
		return (
			<dl className='listicle'>
				<dt>Title</dt>
				<InnerBlocks.Content />
			</dl>
		);
	},
} );
