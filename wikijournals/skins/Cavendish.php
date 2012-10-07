<?php
/**
 * Mozilla cavendish theme
 * Modified by DaSch for MW 1.19 and WeCoWi
 *
 * Loosely based on the cavendish style by Gabriel Wicke
 *
 * @todo document
 * @package MediaWiki
 * @subpackage Skins
 */


if( !defined( 'MEDIAWIKI' ) )
	die();

/** */
require_once('includes/SkinTemplate.php');

/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @todo document
 * @package MediaWiki
 * @subpackage Skins
 */

$verint = 0;
$header15 = "";

 
/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @todo document
 * @ingroup Skins
 */
class SkinCavendish extends SkinTemplate {
    /** Using cavendish. */
    	
    function initPage( &$out ) {
    	global $wgVersion,$verint;
		SkinTemplate::initPage( $out );
      	$this->skinname = 'cavendish'; 
      	$this->stylename = 'cavendish';
        $this->template = 'CavendishTemplate'; 
        $this->useHeadElement = true;
        $mwver = explode(".",$wgVersion);
		$verint = intval(substr($mwver[1],0,2)); 
		}
    function setupSkinUserCss( OutputPage $out ) {
        global $wgHandheldStyle, $wgStyleVersion, $wgJsMimeType, $wgStylePath, $wgVersion;
		global $cavendishLogoURL, $cavendishLogoWidth, $cavendishLogoHeight, $cavendishLogoMargin, $cavendishSiteWith, $cavendishExtensionCSS, $cavendishSidebarSearchbox;
		global $header15, $verint;
		if ( $verint > 15 ) {
        parent::setupSkinUserCss( $out );
		}
        // Append to the default screen common & print styles...
		$out->addStyle( 'cavendish/print.css', 'print' );
		$out->addStyle( 'cavendish/cavendish.css', 'screen' );
        if( $wgHandheldStyle ) {
            // Currently in testing... try 'chick/main.css'
            $out->addStyle( $wgHandheldStyle, 'handheld' );
        }

        $out->addStyle( 'cavendish/IE50Fixes.css', 'screen', 'lt IE 5.5000' );
        $out->addStyle( 'cavendish/IE55Fixes.css', 'screen', 'IE 5.5000' );
        $out->addStyle( 'cavendish/IE60Fixes.css', 'screen', 'IE 6' );
        $out->addStyle( 'cavendish/IE70Fixes.css', 'screen', 'IE 7' );
		
        $out->addStyle( 'cavendish/rtl.css', 'screen', '', 'rtl' );
		
        /* README for details */
		if(!isset($cavendishLogoURL)) {
			$cavendishLogoURL=$wgStylePath . "/cavendish/wiki_header_logo.gif";
		}
       	if(!isset($cavendishLogoWidth)) {
			$cavendishLogoWidth="322";
		}
		if(!isset($cavendishLogoHeight)) {
			$cavendishLogoHeight="53";
		}
		$cavendishLogoMarginToAdd="";
		if(isset($cavendishLogoMargin)) {
			$cavendishLogoMarginToAdd .= 'margin-top:'.$cavendishLogoMargin.'px;';
		}
		if(!isset($cavendishSidebarSearchbox)) {
			$cavendishSidebarSearchbox=false;
		}
		$cavendishSidebarSearchboxToAdd = "";
		if(!$cavendishSidebarSearchbox) {
			$cavendishSidebarSearchboxToAdd .= '#nav #p-search {display:none;}';
		} 
		$cavendishglobalWrapper="";
		if (isset($cavendishSiteWith)) {
			$cavendishglobalWrapper = '#globalWrapper {width:'. $cavendishSiteWith .'px;}';
		}
		if (!isset($cavendishExtensionCSS)) {
			$cavendishExtensionCSS = true;		
		}
		if ($cavendishExtensionCSS) {
			$out->addStyle( 'cavendish/extensions.css', 'screen' );	
		}
		$headStyle = '#header h6 a { background: transparent url("'.$cavendishLogoURL.'") no-repeat; width:'.$cavendishLogoWidth.'px;height:'.$cavendishLogoHeight.'px;'.$cavendishLogoMarginToAdd.'}'.$cavendishglobalWrapper.$cavendishSidebarSearchboxToAdd;
		if ( $verint > 15 ) {
        	$out->addInlineStyle($headStyle);
		}
		else {
			$header15 .='<style type="text/css">' . $headStyle . '</style>';
		}
    }
}
	
