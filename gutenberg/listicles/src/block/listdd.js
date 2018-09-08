/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { InnerBlocks } = wp.editor;
const { registerBlockType } = wp.blocks;
const { Fragment } = wp.element;

registerBlockType( 'lez-library/listdd', {

	title: 'List Content',
	parent: [ 'lez-library/listitem' ],
	icon: 'migrate',
	category: 'lezwatch',

	description: 'A list description (aka content).',

	edit: function( props ) {
		const { className } = props;

		return (
			<dd className={ className }>
				<InnerBlocks
					allowedBlocks={ [
						[ 'core/audio' ],
						[ 'core/embed' ],
						[ 'core/freeform' ],
						[ 'core/gallery' ],
						[ 'core/html' ],
						[ 'core/image' ],
						[ 'core/list' ],
						[ 'core/paragraph' ],
						[ 'core/pullquote' ],
						[ 'core/quote' ],
						[ 'core/shortcode' ],
						[ 'core/verse' ],
						[ 'core/video' ]
					] }
					templateLock={ false }
				/>
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
