( function( wp ) {
	var registerBlockType = wp.blocks.registerBlockType;
	var el = wp.element.createElement;
	var __ = wp.i18n.__;

	registerBlockType( 'library/spoilers', {

		title: __( 'Spoiler Warning' ),
		icon: 'vault',
		category: 'widgets',
		supportHTML: false,

		edit: function( props ) {
			return el(
				'div',
				{ className: props.className },
				__( 'Warning: This post contains spoilers!' )
			);
		},

		save: function() {
			return el(
				'div',
				{ className: 'alert alert-danger'},
				__( 'Warning: This post contains spoilers!' )
			);
		}
	} );
} )(
	window.wp
);
