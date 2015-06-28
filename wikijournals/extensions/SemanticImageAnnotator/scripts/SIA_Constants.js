/*global wgExtensionAssetsPath, mw*/
/**
 *SIA_Constants.js 
 *
 *Defines certain constants used by SIA scripts.
 *
 *@author Felix Obenauer
 */

var divResize =
    '<div id="SIAresizeDiv">' +
    '<img id="buttondecreaseimagesize" src="' + wgExtensionAssetsPath + '/SemanticImageAnnotator/images/minus.png">' +
    mw.msg('sia-resize') +
    '<img id="buttonincreaseimagesize" src="' + wgExtensionAssetsPath + '/SemanticImageAnnotator/images/plus.png">' +
    '</div>';


var divToolbox =
    '<form id="annotationForm">' +
    '<input type="button" value="' + mw.msg('sia-buttonannotate') + '" id="buttonAnnotate">' +
    '</form>';

var divShapeKeep =
    '<div id="divShapeKeep" style="position:absolute; visibility:hidden;background-color:white; padding:10px; border:1px solid black;z-index:200;">' +
    '<input type="button" value="Clear" id="buttonClear">' +
    '<input type="button" value="OK" id="buttonOK">' +
    '</div>';
