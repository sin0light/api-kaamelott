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
require_once 'controller/controllerAPI.php';


/**
 * Set environement.
 */
// Start PHP sessions
session_start();
// Set local datetime
date_default_timezone_set('Europe/Paris');
// Create router
$router = new \Klein\Klein();
// Define applications to be used from any controller
$router->respond(function ($request, $response, $service, $app) {
	$app->register('db', function() {
        // Config file
        include('config.php');
		
        return new \DataManagement\DataManagement('pgsql', $database['host'], $database['port'], $database['dbname'], $database['user'], $database['password']);
	});
});


/**
 * Declare routes
 */

// Redirect to about page in french
$router->respond('GET', '/', $controllerHome);

// API calls
// Random quotes
$router->respond('GET', '/api/random', $controllerRandom);
// By character
$router->respond('GET', '/api/random/personnage/[:character]', $controllerRandomCharacter);
// By season
$router->respond('GET', '/api/random/livre/[i:season]', $controllerRandomSeason);
// By season and character
$router->respond('GET', '/api/random/livre/[i:season]/personnage/[:character]', $controllerRandomSeasonCharacter);

// All quotes
$router->respond('GET', '/api/all', $controllerAll);
// By character
$router->respond('GET', '/api/all/personnage/[:character]', $controllerAllCharacter);
// By season
$router->respond('GET', '/api/all/livre/[i:season]', $controllerAllSeason);
// By season and character
$router->respond('GET', '/api/all/livre/[i:season]/personnage/[:character]', $controllerAllSeasonCharacter);

// Others
// Get all characters
$router->respond('GET', '/api/personnage/all', $controllerCharactersAll);
// Get all authors
$router->respond('GET', '/api/authors/all', $controllerAuthorsAll);


// Sounds
$router->respond('GET', '/api/sounds/[:filename]', $controllerSounds);


// Catch errors
$router->onHttpError($controllerErrors);


// End of routing
$router->dispatch();
