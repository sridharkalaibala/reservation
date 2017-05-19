/**
 * App Routing
 *
 * @author     Bala <bala.phpdev@gmail.com>
 */
var app =  angular.module('main-App',['ngRoute']);

app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', {
                templateUrl: 'templates/home.html',
                controller: 'HomeController'
            }).
            when('/booking/:locationid?', {
                templateUrl: 'templates/booking.html',
                controller: 'BookingController'
            }).
            when('/admin/email', {
                templateUrl: 'templates/email.html',
                controller: 'EmailController'
            });
}]);