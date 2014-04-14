<?php

use ThatChrisR\TechDocs\DocumentationLoader\FilesystemDocumentationLoader;

require '../vendor/autoload.php';
require '../lib/DocumentationLoader/DocumentationLoaderInterface.php';
require '../lib/DocumentationLoader/FilesystemDocumentationLoader.php';

$file = new FilesystemDocumentationLoader();

$file->load(array('name' => 'techdocs', 'version' => 1, 'lang' => 'en'));
