'use strict';

app.controller('map', ['$scope', 'SalonService', 'Geolocation', 'Map', function ($scope, SalonService, Geolocation, Map) {
    $scope.salons = [];
    $scope.map = Map;

    var updateScopeSalons = function (salons) {
        $scope.salons = [];
        if (salons.length > 0) {

            $scope.salons = salons;
        }
    };

    // register the on-drag-end event to update the salons
    Map.onDragEnd().then(null, null, function(control) {
        var gMap = control.getGMap();
        SalonService.getSalonsByLocation(gMap.getCenter().lat() + ',' + gMap.getCenter().lng())
            .then(updateScopeSalons);
    });

    // make the first call to get the salons, adjust the map, user position and the zoom
    Geolocation.getCurrentPosition().then(function (position) {
        $scope.map.center = position.coords;
        $scope.map.user_marker = position.coords;
        $scope.map.zoom = 17;

        SalonService.getSalonsByLocation(position.coords.latitude + ',' + position.coords.longitude)
            .then(updateScopeSalons);
    });

    // updates the user location whenever the user change his position
    Geolocation.watchPosition().then(null, null, function (position) {
        $scope.map.user_marker = position.coords;
    });
}]);