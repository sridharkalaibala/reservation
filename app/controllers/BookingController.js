    /**
     * Booking Angular Controller
     *
     * @author     Bala <bala.phpdev@gmail.com>
     */
app.controller("BookingController", function (dataFactory,$scope,$routeParams) {
        $scope.stands = [];
        $scope.mapimage = '';
        /**
         * initiating the data of virtual map image and stands on it
         * @param integer id  location id
         * @return none
         */
        $scope.init = function(id){
            dataFactory.httpRequest('api/location/'+$routeParams.locationid).then(function(data) {
                $scope.mapimage = (typeof data[0] != 'undefined') ? data[0].mapimage :'default.jpg' ;
            });
            dataFactory.httpRequest('api/stands/'+$routeParams.locationid).then(function(data) {
                $scope.stands = data;
                $scope.addStands(data);
            });
        }

        /**
         * populate stand details in virtual map
         * @param array stands  stands json array
         * @return none
         */
        $scope.addStands = function(stands) {
            stands.forEach(function (data) {

                if(data.booking_status == 'Free') {
                    var newStand = "";
                    var title = "";
                    title = ""+data.name+" <br> <img height=\"100\" width=\"100\" src=\"app/img/stands/image/"+data.image+"\" /> <br> Price : "+data.price+" USD";
                    title += "<br> <button class=\"reserve_button btn-success\"  data-toggle=\"modal\" data-target=\"#create-company\" data-standid=\""+data.id+"\"> Reserve </button>";
                    newStand = $("<div data-toggle='tooltip' class='btn-success'  data-html='true'  title='"+title+"'> "+data.booking_status+"</div>");
                    $scope.addHTML(data,newStand)
                }else {
                    dataFactory.httpRequest('api/company/'+data.booked_by).then(function(company) {
                        var bookedStand = '';
                        if(typeof company[0] != 'undefined') {
                            company = company[0];
                            title = "Admin:"+company.admin+"  <br> <img height=\"70\" width=\"70\" src=\"app/img/logos/"+company.logo+"\" /> <br> Phone : "+company.phone+"";
                            title += "<br> Email : "+company.email+" <br> Marketing Document: <a class=\"btn-primary\" href=\"app/downloads/"+company.marketing_documents+"\" target=\"_blank\"> Download </a> ";
                            bookedStand = $("<div data-toggle='tooltip' class='btn-danger'  data-html='true'  title='"+title+"'> "+data.booking_status+" </div>");
                        }
                        $scope.addHTML(data,bookedStand)
                    });

                }


            });

        }
        /**
         * Add HTML data into stand tooltip
         * @param array data  stands json array
         * @param string html  tooltip html
         * @return none
        */
        $scope.addHTML = function(data,html) {
            var position = data.position.split(',');
            html.css({position: "absolute", left: position[0], top: position[1]});
            $("#container").append(html);
            $('[data-toggle="tooltip"]').tooltip({trigger: 'manual'}).tooltip('show');
        }
        /**
         * Booking through angular and Jquery AJAX service
         * @return none
         */
        $scope.createCompany = function(){
            dataFactory.fileForm('api/create_company',$routeParams.locationid);
        }

        $scope.init(); // initializing the map and stands data
    });

    // Adding angular file support in the Booking form
    app.directive('validFile',function(){
        return {
            require:'ngModel',
            link:function(scope,el,attrs,ngModel){
                //change event is fired when file is selected
                el.bind('change',function(){
                    scope.$apply(function(){
                        ngModel.$setViewValue(el.val());
                        ngModel.$render();
                    });
                });
            }
        }
    });

