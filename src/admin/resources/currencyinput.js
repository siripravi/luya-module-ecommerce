zaa.directive("currencyInput", function () {
  return {
    restrict: "E",
    scope: {
      model: "=",
      data: "=",
    },
    controller: [
      "$scope",
      "$filter",
      function ($scope, $filter) {
        $scope.$watch(
          function () {
            return $scope.model;
          },
          function (n, o) {
            console.log(n, o);
          }
        );
      },
    ],
    template: function () {
      return '<div>Use data and model as they are assigned trough scope defintion: <input type="text" ng-model="model" /></div>';
    },
  };
});
