app.controller('TournamentCtrl', ['$q', '$routeParams', '$rootScope', '$scope', '$http', 'AppService', 'PlayerFactory', 'CountryFactory', 'NgTableParams',
	function ($q, $routeParams, $rootScope, $scope, $http, AppService, PlayerFactory, CountryFactory, NgTableParams) {

	AppService.safeApply($scope, function () {
		$rootScope.pageTitle = 'Tournament Management';
	});
}]);