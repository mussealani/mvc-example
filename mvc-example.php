<?php namespace MVC;
/**
 * Plugin Name: MVC Example
 * Description: Create WP plugins using MVC-pattern
 */

// define plugin path 
define('MVC_PLUGIN_PATH', __FILE__);

// classes to load
$classes = [
	'Register',
	'Router',
];

$instances = [];

foreach ($classes as $class) 
{
	require_once __DIR__ . '/classes/' . $class . '.php';

	// instantiate class
	$class_namespaced = __NAMESPACE__ . '\\' . $class;
	$instances[$class] = new $class_namespaced();
}
