<?php
	/**
	* Part of SemanticImageAnnotator
	* Provides Functions that are called from Javascript.
	* The functions are called from the editing view as well as from query results with format=imageannotation
	* @author Felix Obenauer
	*/
function removeAnnotation($annotationID){
	$article = new Article(Title::newFromText($annotationID));
	$article->doDelete('ImageAnnotation removed');
	return($annotationID);
}
	
function writeAnnotationProperties($newPageName, $annotatedImage, $imageURL, $coords,$createdBy){
	$newTitle = Title::newFromText($newPageName);
	$newArticle = new Article($newTitle);
	$content = '';
	$content .= '{{ImageAnnotation}}';
	$content .= '[[SIAannotatedImage::'.$annotatedImage.'| ]]'."\n";
	$content .= '[[SIAimageURL::'.$imageURL.'| ]]'."\n";
	$content .= '[[SIArectangleCoordinates::'.$coords.'| ]]'."\n";
	$content .= '[[SIAcreatedBy::'.$createdBy.'| ]]'."\n";
	$content .= '[[Category:ImageAnnotation]]'."\n";
	$newArticle->doEdit($content, 'Created by Semantic Image Annotator');
	return ('success');
}

//Returns a JSON object containing all shapes for the specified article.
function getAnnotations($annotatedImage){
	global $wgExtensionCredits;
        $new = false;
        foreach($wgExtensionCredits['semantic'] as $elem){
            if($elem['name'] == 'Semantic MediaWiki'){
                $vers = $elem['version'];
                $new = version_compare($vers, '1.7', '>=');
            }
        }
        
        $returnString = '{"shapes":[';
        $queryString = '[[SIAannotatedImage::'.$annotatedImage.']]';
        $params = array();
        $params['link'] = 'none';
        $params['mainlabel'] = 'result';
        #$params = ['order'];
        #$params = ['sort'];
        
	if($new){
            $params['order'] = array('asc');
            $params['sort'] = array('SIAannotatedImage');
        }
        else{
            $params['order'] = 'asc';
            $params['sort'] = 'SIAannotatedImage';
        }
        
	//Generate all the extra printouts, eg all properties to retrieve:
	$printmode = SMWPrintRequest::PRINT_PROP;
	$customPrintouts = array(	'coordinates' 	=> 'SIArectangleCoordinates',
								'text'			=> 'ImageAnnotationText'
							);
	$extraprintouts = array();
	foreach($customPrintouts as $label => $property){
		$extraprintouts[] = new SMWPrintRequest($printmode, $label, SMWPropertyValue::makeUserProperty($property));
	}

	$format = 'table';
	$context = SMWQueryProcessor::INLINE_QUERY;

	$query  = SMWQueryProcessor::createQuery( $queryString, $params, $context, $format, $extraprintouts );
	$store = smwfGetStore(); // default store
	$res = $store->getQueryResult( $query );
	
	$shapeCounter = 0;
	while( ($resArrayArray = $res->getNext()) != false){	//Array of SMWResultArray Objects, eg. all retrieved Pages
		$shapeCounter++;

		if($shapeCounter > 1) $returnString.=',';
		$returnString.='{';
		foreach($resArrayArray as $resArray){				//SMWResultArray-Object, column of resulttable (pagename or propertyvalue)			
			$currentPrintRequestLabel = $resArray->getPrintRequest()->getLabel();	//The label as defined in the above array
			if($currentPrintRequestLabel == 'coordinates'){
				$currentResultPage = $resArray->getResultSubject();				
				$currentID = $currentResultPage->getTitle()->getFullText();
				$currentCoords = $resArray->getNextDataItem()->getSerialization();
				$returnString.='"coords":"'.$currentCoords.'","id":"'.$currentID.'"';
			}
		}
		$returnString.='}';
	}
	$returnString .= ']}';
	return($returnString);
}
