var app = angular.module('snkApp', ['ngRoute', 'ngTable']);
var baseUrl = $('base').attr('href');

var isUndefined = function (v) {
	return 'undefined' === typeof v;
};

var isNull = function (v) {
	return v === null || v == 'null';
};

app.run(function ($rootScope) {
	$rootScope.pageTitle = '';
	$rootScope.subDomain = 'cms';
	$rootScope.cmsUrl = function (endpoint) {
		return baseUrl + $rootScope.subDomain + '#!/' + endpoint;
	};
});