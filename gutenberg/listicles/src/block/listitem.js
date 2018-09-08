/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { InnerBlocks } = wp.editor;
const { registerBlockType } = wp.blocks;
const { Fragment } = wp.element;

registerBlockType( 'lez-library/listitem', {

	title: 'List Item',
	parent: [ 'lez-library/listicles' ],
	icon: 'editor-rtl',
	category: 'lezwatch',

	description: 'An individual list item.',

	edit: function( props ) {
		const { className } = props;

		return (
				<InnerBlocks
				template={ [
					[ 'lez-library/listdt' ],
					[ 'lez-library/listdd' ],
				] }
				allowedBlocks={ [
					[ 'lez-library/listdt' ], [ 'lez-library/listdd' ]
				] }
				templateLock={ 'all' }
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
