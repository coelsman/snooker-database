app.controller('PlayerCtrl', ['$q', '$rootScope', '$scope', '$http', 'AppService', 'PlayerFactory', 'CountryFactory', 'NgTableParams',
	function ($q, $rootScope, $scope, $http, AppService, PlayerFactory, CountryFactory, NgTableParams) {

	AppService.safeApply($scope, function () {
		$rootScope.pageTitle = 'Player Management';
	});

	$scope.getPlayers = function () {
		PlayerFactory.get().then(function (json) {
			$scope.tableParams = new NgTableParams({
				count: 20
			}, {
				total: json.data.length,
				dataset: json.data,
			});
		});
	};

	$q.all([
		CountryFactory.get(),
		$scope.getPlayers()
	]).then(function (jsonCountry) {
		AppService.safeApply($scope, function () {
			$scope.countries = jsonCountry[0].data;
		});
	});
}]);

app.controller('PlayerDetailsCtrl', ['$q', '$routeParams', '$rootScope', '$scope', '$http', 'AppService', 'PlayerFactory', 'CountryFactory', 'NgTableParams',
	function ($q, $routeParams, $rootScope, $scope, $http, AppService, PlayerFactory, CountryFactory, NgTableParams) {

	AppService.safeApply($scope, function () {
		$rootScope.pageTitle = 'Player Details';
		$scope.careerStatuses = PlayerFactory.careerStatuses;
	});

	$scope.getPlayers = function () {
		if (!isUndefined($routeParams.uuid)) {
			PlayerFactory.detail($routeParams.uuid).then(function (json) {
				AppService.safeApply($scope, function () {
					$scope.playerObject = json.data;
					$scope.playerObject.year_of_birth = parseInt($scope.playerObject.year_of_birth);
					$scope.playerObject.century_breaks = parseInt($scope.playerObject.century_breaks);
					$scope.playerObject.highest_ranking = parseInt($scope.playerObject.highest_ranking);
				});
			});
		} else {
			$scope.playerObject = {};
		}
	};

	$scope.savePlayer = function () {
		if (isUndefined($routeParams.uuid)) {
			PlayerFactory.insert($scope.playerObject);
		} else {
			PlayerFactory.update($routeParams.uuid, $scope.playerObject);
		}
	};

	$q.all([
		CountryFactory.get(),
		$scope.getPlayers()
	]).then(function (jsonCountry) {
		AppService.safeApply($scope, function () {
			$scope.countries = jsonCountry[0].data;
		});
	});
}]);