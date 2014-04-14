<?php

namespace ThatChrisR\TechDocs;

use ThatChrisR\TechDocs\DocumentationLoader\DocumentationLoaderInterface;

class Router
{
	
	const ROUTES_FILE = '/app/routes.php';
	
	protected static $projects;
	
	public function __construct(DocumentationLoaderInterface $documentation_loader)
	{
		$this->documentation_loader = $documentation_loader;
	}
	
	public static add_routes(array $projects)
	{
		// checks if there are existing routes to allow multiple routes files
		if (is_array(static::$projects)) {
			$projects = array_merge($projects, static::$projects);
		}
		
		static::$projects = $projects;
	}
	
	public function load_route($query_params)
	{
		// high level stuff here
		// check the route params project item matches a known project
		if ($this->is_a_valid_project($query_params['project'])) {
			// the project exists lets try and load it using the defined implementation
			$this->documentation_loader->load($query_params);
		}
		// redirect to 404 page
	}
	
	private function is_a_valid_project($project_name)
	{
		foreach (static::$projects as $project) {
			if ($project_name === $project['name']) {
				return true;
			}
		}
		return false
	}
}