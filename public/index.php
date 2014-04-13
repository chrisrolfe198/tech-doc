<?php

use ThatChrisR\TechDocs\DocumentationLoader\FilesystemDocumentationLoader;

require '../vendor/autoload.php';

$file = new FilesystemDocumentationLoader();

$file->load(array('name' => 'techdocs', 'version' => 1, 'lang' => 'en'));