<?php

// Error reporting.
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);


// Application constants.
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('APP', ROOT.'application/');


// Load the needed files.
require APP.'/config.php';
require ROOT.'/vendor/autoload.php';


// Start the application.
use TDL\Core\Entrypoint;

$entrypoint = new Entrypoint();

?>