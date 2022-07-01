<?php
/**
 * Display home page
 * @var Callable controllerHome
 * @route GET /
 */
$controllerHome = function($request, $response, $service, $app) {
	$service->render('view/viewHome.php');
};

/**
 * Display error page.
 * @var Callable controllerErrors
 */
$controllerErrors = function($code, $router, $response) {
	$return = new stdClass;
	$return->status = 0;
	$return->code = $code;

	switch ($code) {
		case 404:
			$return->error = "Unknown path.";
			break;
		
		default:
			$return->error = "Unknown error.";
			break;
	}

	header('Content-Type: application/json; charset=utf-8');
	echo(json_encode($return));
};

/**
 * MISC
 */
