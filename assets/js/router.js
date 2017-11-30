app.config(['$routeProvider', function($routeProvider) {
	$routeProvider.
		when('/player', {
			templateUrl: baseUrl + 'assets/templates/player.html',
		}).
		when('/player/:uuid', {
			templateUrl: baseUrl + 'assets/templates/player-detail.html',
		}).
		otherwise({
			redirectTo: 'player'
		});
}]);