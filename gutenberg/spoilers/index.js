( function( blocks, element, editor, components ) {

	const { registerBlockType } = blocks;
	const { RichText } = editor;
	const { createElement } = element;
	const { InspectorControls } = editor;
	const { SelectControl, ToggleControl } = components;

	registerBlockType( 'lez-library/spoilers', {
		title: 'Spoiler Warning',
		icon: 'vault',
		category: 'lezwatch',
		customClassName: false,
		className: false,
		attributes: {
			content: {
				source: 'children',
				selector: 'div',
				default: 'Warning: This post contains spoilers!'
			}
		},

		save: function( props ) {
			const content = props.attributes.content;
			const container = createElement(
				'div', { className: 'alert alert-danger' },
				React.createElement( RichText.Content, { value: content })
			);
			return container;
		},

		edit: function( props ) {
			const content = props.attributes.content;
			const focus = props.focus;

			function onChangeSpoiler( newContent ) {
				props.setAttributes( { content: newContent } );
			}

			const editSpoiler = createElement(
				RichText,
				{
					tagName: 'div',
					className: props.className,
					onChange: onChangeSpoiler,
					value: content,
					focus: focus,
					onFocus: props.setFocus,
				}
			);

			return createElement(
				'div', { className: 'alert alert-danger' },
				editSpoiler
			);
		},

	});

})(
	window.wp.blocks,
	window.wp.element,
	window.wp.editor,
	window.wp.components,
	window.wp.i18n
);
