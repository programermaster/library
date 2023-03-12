
$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".delete").click(function(){
        var destroy_url = $(this).data("url");
        var ajxReq = $.ajax( {
            url : destroy_url,
            type : 'DELETE',
            success : function ( data ) {
                location.reload();
            },
            error : function ( jqXhr, textStatus, errorMessage ) {
                $( ".message" ).append( "Delete request is Fail.");
            }
        });
    });
});
