app.config(['$routeProvider', function($routeProvider) {
	$routeProvider.
		when('/player', {
			templateUrl: baseUrl + 'assets/templates/player.html',
		}).
		when('/player/add', {
			templateUrl: baseUrl + 'assets/templates/player-detail.html',
		}).
		when('/player/:uuid', {
			templateUrl: baseUrl + 'assets/templates/player-detail.html',
		}).
		when('/tournament', {
			templateUrl: baseUrl + 'assets/templates/tournament.html',
		}).
		when('/tournament/add', {
			templateUrl: baseUrl + 'assets/templates/tournament-detail.html',
		}).
		otherwise({
			redirectTo: 'player'
		});
}]);