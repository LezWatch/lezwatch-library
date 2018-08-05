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
						layouts={ [
							{ name: 'column-1', label: 'Column 1', icon: 'columns' },
						] }
						template={ [
							[ 'lez-library/listtitle', { layout:'column-1' } ],
							[ 'lez-library/listitem', { layout:'column-1' } ],
						] }
						templateLock="all"
						allowedBlocks={ [
							[ 'lez-library/listitem' ], [ 'lez-library/listtitle' ]
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
