<?php

use ThatChrisR\TechDocs\Router;

Router::add_routes(
	array(
		array(
			'project' => 'TechDocs',
			'versions' => true,
			'lang' => array('en', 'de')
		)
	)
);