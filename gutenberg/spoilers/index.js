( function( blocks, i18n, element ) {
	var el = element.createElement;
	var __ = i18n.__;
	var RichText = blocks.RichText;

	blocks.registerBlockType( 'library/spoilers', {

		title: __( 'Spoiler Warning' ),
		icon: 'vault',
		category: 'widgets',
		supportHTML: false,

		attributes: {
			content: {
				type: 'array',
				source: 'children',
				selector: 'div',
			},
		},

		edit: function( props ) {
			var content = props.attributes.content || 'Warning: This post contains spoilers!';
			var focus = props.focus;
			function onChangeContent( newContent ) {
				props.setAttributes( { content: newContent } );
			}

			return el(
				RichText,
				{
					tagName: 'div',
					className: props.className,
					onChange: onChangeContent,
					value: content,
					focus: focus,
					onFocus: props.setFocus
				}
			);
		},

		save: function( props ) {
			return el(
				'div',
				{ className: 'alert alert-danger'},
				props.attributes.content
			);
		}
	} );
} )(
	window.wp.blocks,
	window.wp.i18n,
	window.wp.element
);