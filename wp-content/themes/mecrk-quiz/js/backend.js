jQuery(document).ready(function(){
    (function( $ ) {
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : sParameterName[1];
                }
            }
        };
        if($('#user-group').length >0){
                var termID = '';
            if(getUrlParameter('tag_ID')){
                termID = getUrlParameter('tag_ID');
            }
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'getRoles',
                    termID: termID
                },
                success: function (data) {
                    $('.acf-checkbox-list').html(data);
                },
                error: function (e) {
                    console.log(e.message);
                }
            });
        }
    })( jQuery );
});