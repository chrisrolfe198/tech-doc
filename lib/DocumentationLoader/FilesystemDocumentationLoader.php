<?php

namespace ThatChrisR\TechDocs\DocumentationLoader;

use Michelf\Markdown;

class FilesystemDocumentationLoader implements DocumentationLoaderInterface
{
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
			return false;
		}	
	}
}