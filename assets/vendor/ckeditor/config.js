/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// =================== CONFIG ADD NEW PLUGINS ===================
	config.extraPlugins = 'youtube, codesnippet, tableresizerowandcolumn, pbckcode, sourcedialog, imageresizerowandcolumn, pastebase64, texttransform, quicktable, toc, backgrounds';
	
	// Ubah tema plugin code snippet
	config.codeSnippet_theme = 'monokai_sublime';

	// Ubah pengaturan quick table
	config.qtRows = 10; // Count of rows
	config.qtColumns = 10; // Count of columns
	config.qtBorder = '1'; // Border of inserted table
	config.qtWidth = '100%'; // Width of inserted table
	config.qtStyle = { 'border-collapse' : 'collapse' };
	config.qtClass = 'table table-responsive table-bordered table-striped'; // Class of table
	config.qtCellPadding = '0'; // Cell padding table
	config.qtCellSpacing = '0'; // Cell spacing table
	config.qtPreviewBorder = '4px double black'; // preview table border 
	config.qtPreviewSize = '4px'; // Preview table cell size 
	config.qtPreviewBackground = '#c8def4'; // preview table background (hover)
	
	// =================== CONFIG TOOLBAR ICON ===================
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools', 'Sourcedialog' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'about', groups: [ 'about' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'texttransform', groups: [ 'TransformTextToUppercase', 'TransformTextToLowercase', 'TransformTextCapitalize', 'TransformTextSwitcher' ] },
		'/',
		{ name: 'insert', groups: [ 'insert', 'Youtube', 'CodeSnippet', 'pbckcode', 'toc' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'others', groups: [ 'others' ] }
	];

	config.removeButtons = 'Form, Checkbox, Radio, TextField, Textarea, Select,NewPage,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,SImage,Source';


	// =================== CONFIG GENERAL ===================
    CKEDITOR.config.language = 'en';
    CKEDITOR.config.uiColor = '#259DF3';
    CKEDITOR.config.height = 400;
    CKEDITOR.config.toolbarCanCollapse = true;
    CKEDITOR.config.allowedContent = true;
    CKEDITOR.config.skin = 'moono-lisa';

	// =================== CONFIG UPLOAD IMAGE or FILES ===================
	config.filebrowserBrowseUrl = 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
	config.filebrowserImageBrowseUrl = 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';
	config.filebrowserFlashBrowseUrl = 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';
	config.filebrowserUploadUrl = 'ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';
	config.filebrowserImageUploadUrl = 'ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';
	config.filebrowserFlashUploadUrl = 'ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash';
};
