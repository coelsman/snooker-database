app.factory('SeasonFactory', function ($http) {
	return {
		get: function () {
			return $http.get('api/season');
		},
		getTournaments: function (uuid) {
			return $http.get('api/season/'+uuid+'/tournament');
		}
	};
});