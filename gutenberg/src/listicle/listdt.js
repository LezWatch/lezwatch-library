

/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { InnerBlocks, RichText } = wp.editor;
const { registerBlockType } = wp.blocks;
const { Fragment } = wp.element;

registerBlockType( 'lez-library/listdt', {

	title: 'List Title',
	parent: [ 'lez-library/listitem' ],
	icon: 'migrate',
	category: 'lezwatch',
	attributes: {
		content: {
			type: 'array',
			source: 'children',
			selector: 'dt',
		},
		placeholder: {
			type: 'string',
			default: 'Title',
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
					formattingControls={ [ 'italic', 'strikethrough', 'bold', 'link' ] }
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
