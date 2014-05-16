'use strict';

app.factory('Map', ['$q', function ($q) {
    var on_drag_end_deferred = $q.defer();

    return {
        center: {
            latitude: -22.9112728,
            longitude: -43.4484478
        },
        user_marker: {
            latitude: -22.9112728,
            longitude: -43.4484478
        },
        zoom: 8,
        events: {
            dragend: function () {
                on_drag_end_deferred.notify(this.control);
            }
        },
        options: {
            disableDefaultUI: true
        },
        control: {},

        onDragEnd: function() {
            return on_drag_end_deferred.promise;
        }
    };
}]);