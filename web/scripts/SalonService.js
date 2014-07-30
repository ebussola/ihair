'use strict';

app.factory('SalonService', ['$http', '$q', function ($http, $q) {

    var pusher = new Pusher('95a73fe212094600645d');
    var channel = pusher.subscribe('salons');
    var deferred = $q.defer();
    var client_id = Math.floor((Math.random() * 100000000)) * Math.floor((Math.random() * 100)) + new Date().getTime();

    channel.bind(client_id, function(data) {
        deferred.notify(JSON.parse(data));
    });

    return {

        promise: deferred.promise,

        client_id: client_id,

        last_url: null,

        getSalonsByLocation: function (geolocation, radius) {
            radius = (radius == null) ? 200 : radius;
            var params = $.param({latlng: geolocation, radius: radius, client_id: this.client_id});
            var url = '/api/salons/?' + params;

            if (this.last_url != url) {
                $http.get(url);
                this.last_url = url;
            }

            return this.promise;
        }
    };

}]);