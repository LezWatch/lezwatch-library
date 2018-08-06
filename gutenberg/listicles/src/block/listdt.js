/**
 * WordPress dependencies
 */
const { InnerBlocks, RichText } = wp.editor;
const { registerBlockType } = wp.blocks;
const { Fragment } = wp.element;

/**
 * Internal dependencies
 */
import './style.scss';
import './editor.scss';

registerBlockType( 'lez-library/listdt', {

	title: 'List Title',
	parent: [ 'lez-library/listitem' ],
	icon: 'migrate',
	category: 'formatting',
	attributes: {
		content: {
			type: 'array',
			source: 'children',
			selector: 'dt',
		},
		placeholder: {
			type: 'string',
		},
	},

	description: 'An individual list title.',

	edit( { attributes, setAttributes, isSelected, className } ) {
		const { content } = attributes;

		return(
			<Fragment>
				<RichText
					tagName='dt'
					className={ className }
					value={ content }
					onChange={ ( content ) => setAttributes( { content } ) }
				/>
			</Fragment>
		);
	},

	save( { attributes, className } ) {
		const { content } = attributes;

		return (
			<RichText.Content
				tagName='dt'
				className={ className }
				value={ content }
			/>
		);
	},

} );
