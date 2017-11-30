var app = angular.module('snkApp', ['ngRoute', 'ngTable']);
var baseUrl = $('base').attr('href');

app.run(function ($rootScope) {
	$rootScope.pageTitle = '';
	$rootScope.subDomain = 'cms';
	$rootScope.cmsUrl = function (endpoint) {
		return baseUrl + $rootScope.subDomain + '/#!/' + endpoint;
	};
});