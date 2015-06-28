<?php
/**
* SemanticImageAnnotator
* An Extension to Semantic Mediawiki which allows users to semantically annotate image files.
* @author Felix Obenauer
*/
if( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}
/**
 * For older versions of mediawiki, which don't support NS_FILE.
 */
if (!defined('NS_FILE')) {
	define('NS_FILE', NS_IMAGE);
}

$wgExtensionCredits['semantic'][] = array(
	'path' => __FILE__,
	'name' => 'Semantic Image Annotator',
	'version' => '0.6.0',
	'author' => 'Felix Obenauer',
	'url' => 'http://www.mediawiki.org/wiki/Extension:Semantic_Image_Annotator',
	'descriptionmsg'  => 'sia-description',
);

$wgMessagesDirs['SemanticImageAnnotator'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['SemanticImageAnnotator'] = __DIR__ . "/languages/SIA_Messages.php";

include_once('SIA_AjaxFunctions.php');

//Register the ResultFormatter and add the Class to the autoloaded classes
$smwgResultFormats['imageannotation'] = 'SIA_AnnotationPrinter';
$wgAutoloadClasses['SIA_AnnotationPrinter'] = dirname( __FILE__ ) . '/SIA_AnnotationPrinter.php';

//Add the ImageAnnotation Namespace to the Wiki:
$wgExtraNamespaces[380] = "ImageAnnotation";
define("NS_IMAGEANNOTATION", 380);
$wgExtraNamespaces[NS_IMAGEANNOTATION] = "ImageAnnotation";

$smwgNamespacesWithSemanticLinks += array( NS_IMAGEANNOTATION => true );


//Resources for the ResourceLoader:
$wgResourceModules['ext.SemanticImageAnnotator'] = array(
	'scripts' => array(
		'scripts/SIA_Constants.js',
		'scripts/SIA_removeAnnotation.js',
		'scripts/SIA_fileNS.js',
		'scripts/jquery.draw.js',
		'scripts/SIA_getAnnotations.js'
	),
	'styles' => array('styles/SIA.css'),
	'dependencies' => array( 'ext.semanticforms.main', 'ext.semanticforms.popupformedit' ),
	'localBasePath' => dirname( __FILE__ ),
	'remoteExtPath' => 'SemanticImageAnnotator',
	'messages'		=> array(
						'sia-buttonannotate',
						'sia-resize',
	),
);

$wgResourceModules['ext.SemanticImageAnnotator.ResultFormat'] = array(
	'scripts' => array( 'scripts/SIA_ResultScript.js' ),
	'styles' => array( 'styles/SIA.css'),
	'dependencies' => array('jquery.ui.draggable', 'jquery.ui.resizable'),
	'localBasePath' => dirname( __FILE__ ),
	'remoteExtPath' => 'SemanticImageAnnotator'
);

$wgResourceModules['ext.SemanticImageAnnotator.SemanticFormsAssets'] = array(
	'scripts' => 'external/SF_popupform.js',
	'styles'  => array( 'external/skins/SF_popupform.css' ),
	'localBasePath' => dirname( __FILE__ ),
	'remoteExtPath' => 'SemanticImageAnnotator'
);


global $wgAjaxExportList;
// register ajax functions
$wgAjaxExportList[] = 'getAnnotations';
$wgAjaxExportList[] = 'writeAnnotationProperties';
$wgAjaxExportList[] = 'removeAnnotation';

// register MediaWiki hooks
$wgHooks['OutputPageBeforeHTML'][] = 'hookOutputPageBeforeHTML';
$wgHooks['smwInitProperties'][] = 'initProperties';

function hookOutputPageBeforeHTML ( OutputPage &$out, &$text ) {

	if( $out->getTitle()->getNamespace() == 6 ) {		//6 is the File Namespace
		$out->includeJQuery();
		$out->addModules('ext.SemanticImageAnnotator');
	}

	return true;
}

function initProperties(){
	if ( class_exists( 'SMWDIProperty' ) ) {
		SMWDIProperty::registerProperty( "__SIA_RECTCOORDS", '_str', "SIArectangleCoordinates", true );
		SMWDIProperty::registerProperty( "__SIA_IMG_URL", '_str', "SIAimageURL", true );
		SMWDIProperty::registerProperty( "__SIA_ANNOTATED", '_str', "SIAannotatedImage", true );
					SMWDIProperty::registerProperty( "__SIA_CREATED_BY", '_str', "SIAcreatedBy", true );
	} else {
		SMWPropertyValue::registerProperty( "__SIA_RECTCOORDS", '_str', "SIArectangleCoordinates", true );
		SMWPropertyValue::registerProperty( "__SIA_IMG_URL", '_str', "SIAimageURL", true );
		SMWPropertyValue::registerProperty( "__SIA_ANNOTATED", '_str', "SIAannotatedImage", true );
					SMWPropertyValue::registerProperty( "__SIA_CREATED_BY", '_str', "SIAcreatedBy", true );
	}
	return true;
}
