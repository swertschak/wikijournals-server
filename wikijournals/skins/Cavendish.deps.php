<?php
// This file exists to ensure that base classes are preloaded before
// MonoBook.php is compiled, working around a bug in the APC opcode
// cache on PHP 5, where cached code can break if the include order
// changed on a subsequent page view.
// see http://mail.wikipedia.org/pipermail/wikitech-l/2006-January/033660.html

if ( ! defined( 'MEDIAWIKI' ) )
	die( 1 );
global $IP;
require_once( $IP .'/includes/SkinTemplate.php');
require_once( $IP . '/skins/MonoBook.php');