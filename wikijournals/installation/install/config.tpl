<?php

#error_reporting(-1);
#ini_set('display_errors',1);

if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

$wgSitename      = "Wikijournals";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs please see:
## http://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath       = "/wikijournals";
$wgScriptExtension  = ".php";

## The relative URL path to the skins directory
$wgStylePath        = "$wgScriptPath/skins";

## The relative URL path to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogo             = "$wgStylePath/common/images/wiki.png";

## UPO means: this is also a user preference option

$wgEnableEmail      = true;
$wgEnableUserEmail  = true; # UPO

#$wgEmergencyContact = "";
#$wgPasswordSender   = "";

$wgEnotifUserTalk      = false; # UPO
$wgEnotifWatchlist     = false; # UPO
$wgEmailAuthentication = true;
$wgEmailConfirmToEdit = false;

## Database settings

$wgDBtype           = "mysql";
$wgDBserver         = "<DB_HOST>";
$wgDBname           = "<DB_NAME>";
$wgDBuser           = "<DB_USER>";
$wgDBpassword       = "<DB_PASSWORD>";

# MySQL specific settings
$wgDBprefix         = "<DB_PREFIX>";

# MySQL table options to use during installation or update
$wgDBTableOptions   = "ENGINE=InnoDB, DEFAULT CHARSET=binary";
    
# Experimental charset support for MySQL 4.1/5.0.
$wgDBmysql5 = false;

## Shared memory settings
$wgMainCacheType    = CACHE_NONE;
$wgMemCachedServers = array();

$wgCacheEpoch = max( $wgCacheEpoch, gmdate( 'YmdHis', @filemtime( __FILE__ ) ) );

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads  = true;
#$wgUseImageMagick = true;
#$wgImageMagickConvertCommand = "/usr/bin/convert";

# InstantCommons allows wiki to use images from http://commons.wikimedia.org
$wgUseInstantCommons  = true;

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "en_US.utf8";

## If you want to use image uploads under safe mode,
## create the directories images/archive, images/thumb and
## images/temp, and make them all writable. Then uncomment
## this, if it's not already uncommented:
#$wgHashedUploadDirectory = false;

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publically accessible from the web.
#$wgCacheDirectory = "$IP/cache";

# Site language code, should be one of the list in ./languages/Names.php
$wgLanguageCode = "de";

$wgSecretKey = "93a002bdaaf687f36f56bee8e13c023d15f99dafa911b705c4d6603d7a711ac5";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = "96b7050f9ec01185";

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'standard', 'nostalgia', 'cologneblue', 'monobook', 'vector':
$wgDefaultSkin = "cavendishmw";

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl  = "http://creativecommons.org/licenses/by/3.0/";
$wgRightsText = "Creative Commons �Namensnennung�";
$wgRightsIcon = "{$wgStylePath}/common/images/cc-by.png";
# $wgRightsCode = ""; # Not yet used

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

# Query string length limit for ResourceLoader. You should only set this if
# your web server has a query string length limit (then set it to that limit),
# or if you have suhosin.get.max_value_length set in php.ini (then set it to
# that value)
$wgResourceLoaderMaxQueryLength = -1;

# The following permissions were set based on your choice in the installer
$wgGroupPermissions['*']['edit'] = false;
$wgGroupPermissions['sysop']['interwiki'] = true;
$wgGroupPermissions['*']['createaccount']=false;
$wgGroupPermissions['user']['collectionsaveasuserpage'] = true;
$wgGroupPermissions['user']['collectionsaveascommunitypage'] = true;

# Enabled Extensions. Most extensions are enabled by including the base extension file here
# but check specific extension documentation for more details
# The following extensions were automatically enabled:
require_once( "$IP/extensions/ParserFunctions/ParserFunctions.php" );
require_once( "$IP/extensions/Renameuser/Renameuser.php" );
require_once( "$IP/extensions/Vector/Vector.php" );
require_once( "$IP/extensions/WikiEditor/WikiEditor.php" );
require_once( "$IP/extensions/ConfirmEdit/ConfirmEdit.php" );
$wgCaptchaClass='SimpleCaptcha';
require_once( "$IP/extensions/Nuke/Nuke.php" );
#require_once( "$IP/extensions/Gadgets/Gadgets.php" );
require_once("$IP/extensions/ConfirmAccount/ConfirmAccount.php");

# End of automatically generated settings.
# Add more configuration options below.

require_once( "$IP/extensions/semantic-bundle/SemanticBundleSettings.php" );
# require_once( "$IP/extensions/uuid/uuid.php" );
require_once("$IP/extensions/Interwiki/Interwiki.php");
$smwgQMaxSize=25;
$smwqQMaxDepth=15;

require_once( "$IP/extensions/SMWAskAPI/SMWAskAPI.php" );
require_once( "$IP/extensions/Variables/Variables.php" );

require_once("$IP/extensions/SocialProfile/SocialProfile.php");
$wgUserProfileDisplay['friends'] = true;
$wgUserProfileDisplay['foes'] = true;
$wgUserBoard = true;
$wgUserProfileDisplay['board'] = true;

#### start deactivate translate
#require_once( "$IP/extensions/Translate/Translate.php" );

#$wgGroupPermissions['translator']['translate'] = true;
# You can replace qqq with something more meaningful like info
#$wgTranslateDocumentationLanguageCode = 'qqq';

# Add these too if you want to enable page translation
#$wgGroupPermissions['sysop']['pagetranslation'] = true;
#$wgEnablePageTranslation = true;

#$wgTranslateCC['wiki-sidebar'] = 'addSidebarMessageGroup';
#function addSidebarMessageGroup( $id ) {
#$mg = new WikiMessageGroup( $id, 'sidebar-messages' );
#$mg->setLabel( 'Sidebar' );
#$mg->setDescription( 'Messages used in the sidebar of this wiki' );
#return $mg;
#}

#$wgTranslateCC['wiki-mainpage'] = 'addMainpageMessageGroup';
#function addMainpageMessageGroup( $id ) {
#$mg = new WikiMessageGroup( $id, 'mainpage-messages' );
#$mg->setLabel( 'Mainpage' );
#$mg->setDescription( 'Messages used in the mainpage of this wiki' );
#return $mg;
#}

#$wgTranslateCC['wiki-wjforms'] = 'addWjformsMessageGroup';
#function addWjformsMessageGroup( $id ) {
#$mg = new WikiMessageGroup( $id, 'wjforms-messages' );
#$mg->setLabel( 'Wjforms' );
#$mg->setDescription( 'Messages used in the forms of this wiki' );
#return $mg;
#}

require_once("$IP/skins/cavendishmw/cavendishmw.php");
require_once "$IP/extensions/MyVariables/MyVariables.php";
?>