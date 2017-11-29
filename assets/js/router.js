app.config(['$routeProvider', function($routeProvider) {
	$routeProvider.
		when('/player', {
			templateUrl: baseUrl + 'assets/templates/player.html',
		}).
		otherwise({
			redirectTo: 'player'
		});
}]);