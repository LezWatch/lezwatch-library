

/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { InnerBlocks, RichText } = wp.editor;
const { registerBlockType } = wp.blocks;
const { Fragment } = wp.element;

registerBlockType( 'lez-library/listdt', {

	title: __( 'List Title', 'lezwatch-library' ),
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
			default: __( 'Title', 'lezwatch-library' ),
		},
	},

	description: __( 'An individual list title.', 'lezwatch-library' ),

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
