import CodeMirror from 'codemirror';
import 'codemirror/keymap/sublime';
import 'codemirror/addon/edit/closebrackets';
import 'codemirror/addon/edit/matchbrackets';
import 'codemirror/addon/edit/trailingspace';

import 'codemirror/mode/css/css';
import 'codemirror/mode/htmlmixed/htmlmixed';
import 'codemirror/mode/javascript/javascript';
import 'codemirror/mode/markdown/markdown';
import 'codemirror/mode/php/php';
import 'codemirror/mode/shell/shell';

const { useRef, useEffect, useState } = window.wp.element;

function Editor( props ) {

	const editorRef = useRef();

	const [ initialized, setInitialized ] = useState( false );
	const [ editor, setEditor ] = useState( null );

	useEffect( () => {
		if ( initialized ) {
			return;
		}

		if ( null !== editorRef.current ) {
			setInitialized( true );

			const editorObject = CodeMirror.fromTextArea( editorRef.current, {
				mode             : window.CODE_BLOCK_EDITOR_VARS.languages[ props.language ].codemirror_val,
				theme            : window.CODE_BLOCK_EDITOR_VARS.theme,
				indentUnit       : 4,
				indentWithTabs   : true,
				lineNumbers      : true,
				matchBrackets    : true,
				autoCloseBrackets: true,
				showTrailingSpace: true,
				addModeClass     : true,
			} );

			editorObject.setOption(
				'lineNumbers',
				'1' === window.CODE_BLOCK_EDITOR_VARS.lineNumbers ? true : false
			);

			editorObject.on( 'change', function( obj ) {
				props.onChange( obj.getValue() );
			} );

			setEditor( editorObject );
		}
	} );

	useEffect( () => {
		if ( null === editor ) {
			return;
		}
		editor.setOption( 'mode', props.language );
	}, [ props.language ] );

	return (
		<textarea
			id={ props.textareaId }
			value={ props.code }
			ref={ editorRef }
		></textarea>
	);
}

export default Editor;
