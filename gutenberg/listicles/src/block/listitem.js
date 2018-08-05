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
