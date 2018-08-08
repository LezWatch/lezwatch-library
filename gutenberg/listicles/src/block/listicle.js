/**
 * External dependencies
 */
import classnames from 'classnames';
import memoize from 'memize';
import times from 'lodash/times';

/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { Fragment } = wp.element;
const { createBlock, registerBlockType } = wp.blocks;
const { InnerBlocks, InspectorControls } = wp.editor;
const { PanelBody, ToggleControl, RangeControl } = wp.components;

/**
 * Some defaults
 */
const MAX_ITEMS = 18;
const getItemsTemplate = memoize( ( items ) => {
	return times( items, () => [ 'lez-library/listitem' ] );
} );

/**
 * Internal dependencies
 */
import './style.scss';
import './editor.scss';

registerBlockType( 'lez-library/listicles', {

	title: __( 'Listicle', 'lezwatch-library' ),
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

	description: __( 'A block for listicles. Adjust the number with the slider, and flip it reversible if you so desire. Lists only can go up to 18 for managability.', 'lezwatch-library' ),

	edit: props => {

		const { attributes: { placeholder },
			 className, setAttributes,  } = props;
		const { items, reversed } = props.attributes;

		let reversai = '';
		let counter = '0';
		if ( reversed ) {
			reversai = 'reversed';
			counter = parseInt(`${ items }`)+1;
		}

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title={ __( 'Listicle Settings', 'lezwatch-library' ) }>
						<RangeControl
							label={ __( 'Items', 'lezwatch-library' ) }
							value={ items }
							onChange={ ( value ) => setAttributes( { items: value } ) }
							min={ 1 }
							max={ MAX_ITEMS }
						/>
						<ToggleControl
							label={ __( 'Reversed', 'lezwatch-library' ) }
							help={ ( checked ) => checked ? __( 'Reversed order (10 - 1 )', 'lezwatch-library' ) : __( 'Numerical order (1-10)', 'lezwatch-library' ) }
							checked={ props.attributes.reversed }
							onChange={ () => props.setAttributes( { reversed: ! props.attributes.reversed } ) }
						/>
					</PanelBody>
				</InspectorControls>
				<dl
					className={ `${ className } ${ reversai } listicle items-${ items }` }
					style={ { counterReset: `listicle-counter ${ counter }` } }
				>
					<InnerBlocks
						template={ getItemsTemplate( items ) }
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
		const { items, reversed } = props.attributes;

		let reversai = '';
		let counter = 0;
		if ( reversed ) {
			reversai = 'reversed';
			counter = parseInt(`${ items }`)+1;
		}

		return (
			<dl
				className={ `${ className } ${ reversai } listicle items-${ items }` }
				style={ { counterReset: `listicle-counter ${ counter }` } }
			>
				<InnerBlocks.Content />
			</dl>
		);
	},

} );
