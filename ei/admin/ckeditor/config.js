/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.removeButtons = 'Form,Checkbox,Radio,TextField,Textarea,Select,Button,HiddenField,Indent,Outdent,Blockquote,CreateDiv,BidiLtr,BidiRtl,Language,Format,Maximize,ShowBlocks,About,Smiley';
	
	config.contentsCss = 'http://fonts.googleapis.com/css?family=Asap:400,700,700italic,400italic';

	config.font_names = config.font_names + 'Asap/Asap;';
};

CKEDITOR.stylesSet.add( 'my_styles', [
    // Block-level styles
    { name: 'Blue Title', element: 'h2', styles: { 'color': 'Blue' } },
    { name: 'Red Title' , element: 'h3', styles: { 'color': 'Red' } },

    // Inline styles
    { name: 'CSS Style', element: 'span', attributes: { 'class': 'my_style' } },
    { name: 'Marker: Yellow', element: 'span', styles: { 'background-color': 'Yellow' } }
] );
