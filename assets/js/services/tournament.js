app.factory('TournamentFactory', function ($http) {
	return {
		get: function () {
			return $http.get('api/tournament');
		},
		getType: function () {
			return $http.get('api/tournament/type');
		},
		getPlayer: function (tournamentUuid, seasonUuid) {
			return $http.get('api/tournament/'+tournamentUuid+'/season/'+seasonUuid + '/player');
		},
		detail: function (uuid) {
			return $http.get('api/tournament/' + uuid);
		},
		insert: function (arrayValues) {
			return $.ajax({
				url: 'api/tournament',
				method: 'POST',
				dataType: 'json',
				data: arrayValues
			});
		},
		update: function (uuid, arrayValues) {
			return $.ajax({
				url: 'api/tournament/' + uuid,
				method: 'POST',
				dataType: 'json',
				data: arrayValues
			});
		},
		getSeasonDetail: function (tournamentUuid, seasonUuid) {
			return $http.get('api/tournament/'+tournamentUuid+'/season/'+seasonUuid);
		},
		updateSeasonDetail: function (tournamentUuid, seasonUuid, arrayValues) {
			return $.ajax({
				url: 'api/tournament/'+tournamentUuid+'/season/'+seasonUuid,
				method: 'POST',
				dataType: 'json',
				data: arrayValues
			});
		},
		updatePlayer: function (tournamentUuid, seasonUuid, arrayValues) {
			return $.ajax({
				url: 'api/tournament/'+tournamentUuid+'/season/'+seasonUuid + '/player',
				method: 'POST',
				dataType: 'json',
				data: arrayValues
			});
		}
	};
});