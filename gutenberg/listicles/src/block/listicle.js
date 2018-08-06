/**
 * External dependencies
 */
import classnames from 'classnames';
import memoize from 'memize';

/**
 * WordPress dependencies
 */
const { Fragment } = wp.element;
const { createBlock, registerBlockType } = wp.blocks;
const { InnerBlocks, InspectorControls } = wp.editor;
const { PanelBody, ToggleControl, RangeControl } = wp.components;

/**
 * Some defaults
 */

const MAX_ITEMS = 18;

/**
 * Returns the layouts configuration for a given number of columns.
 *
 * @param {number} items Number of items.
 *
 * @return {Object[]} Layout configuration.
 */
const getListicleTemplate = memoize( ( items ) => {
	//return times( columns, () => [ 'core/column' ] );
	[ 'lez-library/listitem' ]
} );

/**
 * Internal dependencies
 */
import './style.scss';
import './editor.scss';

registerBlockType( 'lez-library/listicles', {

	title: 'Listicle',
	icon: 'excerpt-view',
	category: 'layout',
	attributes: {
		items: {
			type: 'number',
			default: 2,
		},
		reversed: {
			type: 'boolean',
			default: false
		}
	},

	description: 'Add a block that displays a list item. Make a separate block for each item, which is not the greatest solution, but it\'s what we have.',

	supports: {
		align: [ 'wide', 'full' ],
	},

	edit: props => {

		const { attributes: { placeholder },
			 className, setAttributes,  } = props;
		const { items } = props.attributes;

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title={ 'Listicle Settings' }>
						<RangeControl
							label={ 'Items' }
							value={ items }
							onChange={ ( value ) => setAttributes( { items: value } ) }
							min={ 1 }
							max={ MAX_ITEMS }
						/>
						<ToggleControl
							label='Reversed'
							checked={ props.attributes.reversed }
							onChange={ () => props.setAttributes( { reversed: ! props.attributes.reversed } ) }
						/>
					</PanelBody>
				</InspectorControls>
				<dl className={ className }>
					<InnerBlocks
						//template={ getListicleTemplate( items ) }
						template= { [
							[ 'lez-library/listitem' ]
						] }
						allowedBlocks={ [
							[ 'lez-library/listitem' ]
						] }
					/>
				</dl>
			</Fragment>
		);
	},

	save: props => {
		const { attributes: { className } } = props;
		return (
			<dl className={ className }>
				<InnerBlocks.Content />
			</dl>
		);
	},

} );
