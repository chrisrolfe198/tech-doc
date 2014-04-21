<?php

namespace ThatChrisR\TechDocs;

use ThatChrisR\TechDocs\DocumentationLoader\DocumentationLoaderInterface;
use ThatChrisR\TechDocs\DocumentationLoader\FilesystemDocumentationLoader;
use ThatChrisR\TechDocs\Renderer\Renderer;

class Router
{
	
	const ROUTES_FILE = '/app/routes.php';
	
	protected static $projects;
	
	public function __construct(DocumentationLoaderInterface $documentation_loader)
	{
		$this->documentation_loader = $documentation_loader;
	}
	
	public static function add_routes(array $projects)
	{
		// checks if there are existing routes to allow multiple routes files
		if (is_array(static::$projects)) {
			$projects = array_merge($projects, static::$projects);
		}
		
		static::$projects = $projects;
	}
	
	public function load_route($query_params)
	{
		// Format the parameters passed in
		$query_params = $this->format_query_params($query_params);

		// Check if we are on the homepage
		if ($query_params == 'homepage') {
			// We have no parameters
			return Renderer::load_homepage();
		}
		// Check if we are on a project landing page
		// Finally check if we match a page inside a project
		if (isset($query_params['name']) && $this->is_a_valid_project($query_params['name'])) {
			// the project exists lets try and load it using the defined implementation
			$file = $this->documentation_loader->load($query_params);

			if ($file) {
				return Renderer::load_page(compact('file'));
			}
		}
		// redirect to 404 page
		return Renderer::four_oh_four();
	}
	
	private function is_a_valid_project($project_name)
	{
		if (static::$projects[$project_name]) {
			return true;
		}
		return false;
	}
	
	private function format_query_params($params)
	{
		$query_params = array();
		
		// If we have no parameters we want the homepage
		if (empty($params)) return 'homepage';

		// Otherwise try and get the project
		$project = static::$projects[$params[0]];
		if (!$project) return false;
		$query_params['name'] = $params[0];

		// Conditionally check the other parameters
		// TODO: refactor this
		$i = 1;
		if ($project['versions']) {
			$query_params['version'] = $params[$i];	
			$i++;
		}

		if ($project['lang']) {
			$query_params['lang'] = $params[$i];
			$i++;
		}

		$query_params['file'] = '';

		for ($i = $i; $i < (count($params) - 1); $i++ ) {
			$query_params['file'] .= $params[$i] . '/';
		}
		$query_params['file'] .= $params[$i++];

		return $query_params;
	}
}
