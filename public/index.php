<?php

use ThatChrisR\TechDocs\DocumentationLoader\FilesystemDocumentationLoader;
use ThatChrisR\TechDocs\DirIterator\DirIterator;
use ThatChrisR\TechDocs\Router;

require '../vendor/autoload.php';
//require '../lib/DirIterator/DirIterator.php';

// $iterator = new DirIterator('../docs/techdocs/');
try {
	// $iterator->isDir();
} catch(Exception $e) {
	echo $e->getMessage();
}

// satisfy the dependencies for the router
$file = new FilesystemDocumentationLoader();
$router = new Router($file);

// load in some documentation
$query_params = false;
if (!empty($_GET['vars'])) {
	$query_params = explode('/', $_GET['vars']);
}
$router->load_route($query_params);
