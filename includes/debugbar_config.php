<?php
// debugbar_config.php

require_once 'vendor/autoload.php'; // Adjust the path as per your project structure

use DebugBar\StandardDebugBar;

// Determine the base URL dynamically
$base_url = rtrim(dirname($_SERVER['PHP_SELF']), '/');

// Initialize DebugBar
$debugbar = new StandardDebugBar();
$debugbarRenderer = $debugbar->getJavascriptRenderer();
$debugbarRenderer->setBaseUrl($base_url . '/vendor/maximebf/debugbar/src/DebugBar/Resources');


?>