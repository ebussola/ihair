'use strict';

app.controller('map', ['$scope', 'SalonService', function ($scope, SalonService) {
    $scope.salons = [];
    $scope.map = {
        center: {
            latitude: -22.9112728,
            longitude: -43.4484478
        },
        zoom: 8
    };

    navigator.geolocation.getCurrentPosition(function (location) {
        $scope.map = {
            center: {
                latitude: location.coords.latitude,
                longitude: location.coords.longitude
            },
            zoom: 17
        };

        SalonService.getSalonsByLocation(location.coords.latitude + ',' + location.coords.longitude)
            .then(function (salons) {

                _.each(salons, function(salon) {
                    salon.location = {
                        latitude: salon.geometry.location.lat,
                        longitude: salon.geometry.location.lng
                    }
                });

                if (salons.length > 0) {
                    $scope.salons = salons;
                } else {
                    $('#no_results').modal('show');
                }
            });
    });
}]);