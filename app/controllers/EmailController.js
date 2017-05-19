/**
 * Email Angular Controller
 *
 * @author     Bala <bala.phpdev@gmail.com>
 */
app.controller("EmailController", function (dataFactory,$scope, $http) {
    /**
     * loading the admin emails in the drop down
     * @return array
     */
    $scope.loadData = function () {
        var url = "api/companies";
        return $http.get(url).then(function (response) {
            return response.data;
        });
    };

    /**
     * initiating company admin details in drop down
     * @return none
     */
    $scope.initSelect = function (companies) {
        companies.forEach(function (data) {
            $('#admin').append($('<option>', {
                value: data.email,
                text: data.admin + '[' + data.email + ']'
            }));
        });
    };
    /**
     * send email to business admin
     * @return none
     */
    $scope.sendEmail = function () {
        dataFactory.httpRequest('api/send_email','POST',{},{'admin':$scope.admin,'report':$scope.report }).then(function(data) {
                if(data.status == 'success') {
                    alert('Email successfully Sent');
                } else {
                    alert('Email Failed');
                }
        });
    };
    $scope.loadData() .then($scope.initSelect); // initialize the admin email drop down
});