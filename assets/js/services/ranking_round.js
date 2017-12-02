app.factory('RankingRoundFactory', function ($http) {
	return {
		get: function () {
			return $http.get('api/ranking/round');
		}
	};
});