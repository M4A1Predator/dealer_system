if ( $("#notice").html() != null && $("#notice").html() != '' ) {
    $('#ntMsg').html($("#notice").html());
    $('#noticeModal').modal('toggle');
}