app.controller('HomeController', HomeController)
        .controller('MRGProductController', MRGProductController).
        controller('ProductController', ProductController)
        .controller('ProductDetailController', ProductDetailController)
        .controller('MRGSocialController', MRGSocialController)
        .controller('MRGVideoController', MRGVideoController)
        .controller('MRGSlideController', MRGSlideController)
        .controller('MRGBrandController', MRGBrandController);

function MRGSlideController(PluginFactory) {
    PluginFactory.compomentUpload();

}

function MRGVideoController() {

}

function MRGBrandController(PluginFactory) {
    PluginFactory.compomentUpload();
}
function MRGSocialController(DTSService, $scope, $timeout, URL_SERVICE, $log, $window, PluginFactory) {
    var vm = this;
    $scope.$watch(function () {
        this.imageList = [];
    });
    this.trashPic = function ($event, pictureId) {
        var seft = $event;
        var isSure = $window.confirm('ยืนยันการลบภาพกิจกรรมนี้');
        if (isSure) {
            DTSService.trashSocialPicture(pictureId).then(function success(response) {
                console.log('response', response);
                $($event.target).parent().remove();
            }, function fail(e) {
                $log.error(e);
            });
        }
    }
    this.btnSocialClick = function () {
        $('#socialInput').off().on('change', function (e) {
            //console.log('e', e);
            vm.imageList = e.target.files;
            $timeout(function () {
                PluginFactory.componentMutiUpload(vm.imageList);
            }, 500);
        }).trigger('click');
    }
}
function ProductDetailController(DTSService, $log, $timeout) {
    var vm = this;
    var rating = {};
    this.pictureView = -1;

    // ********** Facebook Share Button ***********
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.8&appId=1843011375927555";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    // ********** Facebook Share Button ***********

    $('.ui.rating.star').rating({
        onRate: function (value) {
            rating.rat_level = value;
            rating.rat_type = 'STAR';
            saveRating(rating);
        }
    });
    $timeout(function () {
        rating.rat_type = 'VIEW';
        saveRating(rating);
    }, 1000);

    this.picturePreview = function ($event, index) {
        var element = $event.target;
        vm.pictureView = index;
        $('#idPicurePreview').children().css('max-height', '500px').replaceWith($(element).clone());
    }

    function  saveRating(rating) {
        rating.prod_id = vm.prodId;
        DTSService.getClientIP().then(function success(ip) {
            rating.client_ip = ip;

            DTSService.saveProductRating(rating)
                    .then(function success(response) {
                        console.log('saveProductRating ::==', response);
                    }, function fail(e) {
                        $log.error(e);
                    });

        }, function fail(e) {
            $log.error(e);
        });
    }
}

