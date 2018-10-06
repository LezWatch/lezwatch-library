/**
 * BLOCK: Author Box
 */

//  Import CSS.
import './style.scss';
import './editor.scss';

const { registerBlockType } = wp.blocks;
const { createElement, Fragment } = wp.element;
const { InspectorControls } = wp.editor;
const { ServerSideRender, TextControl, PanelBody, SelectControl } = wp.components;

registerBlockType( 'lez-library/author-box', {
	title: 'Author Box',
	icon: <svg aria-hidden="true" data-prefix="fas" data-icon="portrait" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-portrait fa-w-12 fa-3x"><path fill="currentColor" d="M336 0H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48zM192 128c35.3 0 64 28.7 64 64s-28.7 64-64 64-64-28.7-64-64 28.7-64 64-64zm112 236.8c0 10.6-10 19.2-22.4 19.2H102.4C90 384 80 375.4 80 364.8v-19.2c0-31.8 30.1-57.6 67.2-57.6h5c12.3 5.1 25.7 8 39.8 8s27.6-2.9 39.8-8h5c37.1 0 67.2 25.8 67.2 57.6v19.2z" class=""></path></svg>,
	category: 'lezwatch',
	className: false,
	attributes: {
		users: {
			type: 'string',
		}
	},

	edit: props => {

		const { attributes: { placeholder }, setAttributes } = props;

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title={ 'Author Box Settings' }>
						<SelectControl
							label={ 'Username' }
							value={ props.attributes.users }
							options={ [
								{ label: 'Choose a user...', value: null },
								{ label: 'Mia', value: 'mia' },
								{ label: 'Mika', value: 'ipstenu' },
								{ label: 'Nikki', value: 'NikkiT' },
								{ label: 'Tracy', value: 'liljimmi' },
							] }
							onChange={ ( value ) => props.setAttributes( { users: value } ) }
						/>
					</PanelBody>
				</InspectorControls>
				<ServerSideRender
					block='lez-library/author-box'
					attributes={ props.attributes }
				/>
			</Fragment>
		);
	},

	save() {
		// Rendering in PHP
		return null;
	},

} );
