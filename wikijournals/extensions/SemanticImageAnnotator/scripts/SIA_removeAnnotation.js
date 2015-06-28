/*global $, confirm*/
/**
 *SIA_getAnnotations.js 
 *
 *Provides JavaScript-function to remove an annotation.
 *
 *@author Felix Obenauer
 */
function removeAnnotation(event) {
    "use strict";
    var annotationID = $(event.target).attr('alt');
    if (confirm('Delete this annotation?')) {
        $.ajax({
            type: 'GET',
            url: 'index.php',
            data: {
                'action': 'ajax',
                'rs': 'removeAnnotation',
                'rsargs': {annotationID: annotationID}
            },
            success: function () {
                $(event.target).parent('.deleteDiv').parent('.ImageAnnotationDiv').remove();
            }
        });
    }
}
