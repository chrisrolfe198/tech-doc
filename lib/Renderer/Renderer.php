<?php

namespace ThatChrisR\TechDocs\Renderer;

class Renderer
{
	public static function load_homepage()
	{
		echo "<h1>Homepage</h1>";
	}

	public static function load_page($view_vars)
	{
		foreach ($view_vars as $key => $val) {
			$this[$key] = $val;
		}
		require '../app/layouts/page.php';
	}
}
