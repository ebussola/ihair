'use strict';

app.controller('salons-list', ['$scope', 'SalonService', 'Geolocation', 'Map', function ($scope, SalonService, Geolocation, Map) {

    $scope.list_salon_click = function(salon) {
        $('#salon_details').modal('show');
        $scope.salon_detail = salon;
    };

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

    Geolocation.getCurrentPosition().then(function (location) {
        SalonService.getSalonsByLocation(location.coords.latitude + ',' + location.coords.longitude)
            .then(function (salons) {

                if (salons.length > 0) {
                    $scope.salons = salons;
                }
            });
    });

}]);