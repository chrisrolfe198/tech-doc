<?php

namespace ThatChrisR\TechDocs\Renderer;

use ThatChrisR\TechDocs\Router;
use ThatChrisR\TechDocs\Config\Config;

class Renderer
{
	public static function load_homepage()
	{
		static::load_page_with_template('../app/layouts/home.php');
	}

	public static function load_page($view_vars)
	{
		$config = new Config;
		$nav = Router::build_navigation();
		$left_nav = Router::build_side_navigation();
		foreach ($view_vars as $key => $val) {
			$this[$key] = $val;
		}
		require '../app/layouts/page.php';
	}

	public static function four_oh_four()
	{
		self::load_page_with_template('../app/layouts/404.php');
	}

	private static function load_page_with_template($file_url)
	{
		$config = new Config;
		$nav = Router::build_navigation();
		$left_nav = Router::build_side_navigation();
		$this['file'] = file_get_contents("$file_url");
		require '../app/layouts/page.php';
	}
}
