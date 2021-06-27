<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'Auth/login';
$route['logout'] = 'Auth/logout';



$route['home'] = 'MainController/home';

$route['employees'] 				= 'MainController/employees';
$route['manage-team'] 				= 'MainController/manageteam';
$route['addemployees'] 				= 'MainController/addemployees';
$route['editemployees'] 			= 'MainController/editemployees';
$route['updateemployees'] 			= 'MainController/updateemployees';
$route['statusemployees'] 			= 'MainController/statusemployees';
$route['deleteemployees/(:any)'] 	= 'MainController/deleteemployees/$1';
$route['employee-profile/(:any)'] 	= 'MainController/employee_profile/$1';


$route['projects'] 					= 'MainController/projects';
$route['addprojects'] 				= 'MainController/addprojects';
$route['editprojects'] 				= 'MainController/editprojects';
$route['updateprojects'] 			= 'MainController/updateprojects';
$route['statusprojects'] 			= 'MainController/statusprojects';
$route['deleteprojects/(:any)'] 	= 'MainController/deleteprojects/$1';