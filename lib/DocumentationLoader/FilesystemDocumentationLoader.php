<?php

namespace ThatChrisR\TechDocs\DocumentationLoader;

use Michelf\Markdown;

class FilesystemDocumentationLoader implements DocumentationLoaderInterface
{

	public static function four_oh_four()
	{
		$four_oh_four = file_get_contents('../app/layouts/404.md');
		echo Markdown::defaultTransform($four_oh_four);
	}
	
	public function load($project_details)
	{
		// Load in the file
		return $this->load_markdown_file($project_details);
		// Parse it
		// load up the page with it?
	}
	
	protected function load_markdown_file($project_details)
	{
		$project_url = '';
		foreach ($project_details as $detail) {
			$project_url .= '/' . $detail;
		}
		
		if ($file = file_get_contents("../docs/$project_url.md")) {
			return Markdown::defaultTransform($file);
		} else {
			return false;
		}	
	}
}
