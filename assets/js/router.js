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
		when('/tournament/:uuid', {
			templateUrl: baseUrl + 'assets/templates/tournament-detail.html',
		}).
		when('/tournament/:tournamentUuid/season', {
			templateUrl: baseUrl + 'assets/templates/tournament-season.html',
		}).
		when('/tournament/:tournamentUuid/season/:seasonUuid', {
			templateUrl: baseUrl + 'assets/templates/tournament-season.html',
		}).
		when('/tournament/:tournamentUuid/season/:seasonUuid/player', {
			templateUrl: baseUrl + 'assets/templates/tournament-season-player.html',
		}).
		otherwise({
			redirectTo: 'player'
		});
}]);