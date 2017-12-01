app.factory('SeasonFactory', function ($http) {
	return {
		get: function () {
			return $http.get('api/season');
		}
	};
});