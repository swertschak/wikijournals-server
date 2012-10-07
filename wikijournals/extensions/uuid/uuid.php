<?php
/*
 * UUID.php - A simple MediaWiki extension for displaying a random UUID (v4)
 * See http://en.wikipedia.org/wiki/Universally_Unique_Identifier#Random_UUID_probability_of_duplicates
 * @author Ryan McKeel
 * @version 0.2
 * -----------------------------------------------------------------------
 * Requirements:
 *     MediaWiki 1.9.x or higher
 *     PHP 5.x or higher
 * Installation:
 *     1. Drop this script (uuid.php) in $IP/extensions/uuid
 *         Note: $IP is your MediaWiki install dir.
 *     2. Enable the extension by adding this line to your LocalSettings.php:
 *         require_once('extensions/uuid/uuid.php');
 *     3. Optionally but recommended, install PHP5-UUID to your environment.
 *         A 'graceful degradation' measure is in place in case PHP5-UUID
 *        (and subsequently uuid_make function) is not available.
 *        If on Ubuntu or Debian, do an apt-get install php5-uuid for a quick install.
 * Usage:
 *     Add {{UUID}} to your wikitext.
 * Version Notes:
 *     version 0.1:
 *         Initial release.
 * -----------------------------------------------------------------------
 */
 
# Confirm MW environment
if (defined('MEDIAWIKI')) {
 
class UUIDMagicWord {
    function __construct() {
        global $wgHooks;
        $wgHooks['LanguageGetMagic'][] = array( &$this, 'languageMagic' );
        $wgHooks['MagicWordwgVariableIDs'][] = array( &$this, 'variableIds' );
        $wgHooks['ParserGetVariableValueVarCache'][] = array( &$this, 'valueVarCache' 
);
    }
    function languageMagic( &$magicWords, $langCode=null ) {
        $magicWords['uuid'] = array( 1, 'UUID' );
        return true;
    }
    function valueVarCache( &$parser, &$varCache ) {
        // Don't cache UUIDs!  Otherwise, only one unique id per page
        if(@function_exists(uuid_make)) {
            // create random UUID, possibly support other methods later
            uuid_create(&$v4);
            uuid_make($v4, UUID_MAKE_V4);
            uuid_export($v4, UUID_FMT_STR, &$v4String);
        } else {
            // Alternate creation method from http://aaronsaray.com/blog/2009/01/14/php-and-the-uuid/comment-page-1/#comment-1522
            // May not be as fast or as accurate to specification as php5-uuid
            $v4String = sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
                mt_rand( 0, 0x0fff ) | 0x4000,
                mt_rand( 0, 0x3fff ) | 0x8000,
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ) );
        }
 
        $varCache['uuid'] = $v4String ? $v4String : 'NULL';
        return true;
    }
    function variableIds( &$variableIDs ) {
        $variableIDs[] = 'uuid';
        return true;
    }
}
new UUIDMagicWord();
 
}