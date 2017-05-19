/**
 * dataFactory service for AJAX http request
 *
 * @author     Bala <bala.phpdev@gmail.com>
 */
app.factory('dataFactory', function ($http) {
    var myService = {
        /**
         * sending the GET / POST / PUT request to given url
         * @param string url  Api url
         * @param string method query method
         * @param array params  form parameters
         * @param mixed dataPost form data
         * @param mixed upload  file data
         * @return object
         */
        httpRequest: function (url, method, params, dataPost, upload) {
            var passParameters = {};
            passParameters.url = url;

            if (typeof method == 'undefined') {
                passParameters.method = 'GET';
            } else {
                passParameters.method = method;
            }

            if (typeof params != 'undefined') {
                passParameters.params = params;
            }

            if (typeof dataPost != 'undefined') {
                passParameters.data = dataPost;
            }

            if (typeof upload != 'undefined') {
                passParameters.upload = upload;
            }
            // passParameters.headers = {'Content-Type': 'application/x-www-form-urlencoded'};
            var promise = $http(passParameters).then(function (response) {
                return response.data;
            }, function () {
                alert('Error in request');
            });
            return promise;
        },
        /**
         * upload the logo and marketing documents with this
         * @param string url  Api url
         * @param integer id location id
         * @return none
         */
        fileForm: function (url, id) {
            var form = document.forms["addCompany"];;
            var formData = new FormData(form);
            console.log(formData);
               $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function (data) {
                    if(data.status == 'success') {
                        alert('Booked successfully');
                        window.location.reload();
                    }else {
                        alert(data.message);
                    }

                },
                cache: false,
                contentType: false,
                processData: false
            });

        }
    };
    return myService;
});