<?php

use ThatChrisR\TechDocs\DocumentationLoader\FilesystemDocumentationLoader;

require '../vendor/autoload.php';
require '../lib/DocumentationLoader/DocumentationLoaderInterface.php';
require '../lib/DocumentationLoader/FilesystemDocumentationLoader.php';

$file = new FilesystemDocumentationLoader();

$query_params = explode('/', $_GET['vars']);

$file->load(array('name' => $query_params[0], 'version' => $query_params[1], 'lang' => $query_params[2]));