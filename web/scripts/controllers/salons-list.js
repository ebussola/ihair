'use strict';

app.controller('salons-list', ['$scope', 'SalonService', function ($scope, SalonService) {

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (location) {
            SalonService.getSalonsByLocation(location.coords.latitude+','+location.coords.longitude)
                .then(function (salons) {
                    $scope.salons = salons;
                });
        });
    }
    else {
        // Geolocation is not supported by this browser.
    }

}]);