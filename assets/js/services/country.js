app.factory('CountryFactory', function ($http) {
	return {
		get: function () {
			return $http.get(baseUrl + 'assets/jsons/country.json');
		}
	};
});