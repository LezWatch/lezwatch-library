/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { InnerBlocks } = wp.editor;
const { registerBlockType } = wp.blocks;
const { Fragment } = wp.element;

registerBlockType( 'lez-library/listitem', {

	title: __( 'List Item', 'lezwatch-library' ),
	parent: [ 'lez-library/listicles' ],
	icon: 'editor-rtl',
	category: 'formatting',

	description: __( 'An individual list item.', 'lezwatch-library' ),

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
