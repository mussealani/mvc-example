<?php namespace MVC;

class Router
{
	// site's title
	public $wp_title = 'MVC WordPress';

	// declare the main route name
	public $route = 'mvc-example';

	// declare the template dir
	public $temp_path;	

	function __construct()
	{
		// define template path
		$this->temp_path = plugin_dir_path( MVC_PLUGIN_PATH ) . '/templates/';

		add_action( 'init', [$this, 'rewrite_rules'] );

		// query each requset
		add_filter('request', [$this, 'rewrite_vars']);

		// include the template
		add_filter('template_include', [$this, 'include_template']);

		// custom page title with two args
		add_filter('wp_title', [$this, 'rewrite_title'], 10, 2);
	}

	public function include_template( $template )
	{
		// get query var
		$page_id = get_query_var( $this->route );

		// check if the route exists
		if (!$page_id) { return $template; }

		// if query var has data
		$template = $this->temp_path . 'mvc-temp.php';
		return $template;
	}

	/**
	 * adds a custom route for this plugin
	 */
	public function rewrite_rules()
	{
		add_rewrite_endpoint( $this->route, EP_ALL );
	}

	/**
	 * prevent false query var
	 */
	public function rewrite_vars($vars)
	{
		if (isset($vars[$this->route]) && !$vars[ $this->route ]) 
		{
			$vars[ $this->route ] = 'all';
		}
		return $vars;
	}

	public function rewrite_title($title, $sep)
	{
		$page_id = get_query_var( $this->route );

		// check the route
		if ($page_id) { return $title; }

		return $this->wp_title . $sep;
	}
}