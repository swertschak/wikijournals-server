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

## The protocol and server name to use in fully-qualified URLs
$wgServer = "http://localhost";

## The relative URL path to the skins directory
$wgStylePath        = "$wgScriptPath/skins";

## The relative URL path to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogo             = "$wgStylePath/common/images/wikijournals.jpg";

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
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

# Experimental charset support for MySQL 5.0.
$wgDBmysql5 = true;

## Shared memory settings
$wgMainCacheType = CACHE_NONE;
$wgMemCachedServers = array();

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;
$wgUseImageMagick = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";

# InstantCommons allows wiki to use images from http://commons.wikimedia.org
$wgUseInstantCommons = true;

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

$wgSecretKey = "362f458b66af397a41a0d8a887906431938ba5e184cd728efed255a3d778a649";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = "1d6643332c5930f6";

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "";
$wgRightsText = "";
$wgRightsIcon = "";

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

# The following permissions were set based on your choice in the installer
$wgGroupPermissions['*']['edit'] = false;

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'vector', 'monobook':
$wgDefaultSkin = "foreground";

# Enabled skins.
# The following skins were automatically enabled:
require_once "$IP/skins/CologneBlue/CologneBlue.php";
require_once "$IP/skins/Modern/Modern.php";
require_once "$IP/skins/MonoBook/MonoBook.php";
require_once "$IP/skins/Vector/Vector.php";
require_once "$IP/skins/foreground/foreground.php";


# Enabled Extensions. Most extensions are enabled by including the base extension file here
# but check specific extension documentation for more details
# The following extensions were automatically enabled:
require_once "$IP/extensions/Cite/Cite.php";
require_once "$IP/extensions/ConfirmEdit/ConfirmEdit.php";
require_once "$IP/extensions/Gadgets/Gadgets.php";
require_once "$IP/extensions/ImageMap/ImageMap.php";
require_once "$IP/extensions/InputBox/InputBox.php";
require_once "$IP/extensions/Interwiki/Interwiki.php";
require_once "$IP/extensions/Nuke/Nuke.php";
require_once "$IP/extensions/ParserFunctions/ParserFunctions.php";
require_once "$IP/extensions/PdfHandler/PdfHandler.php";
require_once "$IP/extensions/Renameuser/Renameuser.php";
require_once "$IP/extensions/SpamBlacklist/SpamBlacklist.php";
require_once "$IP/extensions/SyntaxHighlight_GeSHi/SyntaxHighlight_GeSHi.php";
require_once "$IP/extensions/TitleBlacklist/TitleBlacklist.php";
require_once "$IP/extensions/WikiEditor/WikiEditor.php";


# End of automatically generated settings.
# Add more configuration options below.

require_once "$IP/extensions/AdminLinks/AdminLinks.php";
require_once "$IP/extensions/SemanticForms/SemanticForms.php";
include_once "$IP/extensions/DataTransfer/DataTransfer.php";
require_once "$IP/extensions/MyVariables/MyVariables.php";
include_once "$IP/extensions/ExternalData/ExternalData.php";
include_once( "$IP/extensions/PageSchemas/PageSchemas.php" );
require_once( "$IP/extensions/SemanticCompoundQueries/SemanticCompoundQueries.php" );
include_once("$IP/extensions/SemanticDrilldown/SemanticDrilldown.php");
require_once("$IP/extensions/SemanticFormsInputs/SemanticFormsInputs.php");
include_once("$IP/extensions/SemanticInternalObjects/SemanticInternalObjects.php");
require_once "$IP/extensions/HeaderTabs/HeaderTabs.php";
require_once "$IP/extensions/Widgets/Widgets.php";
require_once "$IP/extensions/Variables/Variables.php";
require_once("$IP/extensions/ReplaceText/ReplaceText.php" );
include_once("$IP/extensions/SemanticImageAnnotator/SemanticImageAnnotator.php");
require_once "$IP/extensions/SemanticRating/SemanticRating.php";
?>