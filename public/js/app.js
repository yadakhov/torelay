$(function() {

    $('#url').focus(function() {
        var url = $('#url').val();
        if (url === 'https://www.whatismyip.com/') {
            $('#url').val('');
        }
    });
    // defaults
    $('#url').blur(function() {
        var url = $('#url').val();
        if (url === '') {
            $('#url').val('https://www.whatismyip.com/');
        }
    });

});
