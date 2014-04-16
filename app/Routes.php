<?php

use ThatChrisR\TechDocs\Router;

Router::add_routes(
	array(
		array(
			'name' => 'techdocs',
			'versions' => true,
			'lang' => array('en', 'de')
		)
	)
);
