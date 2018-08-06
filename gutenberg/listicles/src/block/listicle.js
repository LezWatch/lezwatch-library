/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
const { Fragment } = wp.element;
const { createBlock, registerBlockType } = wp.blocks;
const { InnerBlocks } = wp.editor;

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
	},

	description: 'Add a block that displays a list item. Make a separate block for each item, which is not the greatest solution, but it\'s what we have.',

	supports: {
		align: [ 'wide', 'full' ],
	},

	edit: props => {

		const { attributes: { placeholder },
			 className, setAttributes,  } = props;

		return (
			<Fragment>
				<dl className={ className }>
					<InnerBlocks
						template={ [
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
