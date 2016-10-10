$(function() {

    $('#url').focus(function() {
        var url = $('#url').val();
        if (url === 'http://www.whatsmyip.org/') {
            $('#url').val('');
        }
    });
    // defaults
    $('#url').blur(function() {
        var url = $('#url').val();
        if (url === '') {
            $('#url').val('http://www.whatsmyip.org/');
        }
    });

});
