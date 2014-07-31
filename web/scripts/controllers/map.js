'use strict';

app.controller('map', ['$scope', '$rootScope','SalonService', 'Geolocation', 'Map',
    function ($scope, $rootScope, SalonService, Geolocation, Map) {
        $rootScope.salons = [];
        $scope.map = Map;

        var updateScopeSalons = function (salons) {
            if (salons.length > 0) {

                _.each(salons, function (salon) {
                    if ($rootScope.salons.indexOf(salon) == -1) {
                        $rootScope.salons.push(salon);
                    }
                });
            }
        };

        // register the on-drag-end event to update the salons
        Map.onDragEnd().then(null, null, function (control) {
            var gMap = control.getGMap();
            $rootScope.salons = [];
            SalonService.getSalonsByLocation(gMap.getCenter().lat() + ',' + gMap.getCenter().lng())
                .then(null, null, updateScopeSalons);
        });

        // make the first call to get the salons, adjust the map, user position and the zoom
        Geolocation.getCurrentPosition().then(function (position) {
            $scope.map.center = position.coords;
            $scope.map.user_marker = position.coords;
            $scope.map.zoom = 17;

            SalonService.getSalonsByLocation(position.coords.latitude + ',' + position.coords.longitude)
                .then(null, null, updateScopeSalons);
        });

        // updates the user location whenever the user change his position
        Geolocation.watchPosition().then(null, null, function (position) {
            $scope.map.user_marker = position.coords;
        });
    }]);