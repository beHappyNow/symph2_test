angular.module('testApp', [
    'angularFileUpload'
    //'ngAnimate',
    //'ngRoute',
    //'core',
    //'phoneDetail',
    //'phoneList',
]).controller('AppController', function($scope, FileUploader) {
    var uploader = $scope.uploader = new FileUploader({url:'/savefile', alias:"imageFile",formData:[{save:"saved"}]});
    uploader.onSuccessItem = function(item, response, status, headers) {console.log("!@#");$scope.uploader.removeFromQueue(item)};
});