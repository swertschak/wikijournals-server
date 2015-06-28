/*global $, wgScript, wgExtensionAssetsPath, siaLocalizedSpecialPageName, siaFormName, ext, removeAnnotation*/
/*
 *SIA_getAnnotations.js 
 *
 *This script retrieves the annotations for an image and displays it depending on context
 *
 *@author Felix Obenauer
 */
//Utility function to produce a random alphanumerical string of specified length
function randomString(string_length) {
    "use strict";
    var chars, randomstring, rnum, i;
    chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    randomstring = '';
    for (i = 0; i < string_length; i += 1) {
        rnum = Math.floor(Math.random() * chars.length);
        randomstring += chars.substring(rnum, rnum + 1);
    }
    return (randomstring);
}

//Get a new unique id for the page, for which no element exists already
function getUniqueRandomID(length) {
    "use strict";
    var uniqueID;
    while (true) {
        uniqueID = randomString(length);
        if ($('#' + uniqueID).length === 0) {
            break;
        }
    }
    return uniqueID;
}
/**
 *Retrieves all annotations for 'imageName'
 *Appends the annotations to the appendToSelector
 *In FileNS, delete buttons are added, otherwise stored information is added
 *@param imageName: Name of the image for which annotations are to be retrieved
 *@param appendToSelector: String with an id of the div that shapes should be appended to (e.g. '#Canvas')
 *@param isInFileNS: if true, add delete divs, if false, assume that annotations are displayed as part of a query result
 *@param scaleFactorW: Factor by which the annotations should be scaled.
 */

//functions:
var createEditClickEvent, createDeleteClickEvent;

function getAnnotations(imageName, appendToSelector, isInFileNS, scaleFactorW) {
    "use strict";
    if (scaleFactorW === null || scaleFactorW === undefined) {
        scaleFactorW = 1;
    }
    //Execute Ajax function getAnnotations (see SIA_AjaxFunctions.php)
    //Returns a JSON String with the annotation coordinates
    $.ajax({
        type: "GET",
        url: 'index.php',
        datatype: 'html',
        async: false,
        data: {
            'action': 'ajax',
            'rs': 'getAnnotations',
            'rsargs': {
                article: imageName
            }
        },
        success: function getFormCallback(request) {
            var shapesObject, coordsString, coords, currentID, currentShapeDiv,
                editDiv, editImg, deleteDiv, deleteImg, i;
            shapesObject = $.parseJSON(request);

            for (i = 0; i < shapesObject.shapes.length; i += 1) {
                coordsString = shapesObject.shapes[i].coords;
                coords = coordsString.split(';');
                currentID = shapesObject.shapes[i].id;
                currentShapeDiv = $('<div class="ImageAnnotationDiv" targetannotation="' + currentID + '"></div>');

                //currentShapeDiv.css('background', 'url(' + wgExtensionAssetsPath + '/SemanticImageAnnotator/images/transparentbg.gif)');
                currentShapeDiv.css('top', parseInt(coords[1] * scaleFactorW, 10));
                currentShapeDiv.css('left', parseInt(coords[0] * scaleFactorW, 10));
                currentShapeDiv.css('width', parseInt((parseInt(coords[2], 10) - parseInt(coords[0], 10)) * scaleFactorW, 10));
                currentShapeDiv.css('height', parseInt((parseInt(coords[3], 10) - parseInt(coords[1], 10)) * scaleFactorW, 10));
                currentShapeDiv.css('position', 'absolute');
                $(appendToSelector).append(currentShapeDiv);

                if (isInFileNS) {
                    currentShapeDiv.attr('origtop', parseInt(coords[1], 10));
                    currentShapeDiv.attr('origleft', parseInt(coords[0], 10));
                    currentShapeDiv.attr('origwidth', parseInt(coords[2], 10) - parseInt(coords[0], 10));
                    currentShapeDiv.attr('origheight', parseInt(coords[3], 10) - parseInt(coords[1], 10));

                    editDiv = $('<div class="editDiv"></div>');
                    editImg = $('<img src="' + wgExtensionAssetsPath + '/SemanticImageAnnotator/images/edit.png">');
                    editImg.attr('title', 'Edit');
                    editImg.attr('alt', currentID);
                    editDiv.append(editImg);
                    currentShapeDiv.append(editDiv);
                    createEditClickEvent(editDiv);

                    deleteDiv = $('<div class="deleteDiv"></div>');
                    deleteImg = $('<img src="' + wgExtensionAssetsPath + '/SemanticImageAnnotator/images/delete.png">');
                    deleteImg.attr('title', 'Delete Annotation');
                    deleteImg.attr('alt', currentID);
                    deleteDiv.append(deleteImg);
                    currentShapeDiv.append(deleteDiv);
                    createDeleteClickEvent(deleteDiv);
                }
            }
        }
    });
}

function createDeleteClickEvent(deleteDiv) {
    "use strict";
    deleteDiv.click(function (event) {
        event.stopPropagation();
        removeAnnotation(event);
    });
}

function createEditClickEvent(editDiv) {
    "use strict";
    editDiv.click(function (event) {
        event.stopPropagation();
        var editFormsLink = wgScript + '/' + siaLocalizedSpecialPageName + ':FormEdit/' + siaFormName;
        editFormsLink = editFormsLink + '/' + $(event.target).attr('alt');
        ext.popupform.handlePopupFormLink(editFormsLink, this);
    });
}