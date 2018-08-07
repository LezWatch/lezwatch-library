/**
 * WordPress dependencies
 */
const { InnerBlocks } = wp.editor;
const { registerBlockType } = wp.blocks;
const { Fragment } = wp.element;

registerBlockType( 'lez-library/listdd', {

	title: 'List Content',
	parent: [ 'lez-library/listitem' ],
	icon: 'migrate',
	category: 'formatting',

	description: 'A list description (aka content).',

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
