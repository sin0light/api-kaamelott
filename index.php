<?php
/**
 * API Kamelott
 * MVC API website using Klein.php as router.
 */


/**
 * Load composer packages and require controllers files.
 */
require 'vendor/autoload.php';
// Controllers' files
require_once 'controller/controllerUtils.php';



/**
 * Set environement.
 */
// Set local datetime
date_default_timezone_set('Europe/Paris');
// Create router
$router = new \Klein\Klein();


/**
 * Declare routes
 */

// Redirect to about page in french
$router->respond('GET', '/', $controllerHome);


// Catch errors
$router->onHttpError($controllerErrors);


// End of routing
$router->dispatch();
