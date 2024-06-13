<?php

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../vendor/autoload.php';



use DebugBar\StandardDebugBar;

// Initialize DebugBar instance
$debugbar = new StandardDebugBar();

// Optionally, configure collectors or add default messages here
// $debugbar['messages']->addMessage('DebugBar initialized.');

// Function to render DebugBar
function renderDebugBar() {
    global $debugbar;
    $renderer = $debugbar->getJavascriptRenderer();

    // Set base path for assets
    $renderer->setBaseUrl('/codetracker-php/vendor/maximebf/debugbar/src/DebugBar/Resources');

    echo $renderer->renderHead();
    echo $renderer->render();
}
