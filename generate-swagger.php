<?php

require 'vendor/autoload.php';

use OpenApi\Generator;

// Scan the src directory for annotations
$openapi = Generator::scan(['src']);

// Save the generated documentation to a JSON file
file_put_contents('swagger.json', $openapi->toJson());