/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { InnerBlocks } = wp.editor;
const { registerBlockType } = wp.blocks;
const { Fragment } = wp.element;

registerBlockType( 'lez-library/listdd', {

	title: __( 'List Content', 'lezwatch-library' ),
	parent: [ 'lez-library/listitem' ],
	icon: 'migrate',
	category: 'formatting',

	description: __( 'A list description (aka content).', 'lezwatch-library' ),

	edit: function( props ) {
		const { className } = props;

		return (
			<dd className={ className }>
				<InnerBlocks templateLock={ false } />
			</dd>
		);
	},

	save: function( props ) {
		const { attributes: { className } } = props;
		return (
			<dd className={ className }>
				<InnerBlocks.Content />
			</dd>
		);
	},
} );
