app.controller('PlayerCtrl', ['$q', '$scope', '$http', 'PlayerFactory', function ($q, $scope, $http, PlayerFactory) {
	$scope.getPlayers = function () {
		PlayerFactory.get().then(function (json) {
			console.log(json);
		});
	};

	$q.all([
		$scope.getPlayers()
	]);

	console.log(2);
}]);