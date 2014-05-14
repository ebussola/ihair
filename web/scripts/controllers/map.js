'use strict';

app.controller('map', ['$scope', 'SalonService', 'Geolocation', 'Map', function ($scope, SalonService, Geolocation, Map) {
    $scope.salons = [];
    $scope.map = Map;

    Map.onDragEnd().then(null, null, function(control) {
        var gMap = control.getGMap();
        SalonService.getSalonsByLocation(gMap.getCenter().lat() + ',' + gMap.getCenter().lng())
            .then(function (salons) {
                $scope.salons = [];
                if (salons.length > 0) {
                    $scope.salons = salons;
                }
            });
    });

    Geolocation.getCurrentPosition().then(function (position) {
        $scope.map.center = position.coords;
        $scope.map.user_marker = position.coords;
        $scope.map.zoom = 17;

        SalonService.getSalonsByLocation(position.coords.latitude + ',' + position.coords.longitude)
            .then(function (salons) {
                $scope.salons = [];
                if (salons.length > 0) {
                    $scope.salons = salons;
                }
            });
    });

    Geolocation.watchPosition().then(null, null, function (position) {
        $scope.map.user_marker = position.coords;
    });
}]);