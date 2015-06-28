/*global $, document, divResize, divToolbox,
 divShapeKeep, wgFormattedNamespaces, wgTitle, wgUserName, wgScript,
 ext, wgScriptPath, getAnnotations, randomString*/
/*
 *SIA_fileNS.js 
 *
 *Implements the 'Annotation View' on sites of the File Namespace
 *Enables the user to draw annotations on the image and stores them as semantic properties in the ImageAnnotation Namespace
 *
 *@author Felix Obenauer
 *
 */

//Functions
var increaseSize;
var decreaseSize;
var startShaping;
var stopShaping;
var shape;
var resizeAnnotations;

//Variables
var gOffsetLeft;
var gOffsetTop;
var gStartX;
var gStartY;
var siaImageAnnotationNS = 'ImageAnnotation';
var siaFormName = 'ImageAnnotation';
var siaIDTemplate = 'ImageAnnotationID';
var siaLocalizedSpecialPageName = wgFormattedNamespaces['-1'];
var fullsizeImageUrl;

$(document).ready(function () {
    "use strict";
    //Append buttons
    $("#file").prepend(divToolbox);
    $('body').append(divShapeKeep);
    //Start the annotation View
    $('#buttonAnnotate').click(function () {
        //$('#buttonAnnotate').remove();
        //Get url of the actual image, not the thumbnail:
        fullsizeImageUrl = $("#file > a").attr("href");
        //Remove the link and the thumbnail image:
        //$("#file > a").remove();
        //$("#file > small").text("Image in it's original size.");
        //Create the Canvas div and fill it with the actual-sized image
        var canvasedImg = '<div id="Canvas" style="cursor: crosshair;position:relative;">' + '<img id="imagetoannotate" src="' + fullsizeImageUrl + '" style="float:left;"> </div>';
        $("#file").empty();
        $('.fullMedia').remove();
        $("#file").prepend(canvasedImg);
        //Initialize attributes needed for scaling 
        $('#imagetoannotate').load(function () {
            var img = document.getElementById("imagetoannotate");
            $('#imagetoannotate').attr('currentscalefactor', '1');	//Current scale factor of image
            $('#imagetoannotate').attr({
                origwidth: img.clientWidth,
                width: img.clientWidth
            });
            $('#imagetoannotate').attr({
                origheight: img.clientHeight,
                height: img.clientHeight
            });
            //Add click listeners to the buttons
            $('#buttonincreaseimagesize').click(function () {
                increaseSize();
            });
            $('#buttondecreaseimagesize').click(function () {
                decreaseSize();
            });
        });
        //Add the resize buttons to the DOM
        $("#file").prepend(divResize);
        //Clearing div for float div
        $("#file > br").before('<div style="clear:both;"></div>');
        getAnnotations(wgTitle, '#Canvas', true);
        //Register startShaping method for the first click in the Canvas:
        $('#Canvas').click(function (e) {
            startShaping(e);
        });
    });
    //Function is called after each resize step and resizes the already present annotations
    resizeAnnotations = function () {
        var factor, current;
        factor = $('#imagetoannotate').attr('width') / $('#imagetoannotate').attr('origwidth');
        $('.ImageAnnotationDiv').each(function (i, iaDiv) {
            current = i;
            $(iaDiv).css('top', parseInt(parseInt(Math.round($(iaDiv).attr('origtop')) * factor, 10), 10));
            $(iaDiv).css('left', parseInt(parseInt(Math.round($(iaDiv).attr('origleft')) * factor, 10), 10));
            $(iaDiv).css('width', parseInt(parseInt(Math.round($(iaDiv).attr('origwidth')) * factor, 10), 10));
            $(iaDiv).css('height', parseInt(parseInt(Math.round($(iaDiv).attr('origheight')) * factor, 10), 10));
        });
    };
    //Increase/Decrease image size, save current scalefactor as an attribute
    decreaseSize = function () {
        var currentSF, newSF, newWidth, newHeight;
        $('#buttonincreaseimagesize').unbind();
        $('#buttondecreaseimagesize').unbind();
        currentSF = parseFloat($('#imagetoannotate').attr('currentscalefactor'));
        newSF = currentSF * 0.9;
        if (newSF > 0.001) {
            $('#imagetoannotate').attr('currentscalefactor', newSF);
            newWidth = parseInt(Math.round($('#imagetoannotate').attr('origwidth')  * newSF), 10);
            newHeight = parseInt(Math.round($('#imagetoannotate').attr('origheight')  * newSF), 10);
            $('#imagetoannotate').attr('width', newWidth);
            $('#imagetoannotate').attr('height', newHeight);
            resizeAnnotations();
        }
        $('#buttonincreaseimagesize').click(function () {
            increaseSize();
        });
        $('#buttondecreaseimagesize').click(function () {
            decreaseSize();
        });
    };

    increaseSize = function () {
        var currentSF, newSF, newWidth, newHeight;
        $('#buttonincreaseimagesize').unbind();
        $('#buttondecreaseimagesize').unbind();
        currentSF = parseFloat($('#imagetoannotate').attr('currentscalefactor'));
        newSF = currentSF * 1.1;
        $('#imagetoannotate').attr('currentscalefactor', newSF);
        newWidth = parseInt(Math.round($('#imagetoannotate').attr('origwidth')  * newSF), 10);
        newHeight = parseInt(Math.round($('#imagetoannotate').attr('origheight')  * newSF), 10);
        $('#imagetoannotate').attr('width', newWidth);
        $('#imagetoannotate').attr('height', newHeight);
        resizeAnnotations();
        $('#buttonincreaseimagesize').click(function () {
            increaseSize();
        });
        $('#buttondecreaseimagesize').click(function () {
            decreaseSize();
        });
    };
	//Start the shaping mode
    startShaping = function (e) {
        $('#Canvas').unbind();
        //When user clicks again, leave shaping mode
        $('#Canvas').click(function (e) {
            stopShaping(e);
        });
        var offset = $("#Canvas").offset();
        //Calculate the starting coordinates of the shape
        gOffsetLeft = parseInt(offset.left, 10);
        gOffsetTop = parseInt(offset.top, 10);
        gStartX = e.pageX - gOffsetLeft;
        gStartY = e.pageY - gOffsetTop;
        //Bind the shaping function to the mouse movement
        $('#Canvas').mousemove(function (e) {
            shape(e);
        });
    };

    //Draw the rectangle while in shaping mode
    shape = function (e) {
        var x, y, minX, widthrect, minY, heightrect;
        $("#Canvas > div").not('.ImageAnnotationDiv').remove();
        x = e.pageX - gOffsetLeft;
        y = e.pageY - gOffsetTop;
        minX = Math.min(gStartX, x);
        widthrect = Math.max(gStartX, x) - minX;
        minY = Math.min(gStartY, y);
        heightrect = Math.max(gStartY, y) - minY;
        $("#Canvas").drawRect(minX, minY, widthrect, heightrect, {color: 'blue'});
    };
    //Leave shaping mode, display the shape as a div and prepare to save annotation, if user clicks OK
    stopShaping = function (e) {
        var endX, endY, minH, maxH, minV, maxV,
            invScaleFactor, shapeDiv, divShapeKeepTop, divShapeKeepLeft, coordsString,
            pageExists, annotationPageName, sfFormsLink;
        $('#Canvas').unbind();
        $("#Canvas > div").not('.ImageAnnotationDiv').remove();
        //Calculate shape position relative to current size of image
        endX = e.pageX - gOffsetLeft;
        endY = e.pageY - gOffsetTop;
        minH = Math.min(endX, gStartX);
        maxH = Math.max(endX, gStartX);
        minV = Math.min(endY, gStartY);
        maxV = Math.max(endY, gStartY);
        //The inverse scale factor, so that the shape coordinates are stored with respect to original image size!
        invScaleFactor = $('#imagetoannotate').attr('origwidth') / $('#imagetoannotate').attr('width');

        //Add a div that represents the current shape
        shapeDiv = $('<div class=shapeDiv></div>');
        shapeDiv.css('left', minH);
        shapeDiv.css('top', minV);
        shapeDiv.css('width', maxH - minH);
        shapeDiv.css('height', maxV - minV);
        shapeDiv.css('z-index', '1000');
        shapeDiv.css('border', '1px solid red');
        shapeDiv.css('position', 'absolute');
        $('#Canvas').append(shapeDiv);
        //Show the OK/Cancel field and place it next to the cursor
        $('#divShapeKeep').css('visibility', 'visible');
        divShapeKeepTop  = shapeDiv.offset().top  + shapeDiv.height() + 20;
        divShapeKeepLeft = shapeDiv.offset().left + shapeDiv.width()  + 20;
        $('#divShapeKeep').css('top', divShapeKeepTop);
        $('#divShapeKeep').css('left', divShapeKeepLeft);
        //On Cancel, clear the shape and return to 'view' mode - if user clicks again, he again enters 'shaping' mode
        $('#buttonClear').click(function () {
            $('#divShapeKeep').css('visibility', 'hidden');
            shapeDiv.remove();
            $('#Canvas').unbind();
            $('#Canvas').click(function (e) {
                startShaping(e);
            });
            $('#buttonClear').unbind();
            $('#buttonOK').unbind();
        });
        //On OK, store the annotation
        $('#buttonOK').click(function () {
            $('#divShapeKeep').css('visibility', 'hidden');
            //Calculate shape coordinates with respect to original image size (that is the format they are stored in)
            coordsString = Math.round(minH * invScaleFactor) + ';'
                + Math.round(minV * invScaleFactor) + ';'
                + Math.round(maxH * invScaleFactor) + ';'
                + Math.round(maxV * invScaleFactor);
            pageExists = true;
            //Generate Annotationpage Name and check if it exists - if it does, pick another.
            annotationPageName = "";
            while (pageExists) {
                var response, jsonRes;
                annotationPageName = siaImageAnnotationNS + ':' + wgTitle + '-' + randomString(8);
                response = $.ajax({
                    type: "GET", // request type ( GET or POST )
                    url: wgScriptPath + '/api.php',
                    async: false,
                    data: {
                        'action': 'query',
                        'titles': annotationPageName,
                        'format': 'json'
                    }
                });
                jsonRes = $.parseJSON(response.responseText);
                if (jsonRes.query.pages.hasOwnProperty("-1") && jsonRes.query.pages['-1'].hasOwnProperty('missing')) {
                    pageExists = false;
                }
            }
            //When unique name is found, generate the link to the annotation form
            sfFormsLink = wgScript + '/' + siaLocalizedSpecialPageName + ':FormEdit/' + siaFormName;
            sfFormsLink = sfFormsLink + '/' + annotationPageName;
            //Store the essential properties on the page, such as coordinates, the annotated image and the user who annotated
            $.ajax({
                type: "GET", // request type ( GET or POST )
                url: 'index.php',
                datatype: 'text',
                data: {
                    'action': 'ajax',
                    'rs': 'writeAnnotationProperties',
                    'rsargs': {
                        newPageName: annotationPageName,
                        annotatedImage: wgTitle,
                        imageURL: fullsizeImageUrl,
                        coords: coordsString,
                        createdBy: wgUserName
                    }
                },
                success: function getFormCallback(request) {
                    if (request === 'success') {
                        //When the essential properties have been stored, open a SemanticForm to add additional details
                        ext.popupform.handlePopupFormLink(sfFormsLink, this);
                    }
                }
            });
            $('#buttonOK').unbind();
            $('#buttonClear').unbind();
        });
    };
});