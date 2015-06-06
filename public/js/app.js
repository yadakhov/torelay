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
        if (url === 'http://mxtoolbox.com/WhatIsMyIP') {
            $('#url').val('');
        }
    });
    // defaults
    $('#url').blur(function() {
        var url = $('#url').val();
        if (url === '') {
            $('#url').val('http://mxtoolbox.com/WhatIsMyIP');
        }
    });

});
