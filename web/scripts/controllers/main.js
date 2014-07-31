'use strict';

app.controller('main', ['$rootScope', 'Geolocation', function ($rootScope, Geolocation) {

    turn_on_location_share_modal();

    function turn_on_location_share_modal() {
        var $turn_geolocation_on = $('#turn_geolocation_on');
        _.delay(function () {
            if (!$turn_geolocation_on.data('geolocation-accepted')) {
                $turn_geolocation_on.modal('show');
            }
        }, 3000);
        Geolocation.getCurrentPosition().then(function () {
            $turn_geolocation_on.modal('hide');
            $turn_geolocation_on.data('geolocation-accepted', '1');
        });
    }

    $rootScope.list_salon_click = function(salon) {
        $('#salon_details').modal('show');
        $rootScope.salon_detail = salon;
    };
}]);
