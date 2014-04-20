<?php

use ThatChrisR\TechDocs\Router;

Router::add_routes(
	array(
		'techdocs' => array(
			'versions' => true,
			'lang' => array('en', 'de')
		),
		'common' => array(
			'versions' => false,
			'lang' => false
		)
	)
);
