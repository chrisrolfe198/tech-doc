<?php

namespace ThatChrisR\TechDocs\DocumentationLoader;

use Michelf\Markdown;

class FilesystemDocumentationLoader implements DocumentationLoaderInterface
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
	
	public static function 404()
	{
		$404 = file_get_contents('../app/layouts/404.md');
		echo Markdown::defaultTransform($404);
	}
	
	public function load($project_details)
	{
		// Load in the file
		$this->load_markdown_file($project_details);
		// Parse it
		// load up the page with it?
	}
	
	protected function load_markdown_file($project_details)
	{
		$project = $project_details['name'];
		$version = $project_details['version'];
		$lang = $project_details['lang'];
		$file = $project_details['file'];
		
		if ($file = file_get_contents("../docs/$project/$version/$lang/$file.md")) {
			echo Markdown::defaultTransform($file);
		} else {
			// redirect to a 404
			self::404();
		}	
	}
}