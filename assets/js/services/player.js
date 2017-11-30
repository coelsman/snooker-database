app.factory('PlayerFactory', function ($http) {
	return {
		get: function () {
			return $http.get('api/player/get');
		},
		detail: function (uuid) {
			return $http.get('api/player/detail/' + uuid);
		}
	};
});