zaa.directive("articleFeatures", function () {
  return {
    restrict: "E",
    scope: {
      model: "=",
      article: "=",
    },
    controller: [
      "$scope",
      "$http",
      function ($scope, $http) {
        $scope.$watch("article", function (n, o) {
          console.log($scope.article);
          if (n != null && n) {
            $scope.getArticleFeaturesData(n);
          }
        });

        $scope.$watch("model", function (n, o) {
          if (angular.isArray(n) || n == undefined) {
          }
          if (n != null && n) {
          }
        });

        $scope.getArticleFeaturesData = function (id) {
          $http
            .get("admin/api-catalog-product/features?id=" + id)
            .then(function (r) {
              console.log("RET:", JSON.stringify(r.data));
              var selected = r.data.selected;
              var fVals = r.data.fVals;
              $scope.model = selected;
              var val_ids = [];
              fVals.forEach(function (part, index, arr) {
                part.attrVals = { id: "", name: "", input: "", values: "" };
                Object.keys(part.attributes).forEach((key) => {});
              });

              $scope.data = fVals;
            });
        };

        $scope.toggleValSel = function (f, v) {
          var tof = $scope.model[f][v];
          $scope.model[f][v] = tof == 1 ? 0 : 1;
        };
      },
    ],
    templateUrl: "catalogadmin/article/article-features",
  };
});
