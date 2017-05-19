/**
 * Home Angular Controller
 *
 * @author     Bala <bala.phpdev@gmail.com>
 */
app.controller("HomeController", function ($scope, $http) {
        $scope.id = 0;
        /**
         * loading the home page location data
         * @return array
         */
        $scope.loadData = function () {
            var url = "api/locations";
            return $http.get(url).then(function (response) {
                return response.data;
            });
        };
        /**
         * initiating the data locations in home page and create markers in google map
         * @param array data  location data
         * @return none
         */
        $scope.initMap = function (data) {
            var mapOptions = {
                zoom: 16,
                center: new google.maps.LatLng(34.027743, -117.945722),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
            // create markers for each location
            data.forEach(function (location) {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(location.lat, location.lng),
                    map: map,
                    label: {
                        text: location.name,
                        color: "#746855",
                        fontSize: "16px",
                        fontWeight: "bold"
                    },
                    animation: google.maps.Animation.DROP,
                    icon: {
                        labelOrigin: new google.maps.Point(60, 0),
                        url: 'app/img/marker.png', // our customized image
                    }
                });
                // on click we will show the button in bottom of the google map
                google.maps.event.addListener(marker, 'click', function() {
                    $('#booking').slideDown('slow');
                    $('#details').html(location.details);
                    $scope.id = location.id;
                    marker.setAnimation(google.maps.Animation.BOUNCE);
                    setTimeout(function() {
                        marker.setAnimation(null);
                    }, 2000);

                });
            });
        };
        /**
         * redirect to stands virtual map for booking
         * @param integer id  location primary key
         * @return none
         */
        $scope.redirect =function (id) {
            window.location.href = '#/booking/'+id;
        };
        $scope.loadData()
            .then($scope.initMap); // load and initialize the home page map
    });