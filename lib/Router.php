<?php

namespace ThatChrisR\TechDocs;

use ThatChrisR\TechDocs\DocumentationLoader\DocumentationLoaderInterface;
use ThatChrisR\TechDocs\DocumentationLoader\FilesystemDocumentationLoader;

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
		// Check if we are on a project landing page
		// Finally check if we match a page inside a project
		if (isset($query_params['name']) && $this->is_a_valid_project($query_params['name'])) {
			// the project exists lets try and load it using the defined implementation
			$this->documentation_loader->load($query_params);
		}
		// redirect to 404 page
		FilesystemDocumentationLoader::four_oh_four();	
	}
	
	private function is_a_valid_project($project_name)
	{
		foreach (static::$projects as $project) {
			if ($project_name === $project['name']) {
				return true;
			}
		}
		return false;
	}
	
	private function format_query_params($params)
	{
		// this should read in config somewhere
		$query_params = array();

		if (!count($query_params) < 4) {
			$query_params['name'] = $params[0];
			$query_params['version'] = $params[1];
			$query_params['lang'] = $params[2];
			$query_params['file'] = $params[3];
		}
		
		return $query_params;
	}
}
