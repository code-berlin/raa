/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.extraAllowedContent = 'ul(*);dl[class](accordion);dt;dd;table[class](data-table);td[style];th[style];*[class](*);*[id](*)';
	config.protectedSource.push(/<i[^>]*><\/i>/g);
	config.protectedSource.push(/<video[\s|\S]+?<\/video>/gm);
};
