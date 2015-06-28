<?php
	/**
	* Part of SemanticImageAnnotator
	* Provides a custom ResultPrinter for displaying images with annotations that result from queries.
	* @author Felix Obenauer
	*/

class SIA_AnnotationPrinter extends SMWResultPrinter {
	protected $paramWidth;
	
	public function __construct( $format, $inline, $useValidator = false ) {
		parent::__construct( $format, $inline );
		$this->mFormat = $format;
		$this->useValidator = $useValidator;
	}
	
	protected function getResultText( SMWQueryResult $res, $outputmode ){
            if(!( isset($this->paramWidth) )){
                    $this->paramWidth = -1;
            }
            $this->isHTML = true;
            global $wgOut;
            $wgOut->addModules('ext.SemanticImageAnnotator.ResultFormat');
            $resultPages = $res->getResults();

            $store = smwfGetStore();
            $annotationArray = array();

            foreach($resultPages as $page){
                $namespace = $page->getNamespace();
                if($namespace != 380) continue;
                $coords = "";
                $imgUrl = "";
                $pageName = $page->getDBkey();
                $propertyCoords = new SMWDIProperty("__SIA_RECTCOORDS");
                $propertyImgUrl = new SMWDIProperty("__SIA_IMG_URL");
                $coordValues = $store->getPropertyValues( $page, $propertyCoords );
                $urlValues = $store->getPropertyValues( $page, $propertyImgUrl );
                if(count($coordValues) == 1 && $coordValues[0] instanceof SMWDIString){
                    $coords = $coordValues[0]->getString();
                }
                if(count($urlValues) == 1 && $coordValues[0] instanceof SMWDIString){
                    $imgUrl = $urlValues[0]->getString();
                }

                if($coords != "" && $imgUrl != ""){
                        $annotationArray[$imgUrl][] = array($pageName, $coords);
                }
            }

            $returnString = "";
            foreach($annotationArray as $image => $annotationData){
                    $returnString .= $this->createAnnotatedImg($image, $annotationData);
            }
            return $returnString;
	}
	
	protected function createAnnotatedImg( $imgUrl, array $annotationData){
		$result = "";
                global $IP;
                $doc = $IP."\..".$imgUrl;
		$imageDim = getimagesize($doc);
		$origWidth = $imageDim[0];
		$origHeight = $imageDim[1];
		$scaleFactor = 1;
		$newWidth = $origWidth;
		$newHeight = $origHeight;
		
		if($this->paramWidth != -1 && $this->paramWidth != $origWidth){
			$scaleFactor = $this->paramWidth / $origWidth;
			$newWidth *= $scaleFactor;
			$newHeight *= $scaleFactor;
		}
		$result .= "<div style=\"position:relative;  \"><img src=\"".$imgUrl."\" width=\"".$newWidth."\" height=\"".$newHeight."\" >";
		foreach($annotationData as $data){
			$imageAnnotation = $data[0];
			$coordinate = $data[1];
			$coords = explode(";", $coordinate);
			
			if($scaleFactor != 1){
				foreach($coords as $k => $v){
					$coords[$k] = round($coords[$k] * $scaleFactor); 
				}
			}
			
			$width  = $coords[2] - $coords[0];
			$height = $coords[3] - $coords[1];
                        global $wgExtensionAssetsPath;
			$style = "top: ".$coords[1]."px; left: ".$coords[0]."px; width: ".$width."px; height: ".$height."px;";
                        $style .= "position:absolute; cursor:pointer; background: url(".$wgExtensionAssetsPath."/SemanticImageAnnotator/images/transparentbg.gif);";
			$annoDiv = "<div targetannotation=\"ImageAnnotation:".$imageAnnotation."\" class=\"ImageAnnotationDiv\" style=\"".$style."\"></div>";
			$result .= $annoDiv;
		}
		$result .= "</img></div>";
		return $result;
	}
	
	protected function handleParameters( array $params, $outputmode ) {
		//Existence of these array keys is not checked in SMW_QueryPrinter.php
		//If they are not specified, they should default to the values given
		//They are, however, not of interest to this specific QueryPrinter	
		
		if ( !(array_key_exists( 'headers', $params ) ) ) {
			$params['headers'] = 'hide';
		}
		
		if ( !(array_key_exists( 'link', $params ) ) ) {
			$params['link'] = 'none';
		}
		
		parent::handleParameters( $params, $outputmode );
		$this->paramWidth = $params['width'];
	}
	
	protected function readParameters( $params, $outputmode ) {
		parent::readParameters( $params, $outputmode );
		if ( array_key_exists( 'width', $params ) ) {
			$this->paramWidth = $params['width'];
		}
	}
	//FIXME: Umstellen auf getPAramDefs
	public function getParameters() {
		$params['width'] = new Parameter( 'width', Parameter::TYPE_INTEGER );
		$params['width']->setMessage( 'Width of image' );
		$params['width']->setDefault( -1 );
		return $params;
	}
}

