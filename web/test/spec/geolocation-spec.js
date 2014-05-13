'use strict';

describe('Geolocation Service', function() {

    beforeEach(module('ihair'));

    describe('getCurrentPosition', function() {
        it ('should return a promise with the current user\'s position', inject(function($rootScope, Geolocation) {
            var current_position = Geolocation.getCurrentPosition();

            expect(typeof current_position).toBe('object');
            expect(typeof current_position.then).toBe('function');
        }));
    });

    describe('watchPosition', function() {
        it ('should return a promise with the result of actual user\'s position', inject(function(Geolocation) {
            var position = Geolocation.watchPosition();

            expect(typeof position).toBe('object');
            expect(typeof position.then).toBe('function');
        }));
    });

});