function MRGProductController($scope, $timeout, $window, $log, PluginFactory, DTSService) {
    var vm = this;
    vm.brand = '';

    $scope.$watch(function () {
        this.imageList = [];
    });
    PluginFactory.compomentUpload();

    tinymce.init({
        selector: '#mytextarea'
    });

    var brandId = $('#ddBrand').val();
    console.log(brandId);
    if (brandId != undefined) {
        reloadCarModel(brandId);
    }
    $('#ddBrand').on('change', function (e) {
        var brandId = $(this).val();
        reloadCarModel(brandId);
    });
    this.btnProductsClick = function () {
        $('#productInput').off().on('change', function (e) {
            //console.log('e', e);
            vm.imageList = e.target.files;
            $timeout(function () {
                PluginFactory.componentMutiUpload(vm.imageList);
            }, 500);
        }).trigger('click');
    }
    this.trashPic = function ($event, pictureId) {
        var seft = $event;
        var isSure = $window.confirm('ยืนยันการลบภาพกิจกรรมนี้');
        if (isSure) {
            DTSService.trashProductPicture(pictureId).then(function success(response) {
                console.log('response', response);
                $($event.target).parent().remove();
            }, function fail(e) {
                $log.error(e);
            });
        }
    }
    function reloadCarModel(brandId) {
        DTSService.getModels(brandId).then(function success(response) {
            $('#ddModel').empty();
            $('#ddModel').append('<option value="">--เลือก--</option>');
            $.each(response, function (index, model) {
                $('#ddModel').append('<option value="' + model.mod_id + '">' + model.mod_name + '</option>')
            });
        }, function fail(e) {
            $log.error(e);
        });
    }
}
function ProductController(DTSService, $log, $timeout, $scope) {
    var vm = this;
    this.productList = [];
    this.brandList = [];
    this.modelList = [];
    this.countProduct = 0;
    this.isLoader = false;
    vm.product = {};

    DTSService.getBrands().then(function success(response) {
        vm.brandList = response;
    }, function fail(e) {
        $log.error(e);
    });

    $timeout(function () {
        getProducts(vm.product);
//        $('.ui.sidebar')
//                .sidebar({context: $('.bottom.segment.pushable')})
//                .sidebar('setting', {dimPage: true, closable: false}, 'overlay')
//                //.transition('fade up')
//                .sidebar('attach events', '.menu.filter, .closed');

        $('.ui.accordion').accordion('open', 0);
        //$('.ui.accordion').accordion('open',1);

    }, 500);
    this.selectBrand = function (brandId) {
        DTSService.getModels(brandId).then(function success(response) {
            vm.modelList = response;
            vm.modelList.unshift({mod_id: '', mod_name: '--ทั้งหมด--'});
            $timeout(function () {
                $('#ddModel').dropdown('set selected', '');
            }, 0);
        }, function fail(e) {
            $log.error(e);
        });
    }
    this.filterProductByBrand = function (brandId) {
        vm.product.brand = brandId;
        getProducts(vm.product);
        $('.ui.accordion').accordion('open', 2);
    }
    this.filterProduct = function (filter) {
        console.log('filter ::==', filter);
//        var car = vm.car.filter(function(value){
//            console.log('value ::==',value);
//            return (value);
//        });
        var cars = [];
        angular.forEach(vm.car, function (v, k) {
            if (v)
                cars.push(k);
        });
        console.log('cars ::==', cars);
        filter.car = cars;
        getProducts(filter);
        $('.ui.accordion').accordion('open', 2);
    }
    this.filterReset = function () {
        vm.product = {};
        $timeout(function () {
            $('.dropdown').dropdown('set selected', '');
        }, 0);
    }
    function getProducts(filter) {
        vm.isLoader = true;
        DTSService.getProducts(filter).then(function success(response) {
            vm.productList = response;
            vm.isLoader = false;
            vm.countProduct = response.map(function (cat) {
                return cat.products.length;
            }).reduce(function (sum, length) {
                return sum + length;
            });
            $timeout(function () {
                $('.special.cards .image').dimmer({on: 'hover'});
            }, 0);
        }, function fail(e) {
            $log.error(e);
        });
    }
}
function HomeController(DTSService, URL_SERVICE, $timeout, $log, $window) {
    var vm = this;
    this.carList = [];
    this.brand = {};
    $timeout(function () {
        $('.special.cards .image').dimmer({on: 'hover'});

    }, 0);
    this.hrefProduct = function (brandId) {
        $window.open(URL_SERVICE + '/site/product?brand=' + brandId);
    }
    this.findCarsByBrand = function (brandId) {
        DTSService.getProductsByBrand(brandId)
                .then(function success(response) {
                    vm.carList = response.products;
                    vm.brand = response.brand;
                    $timeout(function () {
                        $('.ui.sidebar')
                                .sidebar('setting', {dimPage: false, closable: true}, 'overlay')
                                .transition('fade up')
                                .sidebar('attach events', '.closed')
                                .sidebar('toggle');
                        $('.special.cards .image').dimmer({on: 'hover'});
                    }, 100);
                }, function fail(e) {
                    $log.error(e);
                });
    }
}