class CavendishTemplate extends MonoBookTemplate {
	var $skin;
	/**
	 * Template filter callback for cavendish skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 *
	 * @access private
	 */
	function execute() {
		global $wgRequest, $verint, $header15, $cavendishGGplusone;
		$styleversion = '1.3.6';
		$this->skin = $skin = $this->data['skin'];
		$action = $wgRequest->getText( 'action' );
		if ( $action == "") {
			$action = "view";
		}
		// Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();
		if ( $verint > 15 ) {
			$this->html( 'headelement' );
		}
		else {
				?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php $this->text('lang') ?>" lang="<?php $this->text('lang') ?>" dir="<?php $this->text('dir') ?>">
	<head>
		<meta http-equiv="Content-Type" content="<?php $this->text('mimetype') ?>; charset=<?php $this->text('charset') ?>" />
		<?php $this->html('headlinks') ?>
		<title><?php $this->text('pagetitle') ?></title>
		<?php $this->html('csslinks') ?>
		
		<?php print Skin::makeGlobalVariablesScript( $this->data ); ?>

		<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath' ) ?>/common/wikibits.js?<?php echo $GLOBALS['wgStyleVersion'] ?>"><!-- wikibits js --></script>
		<!-- Head Scripts -->
		<?php $this->html('headscripts') ?>
		<!-- site js -->
		<?php	if($this->data['jsvarurl']) { ?>
		<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('jsvarurl') ?>"><!-- site js --></script>
		<?php	} ?>
		<!-- should appear here -->
		<?php	if($this->data['pagecss']) { ?>
				<style type="text/css"><?php $this->html('pagecss') ?></style>
		<?php	}
				if($this->data['usercss']) { ?>
				<style type="text/css"><?php $this->html('usercss') ?></style>
		<?php	}
				if($this->data['userjs']) { ?>
				<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('userjs' ) ?>"></script>
		<?php	}
				if($this->data['userjsprev']) { ?>
				<script type="<?php $this->text('jsmimetype') ?>"><?php $this->html('userjsprev') ?></script>
		<?php	}
				if($this->data['trackbackhtml']) print $this->data['trackbackhtml']; ?>
		<link rel="stylesheet" type="text/css" media="print" href="<?php $this->text('stylepath') ?>/common/commonPrint.css" />
		<script type="text/javascript" src="<?php $this->text('stylepath' ) ?>/common/wikibits.js"></script>
<?php	echo $header15; ?>
	</head>
	<body <?php if($this->data['body_ondblclick']) { ?> ondblclick="<?php $this->text('body_ondblclick') ?>"<?php } ?>
<?php if($this->data['body_onload']) { ?> onload="<?php $this->text('body_onload') ?>"<?php } ?>
 class="mediawiki <?php $this->text('dir') ?> <?php $this->text('pageclass') ?> <?php $this->text('skinnameclass') ?>">
		<?php }
?>
<div id="internal"></div>
<!-- Skin-Version: <?php echo $styleversion ?> on MW: <?php echo $verint ?>-->
<div id="globalWrapper" class="<?php echo $action ?>">

	<div id="p-personal" class="portlet">
		<h5><?php $this->msg('personaltools') ?></h5>
		<div class="pBody">
			<ul <?php $this->html('userlangattributes') ?>>
			<?php foreach($this->data['personal_urls'] as $key => $item) {?>
			
			<li id="<?php echo Sanitizer::escapeId( "pt-$key" ) ?>" class="<?php
					if ($item['active']) { ?>active <?php } ?>top-nav-element">
				<span class="top-nav-left">&nbsp;</span>
				<a class="top-nav-mid <?php echo htmlspecialchars($item['class']) ?>" 
				   href="<?php echo htmlspecialchars($item['href']) ?>">
				   <?php echo htmlspecialchars($item['text']) ?></a>	
				<span class="top-nav-right">&nbsp;</span></li>
				<?php
				} ?>
			
			</ul>
		</div>
	</div>

	<div id="header">
		<a name="top" id="contentTop"></a>
		<h6>
		<a
	    href="<?php echo htmlspecialchars($this->data['nav_urls']['mainpage']['href'])?>"
	    title="<?php $this->msg('mainpage') ?>"><?php $this->text('pagetitle') ?></a></h6>
		<div id="p-cactions" class="portlet"><ul>
    <?php        foreach($this->data['content_actions'] as $key => $tab) {
                    echo '
                 <li id="' . Sanitizer::escapeId( "ca-$key" ) . '"';
                    if( $tab['class'] ) {
                        echo ' class="'.htmlspecialchars($tab['class']).'"';
                    }
                    echo '><a href="'.htmlspecialchars($tab['href']).'"';
                    # We don't want to give the watch tab an accesskey if the
                    # page is being edited, because that conflicts with the
                    # accesskey on the watch checkbox.  We also don't want to
                    # give the edit tab an accesskey, because that's fairly su-
                    # perfluous and conflicts with an accesskey (Ctrl-E) often
                    # used for editing in Safari.
                     if( in_array( $action, array( 'edit', 'submit' ) ) && in_array( $key, array( 'edit', 'watch', 'unwatch' ) ) ) {
                         echo $skin->tooltip( "ca-$key" );
                     } 
                     else {
                         echo $skin->tooltip( "ca-$key" );
                     }
                     echo '>'.htmlspecialchars($tab['text']).'</a></li>';
                }
				if ($cavendishGGplusone) {				
				?>
				<li id="ca-pluspone">
					<div id="plusone-wrapper">
						<div class="g-plusone" data-size="small"></div>
					</div>
				</li>
				<?php } ?>
            </ul></div>
			<?php $this->searchBox(); ?>
	</div>

	<div id="mBody">
	
		<div id="side">
			<div id="nav">
<?php
		$sidebar = $this->data['sidebar'];
		if ( !isset( $sidebar['SEARCH'] ) ) $sidebar['SEARCH'] = true;
		if ( !isset( $sidebar['TOOLBOX'] ) ) $sidebar['TOOLBOX'] = true;
		if ( !isset( $sidebar['LANGUAGES'] ) ) $sidebar['LANGUAGES'] = true;
		foreach ($sidebar as $boxName => $cont) {
			if ( $boxName == 'SEARCH' ) {
				$this->searchBox();	
			} elseif ( $boxName == 'TOOLBOX' ) {
				$this->toolbox();
			} elseif ( $boxName == 'LANGUAGES' ) {
				$this->languageBox();
			} else {
				$this->customBox( $boxName, $cont );
			}
		}
?></div>
		</div><!-- end of SIDE div -->
		<div id="column-content">
			<div id="content">
				<a id="top"></a>
	        	<?php if($this->data['sitenotice']) { ?><div id="siteNotice"><?php $this->html('sitenotice') ?></div><?php } ?>
	        	<h1 id="firstHeading" class="firstHeading"><?php $this->html('title') ?></h1>
				<div id="bodyContent">
		            <h3 id="siteSub"><?php $this->msg('tagline') ?></h3>
		            <div id="contentSub"><?php $this->html('subtitle') ?></div>
		            <?php if($this->data['undelete']) { ?><div id="contentSub2"><?php $this->html('undelete') ?></div><?php } ?>
		            <?php if($this->data['newtalk'] ) { ?><div class="usermessage"><?php $this->html('newtalk')  ?></div><?php } ?>
		            <?php if($this->data['showjumplinks']) { ?><div id="jump-to-nav"><?php $this->msg('jumpto') ?> <a href="#column-one"><?php $this->msg('jumptonavigation') ?></a>, <a href="#searchInput"><?php $this->msg('jumptosearch') ?></a></div><?php } ?>
					<!-- start content -->
					<?php $this->html('bodytext') ?>
					<?php if($this->data['catlinks']) { $this->html('catlinks'); } ?>
					<!-- end content -->
					<?php if($this->data['dataAfterContent']) { $this->html ('dataAfterContent'); } ?>
				</div>
			</div><!-- end of MAINCONTENT div -->	
		</div>
	
	</div><!-- end of MBODY div -->
	<div class="visualClear"></div>
	<div id="footer">
		<table>
			<tr>
				<td rowspan="2" class="f-iconsection">
		<?php if($this->data['copyrightico']) { ?><div id="f-copyrightico"><?php $this->html('copyrightico') ?></div><?php } ?>
				</td>
				<td align="center">
<?php	// Generate additional footer links
		$footerlinks = array(
			'lastmod', 'viewcount', 'numberofwatchingusers', 'credits', 'copyright',
			'privacy', 'about', 'disclaimer', 'tagline',
		);
		$validFooterLinks = array();
		foreach( $footerlinks as $aLink ) {
			if( isset( $this->data[$aLink] ) && $this->data[$aLink] ) {
				$validFooterLinks[] = $aLink;
			}
		}
		if ( count( $validFooterLinks ) > 0 ) {
?>			<ul id="f-list">
<?php
			foreach( $validFooterLinks as $aLink ) {
				if( isset( $this->data[$aLink] ) && $this->data[$aLink] ) {
?>					<li id="f-<?php echo$aLink?>"><?php $this->html($aLink) ?></li>
<?php 			}
			}
		}		
?></ul></td>
				<td rowspan="2" class="f-iconsection">
					<?php
					if ($verint > 17) {
						if ($verint > 17) {
							$validFooterIcons = $this->getFooterIcons( "nocopyright" );
						}
						else {
							$validFooterIcons = $this->data["footericons"]["poweredby"];
						}
							foreach ( $validFooterIcons as $blockName => $footerIcons ) { ?>
								<div id="f-<?php echo htmlspecialchars($blockName); ?>ico">
							<?php foreach ( $footerIcons as $icon ) {
								  echo $this->skin->makeFooterIcon( $icon );
								}

						
						}
					}
					else {
						if($this->data['poweredbyico']) { ?>
							<div id="f-poweredbyico"><?php $this->html('poweredbyico') ?></div>
						<?php }
					}
					?></div>
				</td>
			</tr>
			<tr>
				<td><div id="skin-info">
					Mozilla Cavendish Theme based on Cavendish style by Gabriel Wicke modified by <a href="http://www.dasch-tour.de" target="_blank">DaSch</a> for the <a href="http://www.wecowi.de/">Web Community Wiki</a><br/>
					<a href="http://sourceforge.net/projects/wecowi/">Sourceforge Projectpage</a> &ndash; <a href="http://sourceforge.net/apps/trac/wecowi/newticket">Report Bug</a> &ndash; Skin-Version: <?php echo $styleversion ?>
				</div></td>
			</tr>
		</table>
	</div><!-- end of the FOOTER div -->
</div><!-- end of the CONTAINER div -->
<!-- scripts and debugging information -->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
	{lang: 'de'}
</script>
<?php
	if ($verint > 17) {
		$this->printTrail();
		echo Html::closeElement( 'body' );
		echo Html::closeElement( 'html' );
	}
	else {
		$this->html('bottomscripts');
		$this->html('reporttime');
		if ( $this->data['debug'] ) {
			$this->text( 'debug' );
		}
		?>
		</body></html>
		<?php
	}
	
	wfRestoreWarnings();

	}
} // end of class