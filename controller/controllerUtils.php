<?php
/**
 * Display home page
 * @var Callable controllerHome
 * @route GET /
 */
$controllerHome = function ($request, $response, $service, $app) {
	$service->render('view/viewHome.php');
};


/**
 * Display error page.
 * @var Callable controllerErrors
 */
$controllerErrors = function ($code, $router) {
	// TODO
};



/**
 * MISC
 */

