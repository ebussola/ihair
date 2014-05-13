'use strict';

app.controller('salons-list', ['$scope', 'SalonService', 'Geolocation', function ($scope, SalonService, Geolocation) {

    if (navigator.geolocation) {
        Geolocation.watchPosition().then(null, null, function (location) {
            SalonService.getSalonsByLocation(location.coords.latitude+','+location.coords.longitude)
                .then(function (salons) {

                    if (salons.length > 0) {
                        $scope.salons = salons;
                    } else {
                        $('#no_results').modal('show');
                    }
                });
        });
    }
    else {
        // Geolocation is not supported by this browser.
    }

}]);