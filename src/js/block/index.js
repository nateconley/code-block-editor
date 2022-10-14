const { registerBlockType } = window.wp.blocks;
const { __ }                = window.wp.i18n;
const { useBlockProps }     = window.wp.blockEditor;
const { SelectControl }     = window.wp.components;

import Editor from './Components/Editor';

registerBlockType(
	'code-block-editor/code-block-editor',
	{
		attributes: {
			language: {
				type   : 'string',
				default: Object.keys( window.CODE_BLOCK_EDITOR_VARS.languages )[0],
			},
			code: {
				type   : 'string',
				default: '',
			},
		},
		apiVersion: 2,
		title: __( 'Code Snippet', 'code-viewer' ),
		description: __( 'Display a code block.', 'code-viewer' ),
		category: 'widgets',
		icon: 'editor-code',
		supports: {
			// Removes support for an HTML mode.
			html: false,
		},
		edit: function( props ) {

			const { language, code } = props.attributes;
			const blockProps = useBlockProps( {
				'className' : 'code-block-editor',
			} );

			// Render the block.
			return <div { ...blockProps }>
				<SelectControl
					label={ __( 'Select Language:', 'code-viewer' ) }
					value={ language }
					options={ Object.keys( window.CODE_BLOCK_EDITOR_VARS.languages ).map( ( language ) => {
						return {
							label: window.CODE_BLOCK_EDITOR_VARS.languages[ language ].name,
							value: language,
						}
					} ) }
					onChange={ value => { props.setAttributes( { language: value } ) } }
				/>
				<Editor
					textareaId={ `code-viewer-textarea-${ blockProps.id }` }
					code={ code }
					language={ language }
					onChange={ value => { props.setAttributes( { code: value } ) } }
				/>
			</div>;
		},
	}
);
