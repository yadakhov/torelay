$(function() {

    function getIpUrls() {
        return [
            "https://ipnumber.info",
            "http://whatismyip.org",
            "http://www.findmyip.eu",
            "http://www.howtofindmyipaddress.com"
        ];
    }

    function getRandomUrl() {
        var urls = getIpUrls();
        return urls[Math.floor(Math.random() * urls.length)];
    }

    $('#url').focus(function() {
        var url = $('#url').val();
        if (url === 'https://ipnumber.info') {
            $('#url').val('');
        }
    });
    // defaults to http://whatismyip.org
    $('#url').blur(function() {
        var url = $('#url').val();
        if (url === '') {
            $('#url').val('https://ipnumber.info');
        }
    });

});
