angular.module('testApp', [
    'angularFileUpload'
    //'ngAnimate',
    //'ngRoute',
    //'core',
    //'phoneDetail',
    //'phoneList',
]).controller('AppController', function($scope, FileUploader) {
    $scope.uploader = new FileUploader({url:'/savefile'});
});