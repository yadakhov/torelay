$(function() {

    $('#url').focus(function() {
        var url = $('#url').val();
        if (url === 'https://ipnumber.info') {
            $('#url').val('');
        }
    });
    // defaults
    $('#url').blur(function() {
        var url = $('#url').val();
        if (url === '') {
            $('#url').val('https://ipnumber.info');
        }
    });

});
