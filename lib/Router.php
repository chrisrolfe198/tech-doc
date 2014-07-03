<?php

namespace ThatChrisR\TechDocs;

use ThatChrisR\TechDocs\DocumentationLoader\DocumentationLoaderInterface;
use ThatChrisR\TechDocs\DocumentationLoader\FilesystemDocumentationLoader;
use ThatChrisR\TechDocs\Renderer\Renderer;
use ThatChrisR\TechDocs\DirScan\DirScan;

class Router
{
	
	const ROUTES_FILE = '/app/routes.php';
	
	protected static $projects;
	protected static $query_params;
	
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
		static::$query_params = $query_params;
		$this->format_query_params();

		// Check if we are on the homepage
		if (static::$query_params == 'homepage') {
			// We have no parameters
			return Renderer::load_homepage();
		}
		// Check if we are on a project landing page
		// Finally check if we match a page inside a project
		if (isset(static::$query_params['name']) && $this->is_a_valid_project(static::$query_params['name'])) {
			// the project exists lets try and load it using the defined implementation
			$file = $this->documentation_loader->load(static::$query_params);

			if ($file) {
				return Renderer::load_page(compact('file'));
			}
		}
		// redirect to 404 page
		return Renderer::four_oh_four();
	}

	public static function build_navigation()
	{
		$nav = [];
		foreach (static::$projects as $project_name => $project) {
			// techdocs/1.1/en/index
			$url = '/'.$project_name;

			if ($project['versions']) {
				$scan = new DirScan('../docs/'.$url);

				$scan = $scan->get_files();

				$highest = 0;

				foreach ($scan as $item) {
					if ($item > $highest) {
						$highest = $item;
					}
				}

				$url .= '/'.$highest;
			}

			if (isset($project['lang']) and $lang = $project['lang']) {
				$url .= '/'.$lang[0];
			}

			$url .= '/index';

			$nav[$project_name] = $url;
		}

		return $nav;
	}

	public static function build_side_navigation()
	{
		if (!is_array(static::$query_params)) return false;
		
		$project_url = '';
		foreach (static::$query_params as $key => $detail) {
			$project_url .= '/' . $detail;
		}

		preg_match("/(.*)\/.*$/", $project_url, $regex);

		$scan = new DirScan("../docs" . $regex[1]);

		return $scan->get_files();
	}
	
	private function is_a_valid_project($project_name)
	{
		if (static::$projects[$project_name]) {
			return true;
		}
		return false;
	}
	
	private function format_query_params()
	{
		$params = static::$query_params;
		$query_params = [];

		// If we have no parameters we want the homepage
		if (empty($params)) return static::$query_params = 'homepage';

		// Otherwise try and get the project
		$project = static::$projects[$params[0]];
		if (!$project) return false;
		$query_params['name'] = $params[0];

		// Conditionally check the other parameters
		// TODO: refactor this
		$i = 1;
		if (isset($project['versions'])) {
			$query_params['version'] = $params[$i];	
			$i++;
		}

		if (isset($project['lang'])) {
			$query_params['lang'] = $params[$i];
			$i++;
		}

		$query_params['file'] = '';

		for ($i = $i; $i < (count($params) - 1); $i++ ) {
			$query_params['file'] .= $params[$i] . '/';
		}
		$query_params['file'] .= $params[$i++];

		static::$query_params = $query_params;
	}
}
