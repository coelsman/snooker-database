app.controller('TournamentCtrl', ['$q', '$routeParams', '$rootScope', '$scope', '$http', 'AppService', 'SeasonFactory', 'CountryFactory', 'NgTableParams',
	function ($q, $routeParams, $rootScope, $scope, $http, AppService, SeasonFactory, CountryFactory, NgTableParams) {

	AppService.safeApply($scope, function () {
		$rootScope.pageTitle = 'Tournament Management';
	});

	$q.all([
		SeasonFactory.get()
	]).then(function (data) {
		AppService.safeApply($scope, function () {
			$scope.seasons = data[0].data;
		});
	});
}]);