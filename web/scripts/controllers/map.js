'use strict';

app.controller('map', ['$scope', 'SalonService', 'Geolocation', function ($scope, SalonService, Geolocation) {
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

    Geolocation.getCurrentPosition().then(function(position) {
        $scope.map = {
            center: position.coords,
            user_marker: position.coords,
            zoom: 17,
            options: {
                draggable: true
            }
        };
    });

    Geolocation.watchPosition().then(null, null, function (position) {
        $scope.map.user_marker = position.coords;

        SalonService.getSalonsByLocation(position.coords.latitude + ',' + position.coords.longitude)
            .then(function (salons) {
                if (salons.length > 0) {
                    $scope.salons = salons;
                } else {
                    $('#no_results').modal('show');
                }
            });
    });
}]);