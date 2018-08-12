// License: GPLv2+
// https://gist.github.com/pento/cf38fd73ce0f13fcf0f0ae7d6c4b685d

var el = wp.element.createElement,
	registerBlockType = wp.blocks.registerBlockType,
	ServerSideRender = wp.components.ServerSideRender,
	TextControl = wp.components.TextControl,
	InspectorControls = wp.editor.InspectorControls;

registerBlockType( 'lez-library/author-box', {
	title: 'Author Box',
	icon: 'id',
	category: 'lezwatch',


	edit: function( props ) {
		return [
			el( ServerSideRender, {
				block: 'lez-library/author-box',
				attributes: props.attributes,
			} ),
			el( InspectorControls, {},
				el( TextControl, {
					label: 'Users',
					value: props.attributes.users,
					onChange: ( value ) => { props.setAttributes( { users: value } ); },
				} )
			),
		];
	},

	save: function() {
		return null;
	},
} );
