'use strict';

app.factory('SalonService', ['$http', function ($http) {

    return {
        getSalonsByLocation: function (geolocation, radius) {
            radius = (radius == null) ? 200 : radius;

            var params = $.param({latlng: geolocation, radius: radius});
            return $http.get('/api/salons/?' + params).then(function(response) {
                var salons = response.data;

                _.each(salons, function(salon) {
                    salon.location = {
                        latitude: salon.geometry.location.lat,
                        longitude: salon.geometry.location.lng
                    }
                });

                return salons;
            });
        }
    };

}]);