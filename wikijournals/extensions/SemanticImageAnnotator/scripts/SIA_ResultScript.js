/*global $, document, jQuery, mw, wgExtensionAssetsPath*/
/**
 *SIA_ResultScript.js 
 *
 *Provides 'window' functionality for displaying annotations as query result.
 *
 *@author Felix Obenauer
 */

//Functions:
var hideInfoBox, showInfoBox, putInFront, loadAnnotationInfoBox;

 //IE9 Fix for JQuery draggable:
(function ($) {
    "use strict";
    var a = $.ui.mouse.prototype._mouseMove;
    $.ui.mouse.prototype._mouseMove = function (b) {
        if ($.browser.msie && document.documentMode >= 9) {
            b.button = 1;
        }
        a.apply(this, [b]);
    };
}
(jQuery)
);

/*
 *Add click listeners to all image Annotations
 */
$(document).ready(function () {
    "use strict";
    $('.ImageAnnotationDiv').each(function (index, displayDiv) {
        $(displayDiv).click(function (e) {
            loadAnnotationInfoBox(e, displayDiv);
        });
    });
});

/*
 *On first click, construct the SIAinfoBox and load contents of annotation into it
 *@param annoDiv a jQuery object that represents the annotationDiv on the picture
 */
function loadAnnotationInfoBox(e, annoDiv) {
    "use strict";
    var targetAnnotationID, infoBox, offsetTop, offsetLeft, infoBoxHeader, closeImgDiv;
    $(annoDiv).unbind();
    targetAnnotationID = $(e.target).attr('targetannotation');

    infoBox = $('<div class="SIAinfoBox"><div>');

    offsetTop  = $(annoDiv).offset().top;
    offsetLeft = $(annoDiv).offset().left + $(annoDiv).width();

    $(infoBox).css('top', offsetTop);
    $(infoBox).css('left', offsetLeft);
    $(infoBox).css('position', 'absolute');

    infoBoxHeader = $('<div class="dragheader" style="z-index:400;"></div>');
    closeImgDiv = $('<div><img height="20px" width="20px" style="z-index:400;" src="' + wgExtensionAssetsPath + '/SemanticImageAnnotator/images/loading.gif"></div>');
    $(closeImgDiv).css('text-align', 'right');
    $(infoBoxHeader).append(closeImgDiv);

    $(infoBox).append(infoBoxHeader);
    $(infoBox).mousedown(function (e) {
        putInFront(infoBox);
    });
    $('body').append(infoBox);
    $(infoBox).draggable({handle: '.dragheader'}, {addClasses: false}, {cancel: 'img'});
    $(infoBox).resizable();
    $.ajax({
        type: "GET",
        url: mw.config.get('wgScript'),
        datatype: 'html',
        //async:false,
        data: {
            'title': targetAnnotationID,
            'action': 'render'
        },
        success: function renderCallback(HTMLRequest) {
            $(infoBox).append(HTMLRequest);
            $(infoBox).css('width', 400);
            $(infoBox).css('z-index', 10);
            $(closeImgDiv).empty();
            $(closeImgDiv).append($('<img src="' + wgExtensionAssetsPath + '/SemanticImageAnnotator/images/close.png" style="cursor:pointer;">'));

            $(closeImgDiv).children('img').click(function (e) {
                hideInfoBox(infoBox, annoDiv);
            });
        }
    });
}

function putInFront(infoBox) {
    "use strict";
    $('.SIAinfoBox').each(function (i, infB) {
        $(infB).css('z-index', 8);
    });
    $(infoBox).css('z-index', 10);
}

function showInfoBox(infoBox, annoDiv) {
    "use strict";
    $(infoBox).css('visibility', 'visible');
    $(annoDiv).unbind();
}

function hideInfoBox(infoBox, annoDiv) {
    "use strict";
    $(infoBox).css('visibility', 'hidden');
    $(annoDiv).click(function (e) {
        showInfoBox(infoBox, annoDiv);
    });
}