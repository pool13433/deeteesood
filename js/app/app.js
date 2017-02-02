var FILE_SIZE_MB = 2;
var FILE_SIZE_KB = (1024 * 1024 * FILE_SIZE_MB);

var app = angular.module('deeTeeSoodApp', []);
app.constant('URL_SERVICE', YII_URL_SERVICE);
app.config(function () {

});
app.run(function (PluginFactory) {    
    PluginFactory.initJqueryPlugin();
});
