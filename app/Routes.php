<?php

use ThatChrisR\TechDocs\Router;

Router::add_routes(
	array(
		array(
			'name' => 'TechDocs',
			'versions' => true,
			'lang' => array('en', 'de')
		)
	)
);