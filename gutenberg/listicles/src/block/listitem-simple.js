/**
 * WordPress dependencies
 */
const { InnerBlocks } = wp.editor;
const { registerBlockType } = wp.blocks;
const { Fragment } = wp.element;

/**
 * Internal dependencies
 */
import './style.scss';
import './editor.scss';

registerBlockType( 'lez-library/listitem', {

	title: 'List Item',
	parent: [ 'lez-library/listicles' ],
	icon: 'editor-rtl',
	category: 'formatting',

	description: 'An individual list item.',

	edit: function( props ) {
		const { className } = props;

		return (
				<InnerBlocks
				layouts={ [
					{ name: 'column-2', label: 'Column 2', icon: 'columns' },
				] }
				template={ [
					[ 'lez-library/listdt', { layout:'column-2', placeholder: 'Title' } ],
					[ 'lez-library/listdd', { layout:'column-2' } ],
				] }
				allowedBlocks={ [
					[ 'lez-library/listdt' ], [ 'lez-library/listdd' ]
				] }
				/>
		);
	},

	save: function( props ) {
		const { attributes: { className } } = props;
		return (
			<InnerBlocks.Content />
		);
	},
} );
