/***** Module *****/
var app = angular.module('app_ww', ['ngResource', 'ngSanitize']);

/***** Factory *****/
app.factory('factory_ww', ['$resource', function($resource) {
  return $resource('/api/:name', null,
  {
    'get': {
      method:'GET',
      isArray:true
    }
  });
}]);

/***** Controller *****/
app.controller('ctrl_ww', ['$scope', 'factory_ww', function($scope, factory_ww) {
  var submitting = false;

  $scope.submitWW = function(name) {
    if(submitting) return;
    submitting = true;

    $scope.Data = factory_ww.get({name:$scope.search.name},
      function(Data) {
        jQuery('#error').hide();
        if(Data.length > 0) {
          $scope.title = Data[0].title+'!';
          var Images_String = Data[0].images.replace(/(\r\n|\n|\r)/gm,"");
          var Array_Images = Images_String.split(',');
          $scope.images = '';
          angular.forEach(Array_Images, function(value) {
            var image = jQuery.trim(value);
            $scope.images += '<div class="card-boxes"><img src="'+image+'" alt="'+Data[0].title+'"/></div>';
          });
          $scope.content = Data[0].content;
          jQuery('#popup').fadeIn("slow");
          submitting = false;
        } else {
          jQuery('#error').fadeIn("slow");
          submitting = false;
        }
      },
      function(error) {
        jQuery('#error').fadeIn("slow");
        submitting = false;
      }
    );
  };
}]);
