<?php

namespace ThatChrisR\TechDocs\DirScan;

use \DirectoryIterator;

class DirScan
{
	private $files = [];
	private $folders = [];
	private $dir;

	public function __construct($dir)
	{
		$this->dir = $dir;
		$this->scan_dir($dir);
	}
	public function map_position()
	{
		// Show every file and dir at the top level
		$files = $this->files['/'];
		// preg_grep
		// Show every file and dir one level down?
	}

	public function get_files()
	{
		return $this->files;
	}

	public function get_folders()
	{
		return $this->folders;
	}

	private function scan_dir($dir_string, $url_base = '/')
	{
		// Create the empty arrays to populate
		// if (!isset($this->files[$url_base])) $this->files[$url_base] = array();
		// if (!isset($this->folders[$url_base])) $this->folders[$url_base] = array();

		// Loop over the directories recursively and build the arrays
		foreach (new DirectoryIterator($dir_string) as $file) {
			if ($file->isDot()) continue;
			if ($file->isDir()) {
				array_push($this->folders, $file->getFilename());
				continue;
			}
			array_push($this->files, substr($file->getFilename(), 0, -3));
		}
	}
}
