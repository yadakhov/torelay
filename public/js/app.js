$(function() {

    $('#url').focus(function() {
        var url = $('#url').val();
        if (url === 'http://whatismyip.org') {
            $('#url').val('');
        }
    });
    // defaults to http://whatismyip.org
    $('#url').blur(function() {
        var url = $('#url').val();
        if (url === '') {
            $('#url').val('http://whatismyip.org');
        }
    });

});
