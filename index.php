<?php
// Logging visits
function logVisit() {
	$connex = new PDO('pgsql:host=localhost;dbname=counter;port=4352', 'db_compteurs', '$^JWGSfsyVKVZK+R6c_e=HUpFfqqx^mfhv7rBykT3fa$z%r-VLbGq&=Eedy&yqR');
	if(filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {    
		$t = 4;
	} elseif (filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
		$t = 6;
	}
	$req = $connex->prepare('INSERT INTO VISITS (refsite, iptype, ip, date, time) VALUES (:s, :ipt, :i, :d, :t);');
	$req->execute(array(
		's' => 5,
		'ipt' => $t,
		'i' => $_SERVER['REMOTE_ADDR'],
		'd' => date('m/d/Y'),
		't' => date('G:i:s')
	));
}

logVisit();

// Slims' Ressources
require 'vendor/autoload.php';

// Kaamelott's lib
require 'lib/lib-kaamelott/kaamelott.class.php';
$kaamelott = new kaamelott;

// Create Your container
$c = new \Slim\Container();

// Override the default Not Found Handler
$c['notFoundHandler'] = function ($c) {
	return function ($request, $response) use ($c) {
		$return['status'] = 0;
		$return['error'] = 'Chemin inconnu';
		return $c['response']
			->withStatus(404)
			->withHeader('Content-Type', 'text/html')
			->write(json_encode($return));
	};
};

// Declaring the router
$app = new Slim\App($c);

// Home page
$app->get('/', function ($request, $response, $args) {
	return $response->write(file_get_contents('./home.html'));
});

// One random quote without filter
$app->map(['GET', 'POST'], '/api/random', function ($request, $response, $args) {
	global $kaamelott;
	return $response->write(json_encode($kaamelott->random()));
});

// One random quote from one designated season
$app->map(['GET', 'POST'], '/api/random/livre/{livre}', function ($request, $response, $args) {
	global $kaamelott;
	return $response->write(json_encode($kaamelott->randomLivre($args['livre'])));
});

// One random quote from one designated character
$app->map(['GET', 'POST'], '/api/random/personnage/{personnage}', function ($request, $response, $args) {
	global $kaamelott;
	return $response->write(json_encode($kaamelott->randomPersonnage($args['personnage'])));
});

// One random quote from one designated season and character
$app->map(['GET', 'POST'], '/api/random/livre/{livre}/personnage/{personnage}', function ($request, $response, $args) {
	global $kaamelott;
	return $response->write(json_encode($kaamelott->randomLivrePersonnage($args['livre'], $args['personnage'])));
});

// All the quotes without filter
$app->map(['GET', 'POST'], '/api/all', function ($request, $response, $args) {
	global $kaamelott;
	return $response->write(json_encode($kaamelott->all()));
});

// All the quotes from one designated season
$app->map(['GET', 'POST'], '/api/all/livre/{livre}', function ($request, $response, $args) {
	global $kaamelott;
	return $response->write(json_encode($kaamelott->allLivre($args['livre'])));
});

// All the quotes from one designated character
$app->map(['GET', 'POST'], '/api/all/personnage/{personnage}', function ($request, $response, $args) {
	global $kaamelott;
	return $response->write(json_encode($kaamelott->allPersonnage($args['personnage'])));
});

// All the quotes from one designated season and character
$app->map(['GET', 'POST'], '/api/all/livre/{livre}/personnage/{personnage}', function ($request, $response, $args) {
	global $kaamelott;
	return $response->write(json_encode($kaamelott->allLivrePersonnage($args['livre'], $args['personnage'])));
});

$app->run();

?>
