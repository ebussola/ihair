'use strict';

app.factory('SalonService', ['$http', function ($http) {

    return {
        getSalonsByLocation: function (geolocation, radius) {
            radius = (radius == null) ? 100 : radius;

            var params = $.param({latlng: geolocation, radius: radius});
            return $http.get('http://ihair-api.herokuapp.com/api/salons?' + params).then(function(response) {
                return response.data;
            });
        }
    };

}]);
