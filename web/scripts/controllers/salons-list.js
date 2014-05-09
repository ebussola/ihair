'use strict';

app.controller('salons-list', [function () {

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (location) {

        });
    }
    else {
        // Geolocation is not supported by this browser.
    }

}]);