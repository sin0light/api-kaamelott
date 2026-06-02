<?php
/**
 * API Kamelott
 * MVC API website using Klein.php as router.
 */


/**
 * Load composer packages and require controllers files.
 */
require 'vendor/autoload.php';
$config = require __DIR__ . '/config.php';

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
$router->respond(function ($request, $response, $service, $app) use ($config) {
	$app->register('db', function() use ($config) {
		return new \DataManagement\DataManagement(
			$config['db_driver'],
			$config['db_host'],
			$config['db_port'],
			$config['db_name'],
			$config['db_user'],
			$config['db_password']
		);
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
// By author
$router->respond('GET', '/api/random/auteur/[:author]', $controllerRandomAuthor);
// By season
$router->respond('GET', '/api/random/livre/[i:season]', $controllerRandomSeason);
// By season and character
$router->respond('GET', '/api/random/livre/[i:season]/personnage/[:character]', $controllerRandomSeasonCharacter);

// All quotes
$router->respond('GET', '/api/all', $controllerAll);
// By character
$router->respond('GET', '/api/all/personnage/[:character]', $controllerAllCharacter);
// By author
$router->respond('GET', '/api/all/auteur/[:author]', $controllerAllAuthor);
// By season
$router->respond('GET', '/api/all/livre/[i:season]', $controllerAllSeason);
// By season and character
$router->respond('GET', '/api/all/livre/[i:season]/personnage/[:character]', $controllerAllSeasonCharacter);

// Others
// Get a character's picture
$router->respond('GET', '/api/personnage/[:character]/pic', $controllerCharacterPic);
// Get all characters
$router->respond('GET', '/api/personnage/all', $controllerCharactersAll);
// Get all authors
$router->respond('GET', '/api/auteur/all', $controllerAuthorsAll);


// Sounds
$router->respond('GET', '/api/sounds/[:filename]', $controllerSounds);


// Catch errors
$router->onHttpError($controllerErrors);


// End of routing
$router->dispatch();
