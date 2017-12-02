<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$uuidRegex = '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route["api/player"]['GET']               = 'api/api_player/get';
$route["api/player"]['POST']              = 'api/api_player/insert';
$route["api/player/($uuidRegex)"]['GET']  = 'api/api_player/detail/$1';
$route["api/player/($uuidRegex)"]['POST'] = 'api/api_player/update/$1';

$route["api/season"]['GET']                          = 'api/api_season/get';
$route["api/season"]['POST']                         = 'api/api_season/insert';
$route["api/season/tournament"]['GET']               = 'api/api_season/tournament';
$route["api/season/($uuidRegex)/tournament"]['GET']  = 'api/api_season/tournament/$1';
$route["api/season/($uuidRegex)/tournament"]['POST'] = 'api/api_season/add_tournament/$1';

$route["api/tournament"]['GET']                                          = 'api/api_tournament/get';
$route["api/tournament"]['POST']                                         = 'api/api_tournament/insert';
$route["api/tournament/type"]['GET']                                     = 'api/api_tournament/get_type';
$route["api/tournament/($uuidRegex)/season"]['GET']                      = 'api/api_tournament/season/$1';
$route["api/tournament/($uuidRegex)/season/($uuidRegex)"]['GET']         = 'api/api_tournament/season/$1/$2';
$route["api/tournament/($uuidRegex)/season/($uuidRegex)"]['POST']        = 'api/api_tournament/update_season/$1/$2';
$route["api/tournament/season/($uuidRegex)"]['POST']                     = 'api/api_tournament/insert_season/$2';
$route["api/tournament/($uuidRegex)/season/($uuidRegex)/player"]['GET']  = 'api/api_tournament/player/$1/$2';
$route["api/tournament/($uuidRegex)/season/($uuidRegex)/player"]['POST'] = 'api/api_tournament/update_player/$1/$2';

$route["api/ranking/round"]['GET'] = 'api/api_ranking/get';

$route['cms'] = 'cms/snk_cms/index';
