app.factory('PlayerFactory', function ($http) {
	return {
		get: function () {
			return $http.get('api/player');
		},
		detail: function (uuid) {
			return $http.get('api/player/' + uuid);
		},
		insert: function (arrayValues) {
			return $.ajax({
				url: 'api/player',
				method: 'POST',
				dataType: 'json',
				data: arrayValues
			});
		},
		update: function (uuid, arrayValues) {
			return $.ajax({
				url: 'api/player/' + uuid,
				method: 'POST',
				dataType: 'json',
				data: arrayValues
			});
		},
		careerStatuses: ['Professional', 'Amateur', 'Retired']
	};
});