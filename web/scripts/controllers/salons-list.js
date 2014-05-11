'use strict';

app.controller('salons-list', ['$scope', 'SalonService', function ($scope, SalonService) {

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (location) {
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