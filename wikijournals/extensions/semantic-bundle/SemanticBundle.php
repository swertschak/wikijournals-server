<?php
if ( !defined( 'MEDIAWIKI' ) ) {
    echo "This file is not a valid entry point.";
    exit( 1 );
}

$wgExtensionCredits['semantic'][] = array(
	'path' => __FILE__,
        'name' => 'Semantic Bundle',
        'description' => 'A pre-packaged bundle of extensions meant to be used on wikis based around the Semantic MediaWiki extension.',
	'version' => '20120327',
        'author' => array( '[http://www.mediawiki.org/wiki/User:Yaron_Koren Yaron Koren]', '[http://www.mediawiki.org/wiki/User:Jeroen_De_Dauw Jeroen De Dauw]' ),
        'url' => 'http://www.mediawiki.org/wiki/Semantic_Bundle'
);

