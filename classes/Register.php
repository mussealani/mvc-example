<?php namespace MVC;

class Register
{
	
	function __construct()
	{
		register_activation_hook( MVC_PLUGIN_PATH, [ '\MVC\Register', 'activate' ] );
		register_activation_hook( MVC_PLUGIN_PATH, [ '\MVC\Register', 'uninstall' ] );
	}

	// activation HOOK
	public static function activate()
	{
		flush_rewrite_rules();
	}

	// deactivation HOOK
	public static function uninstall()
	{
		flush_rewrite_rules();
	}	
}