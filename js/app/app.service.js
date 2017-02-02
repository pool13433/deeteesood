app.service('DTSService', DTSService);

function DTSService($q, URL_SERVICE) {
    return {
        getProducts: function (filter) {
            var defer = $q.defer();
            $.post(URL_SERVICE + '/service/GetProducts', filter, function (response) {
                defer.resolve(response);
            }, 'json').fail(function (e) {
                defer.reject(e);
            });
            return defer.promise;
        },
        getProductsByBrand: function (brandId) {
            var defer = $q.defer();
            $.post(URL_SERVICE + '/service/GetProductsByBrand', {brand:brandId}, function (response) {
                defer.resolve(response);
            }, 'json').fail(function (e) {
                defer.reject(e);
            });
            return defer.promise;
        },
        getModels: function (brandId) {
            var defer = $q.defer();
            $.post(URL_SERVICE + '/service/GetCarModels', {brand:brandId}, function (response) {
                defer.resolve(response);
            }, 'json').fail(function (e) {
                defer.reject(e);
            });
            return defer.promise;
        },
         getBrands: function () {
            var defer = $q.defer();
            $.post(URL_SERVICE + '/service/GetCarBrands', {}, function (response) {
                defer.resolve(response);
            }, 'json').fail(function (e) {
                defer.reject(e);
            });
            return defer.promise;
        },
        getClientIP: function () {
            var defer = $q.defer();
            $.getJSON('//freegeoip.net/json/?callback=?', function (data) {
                //console.log(JSON.stringify(data, null, 2));
                 defer.resolve(data.ip);
            });
            return defer.promise;
        },
        saveProductRating: function (rating) {
            var defer = $q.defer();
            $.post(URL_SERVICE + '/service/SaveProductRating', rating, function (response) {
                defer.resolve(response);
            }, 'json').fail(function (e) {
                defer.reject(e);
            });
            return defer.promise;
        },
        trashSocialPicture: function (pictureId) {
            var defer = $q.defer();
            $.get(URL_SERVICE + '/service/DeleteSocialPicture', {id: pictureId}, function (response) {
                defer.resolve(response);
            }, 'json').fail(function (e) {
                defer.reject(e);
            });
            return defer.promise;
        },
        trashProductPicture: function (pictureId) {
            var defer = $q.defer();
            $.get(URL_SERVICE + '/service/DeleteProductPicture', {id: pictureId}, function (response) {
                defer.resolve(response);
            }, 'json').fail(function (e) {
                defer.reject(e);
            });
            return defer.promise;
        }
    }
}

