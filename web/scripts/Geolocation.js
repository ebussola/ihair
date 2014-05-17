'use strict';

app.factory('Geolocation', ['$q', function ($q) {
    var deferred = $q.defer();

    navigator.geolocation.watchPosition(function (position) {
        deferred.notify(position);

    }, function (error) {
        deferred.reject(error);

    }, { enableHighAccuracy: false, maximumAge: 10000, timeout: 30000 });

    return {
        getCurrentPosition: function () {
            var deferred = $q.defer();

            navigator.geolocation.getCurrentPosition(function (position) {
                deferred.resolve(position);
            });

            return deferred.promise;
        },

        watchPosition: function () {
            return deferred.promise;
        }
    }
}]);