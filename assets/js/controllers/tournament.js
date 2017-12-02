app.controller('TournamentCtrl', ['$q', '$routeParams', '$rootScope', '$scope', '$http', 'AppService', 'SeasonFactory', 'TournamentFactory', 'NgTableParams',
	function ($q, $routeParams, $rootScope, $scope, $http, AppService, SeasonFactory, TournamentFactory, NgTableParams) {

	AppService.safeApply($scope, function () {
		$rootScope.pageTitle = 'Tournament Management';
	});

	$scope.getTournament = function () {
		TournamentFactory.get().then(function (json) {
			$scope.tableParams = new NgTableParams({
				count: 20
			}, {
				total: json.data.length,
				dataset: json.data,
			});
		});
	};

	$scope.filterTournament = function () {
		if ($scope.filter.season) {
			SeasonFactory.getTournaments($scope.filter.season).then(function (json) {
				$scope.tableParams = new NgTableParams({
					count: 20
				}, {
					total: json.data.length,
					dataset: json.data,
				});
			});
		} else {
			$scope.getTournament();
		}
	};

	$q.all([
		$scope.getTournament(),
		SeasonFactory.get(),
		TournamentFactory.getType(),
	]).then(function (data) {
		AppService.safeApply($scope, function () {
			$scope.seasons = data[1].data;

			var types = data[2].data;
			$scope.tournamentTypes = {};

			angular.forEach(types, function (type, k) {
				$scope.tournamentTypes[type.id] = type.name;
			});
		});
	});
}]);

app.controller('TournamentDetailCtrl', ['$q', '$routeParams', '$rootScope', '$scope', '$http', 'AppService', 'SeasonFactory', 'TournamentFactory', 'NgTableParams',
	function ($q, $routeParams, $rootScope, $scope, $http, AppService, SeasonFactory, TournamentFactory, NgTableParams) {

	AppService.safeApply($scope, function () {
		$rootScope.pageTitle = 'Tournament Details';
		$scope.tournamentObject = {};
	});

	if (!isUndefined($routeParams.uuid)) {
		TournamentFactory.detail($routeParams.uuid).then(function (json) {
			AppService.safeApply($scope, function () {
				$scope.tournamentObject = json.data;
			});
		});
	}

	$scope.saveTournament = function () {
		if (isUndefined($routeParams.uuid)) {
			TournamentFactory.insert($scope.tournamentObject);
		} else {
			TournamentFactory.update($routeParams.uuid, $scope.tournamentObject);
		}
	};

	$q.all([
		SeasonFactory.get()
	]).then(function (data) {
		AppService.safeApply($scope, function () {
			$scope.seasons = data[0].data;
		});
	});
}]);

app.controller('TournamentSeasonCtrl', ['$q', '$routeParams', '$rootScope', '$scope', '$http', 'AppService', 'SeasonFactory', 'TournamentFactory', 'RankingRoundFactory', 'NgTableParams',
	function ($q, $routeParams, $rootScope, $scope, $http, AppService, SeasonFactory, TournamentFactory, RankingRoundFactory, NgTableParams) {

	$scope.getTournamentSeason = function () {
		if (!isUndefined($scope.filter.season)) {
			TournamentFactory.getSeasonDetail($routeParams.tournamentUuid, $scope.filter.season).then(function (json) {
				AppService.safeApply($scope, function () {
					$scope.tournamentSeasonObject = json.data;

					if (isNull($scope.tournamentSeasonObject)) {
						$scope.tournamentSeasonObject = {};
					}

					if (!$scope.tournamentSeasonObject.prize_funds) {
						$scope.tournamentSeasonObject.prize_funds = {};
					}
				});
			});
		}
	};

	AppService.safeApply($scope, function () {
		$rootScope.pageTitle = 'Tournament Seasons';
		$scope.filter = {};

		if ($routeParams.seasonUuid) {
			$scope.filter.season = $routeParams.seasonUuid;
			$scope.getTournamentSeason();
		}
	});

	$scope.saveTournamentSeason = function () {
		if (isUndefined($scope.tournamentSeasonObject.tournament_uuid)) {
			$scope.tournamentSeasonObject.tournament_uuid = $routeParams.tournamentUuid;
			$scope.tournamentSeasonObject.season_uuid = $scope.filter.season;
		}

		TournamentFactory.updateSeasonDetail(
			$scope.tournamentSeasonObject.tournament_uuid,
			$scope.tournamentSeasonObject.season_uuid,
			$scope.tournamentSeasonObject
		);
	};

	$q.all([
		RankingRoundFactory.get(),
		SeasonFactory.get(),
		TournamentFactory.getType(),
	]).then(function (data) {
		AppService.safeApply($scope, function () {
			$scope.rankings        = data[0].data;
			$scope.seasons         = data[1].data;
			$scope.tournamentTypes = data[2].data;
		});
	});
}]);

app.controller('TournamentSeasonPlayerCtrl', ['$q', '$routeParams', '$rootScope', '$scope', '$http', 'AppService', 'SeasonFactory', 'TournamentFactory', 'PlayerFactory', 'RankingRoundFactory', 'NgTableParams',
	function ($q, $routeParams, $rootScope, $scope, $http, AppService, SeasonFactory, TournamentFactory, PlayerFactory, RankingRoundFactory, NgTableParams) {

	AppService.safeApply($scope, function () {
		$rootScope.pageTitle = 'Tournament Seasons Player';
	});

	$scope.getTournamentSeason = function () {
		TournamentFactory.getSeasonDetail($routeParams.tournamentUuid, $routeParams.seasonUuid).then(function (json) {
			AppService.safeApply($scope, function () {
				$scope.tournamentSeasonObject = json.data;

				if (isNull($scope.tournamentSeasonObject)) {
					$scope.tournamentSeasonObject = {};
				} else {
					$rootScope.pageTitle += ' - ' + $scope.tournamentSeasonObject.alias;
				}

				if (!$scope.tournamentSeasonObject.prize_funds) {
					$scope.tournamentSeasonObject.prize_funds = {};
				}
			});
		});
	};

	$scope.getPlayer = function () {
		PlayerFactory.get().then(function (json) {
			$scope.players = json.data;
		});
	};

	$scope.getTournamentPlayer = function () {
		TournamentFactory.getPlayer($routeParams.tournamentUuid, $routeParams.seasonUuid).then(function (json) {
			$scope.tournamentPlayers = json.data;
		});
	};

	$scope.addTournamentPlayer = function () {

	};

	$q.all([
		$scope.getPlayer(),
		$scope.getTournamentSeason(),
		$scope.getTournamentPlayer(),
		RankingRoundFactory.get(),
	]).then(function (data) {
		$scope.rankings = data[3].data;
	});
}]);