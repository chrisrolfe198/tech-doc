<?php

namespace ThatChrisR\TechDocs\Renderer;

class Renderer
{
	public static function load_homepage()
	{
		echo "<h1>Homepage</h1>";
	}

	public static function load_page($page)
	{
		echo "This should be some form of template loaded in: ";
		echo $page;
		echo "This should be a footer";
	}
}
