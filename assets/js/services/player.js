app.factory('PlayerFactory', function ($http) {
	return {
		get: function () {
			return $http.get('api/player/get');
		}
	};
});