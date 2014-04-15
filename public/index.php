<?php

use ThatChrisR\TechDocs\DocumentationLoader\FilesystemDocumentationLoader;
use ThatChrisR\TechDocs\Router;

require '../vendor/autoload.php';
require '../lib/DocumentationLoader/DocumentationLoaderInterface.php';
require '../lib/DocumentationLoader/FilesystemDocumentationLoader.php';

$file = new FilesystemDocumentationLoader();

$query_params = explode('/', $_GET['vars']);

$router = new Router($file);