'use strict';

app.controller('map', ['$scope', 'SalonService', function ($scope, SalonService) {
    $scope.salons = [];
    $scope.map = {
        center: {
            latitude: -22.9112728,
            longitude: -43.4484478
        },
        user_marker: {
            latitude: -22.9112728,
            longitude: -43.4484478
        },
        zoom: 8
    };

    navigator.geolocation.getCurrentPosition(function (location) {
        $scope.map = {
            center: location.coords,
            user_marker: location.coords,
            zoom: 17,
            options: {
                draggable: true
            }
        };

        SalonService.getSalonsByLocation(location.coords.latitude + ',' + location.coords.longitude)
            .then(function (salons) {
                if (salons.length > 0) {
                    $scope.salons = salons;
                } else {
                    $('#no_results').modal('show');
                }
            });
    });
}]);