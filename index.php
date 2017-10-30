<?php
// Slims' Ressources
require 'vendor/autoload.php';

// Including quotes file
include 'quotes.php';

// Declaring the router
$app = new Slim\App();

// Home page
$app->get('/', function ($request, $response, $args) {
	return $response->write(file_get_contents('./home.html'));
});

// One random quote without filter
$app->map(['GET', 'POST'], '/api/random', function ($request, $response, $args) {
	global $haystackQuotes;
	$return['status'] = 1;
	$return['citation'] = $haystackQuotes[array_rand($haystackQuotes)];
	// Printing the answer in JSON format
	return $response->write(json_encode($return));
});

// One random quote from one designated season
$app->map(['GET', 'POST'], '/api/random/livre/{livre}', function ($request, $response, $args) {
	global $haystackQuotes;
	if ($args['livre'] > 0 && $args['livre'] < 7) {
		foreach ($haystackQuotes as $key => $value) {
			if ($value['infos']['saison'] == mapLivre($args['livre'])) {
				$quotes[] = $value;
			}
		}
		// Creating the result
		if (!empty($quotes)) {
			$return['status'] = 1;
			$return['citation'] = $quotes[array_rand($quotes)];
		} else {
			$return['status'] = 0;
			$return['error'] = 'Aucun resultat';
		}
	} else {
		$return['status'] = 0;
		$return['error'] = 'Livre inconnu.';
	}
	// Printing the answer in JSON format
	return $response->write(json_encode($return));
});

// One random quote from one designated character
$app->map(['GET', 'POST'], '/api/random/personnage/{personnage}', function ($request, $response, $args) {
	global $haystackQuotes;
	global $onlyPersos;
	if (in_array(strtolower($args['personnage']), $onlyPersos)) {
		foreach ($haystackQuotes as $key => $value) {
			if (strtolower($value['infos']['personnage']) == strtolower($args['personnage'])) {
				$quotes[] = $value;
			}
		}
		// Creating the result
		if (!empty($quotes)) {
			$return['status'] = 1;
			$return['citation'] = $quotes[array_rand($quotes)];
		} else {
			$return['status'] = 0;
			$return['error'] = 'Aucun resultat';
		}
	} else {
		$return['status'] = 0;
		$return['error'] = 'Personnage inconnu.';
	}
	// Printing the answer in JSON format
	return $response->write(json_encode($return));
});

// One random quote from one designated season and character
$app->map(['GET', 'POST'], '/api/random/livre/{livre}/personnage/{personnage}', function ($request, $response, $args) {
	global $haystackQuotes;
	global $onlyPersos;
	if (in_array(strtolower($args['personnage']), $onlyPersos)) {
		if ($args['livre'] > 0 && $args['livre'] < 7) {
			foreach ($haystackQuotes as $key => $value) {
				if (strtolower($value['infos']['personnage']) == strtolower($args['personnage']) && $value['infos']['saison'] == mapLivre($args['livre'])) {
					$quotes[] = $value;
				}
			}
			// Creating the result
			if (!empty($quotes)) {
				$return['status'] = 1;
				$return['citation'] = $quotes[array_rand($quotes)];
			} else {
				$return['status'] = 0;
				$return['error'] = 'Aucun resultat';
			}
		} else {
			$return['status'] = 0;
			$return['error'] = 'Livre inconnu.';
		}
	} else {
		$return['status'] = 0;
		$return['error'] = 'Personnage inconnu.';
	}
	// Printing the answer in JSON format
	return $response->write(json_encode($return));
});

// All the quotes without filter
$app->map(['GET', 'POST'], '/api/all', function ($request, $response, $args) {
	global $haystackQuotes;
	$return['status'] = 1;
	$return['citation'] = $haystackQuotes;
	// Printing the answer in JSON format
	return $response->write(json_encode($return));
});

// All the quotes from one designated season
$app->map(['GET', 'POST'], '/api/all/livre/{livre}', function ($request, $response, $args) {
	global $haystackQuotes;
	if ($args['livre'] > 0 && $args['livre'] < 7) {
		foreach ($haystackQuotes as $key => $value) {
			if ($value['infos']['saison'] == mapLivre($args['livre'])) {
				$quotes[] = $value;
			}
		}
		// Creating the result
		if (!empty($quotes)) {
			$return['status'] = 1;
			$return['citation'] = $quotes;
		} else {
			$return['status'] = 0;
			$return['error'] = 'Aucun resultat';
		}
	} else {
		$return['status'] = 0;
		$return['error'] = 'Livre inconnu.';
	}
	// Printing the answer in JSON format
	return $response->write(json_encode($return));
});

// All the quotes from one designated character
$app->map(['GET', 'POST'], '/api/all/personnage/{personnage}', function ($request, $response, $args) {
	global $haystackQuotes;
	global $onlyPersos;
	if (in_array(strtolower($args['personnage']), $onlyPersos)) {
		foreach ($haystackQuotes as $key => $value) {
			if (strtolower($value['infos']['personnage']) == strtolower($args['personnage'])) {
				$quotes[] = $value;
			}
		}
		// Creating the result
		if (!empty($quotes)) {
			$return['status'] = 1;
			$return['citation'] = $quotes;
		} else {
			$return['status'] = 0;
			$return['error'] = 'Aucun resultat';
		}
	} else {
		$return['status'] = 0;
		$return['error'] = 'Personnage inconnu.';
	}
	// Printing the answer in JSON format
	return $response->write(json_encode($return));
});

// All the quotes from one designated season and character
$app->map(['GET', 'POST'], '/api/all/livre/{livre}/personnage/{personnage}', function ($request, $response, $args) {
	global $haystackQuotes;
	global $onlyPersos;
	if (in_array(strtolower($args['personnage']), $onlyPersos)) {
		if ($args['livre'] > 0 && $args['livre'] < 7) {
			foreach ($haystackQuotes as $key => $value) {
				if (strtolower($value['infos']['personnage']) == strtolower($args['personnage']) && $value['infos']['saison'] == mapLivre($args['livre'])) {
					$quotes[] = $value;
				}
			}
			// Creating the result
			if (!empty($quotes)) {
				$return['status'] = 1;
				$return['citation'] = $quotes;
			} else {
				$return['status'] = 0;
				$return['error'] = 'Aucun resultat';
			}
		} else {
			$return['status'] = 0;
			$return['error'] = 'Livre inconnu.';
		}
	} else {
		$return['status'] = 0;
		$return['error'] = 'Personnage inconnu.';
	}
	// Printing the answer in JSON format
	return $response->write(json_encode($return));
});

$app->run();


// Functions

function mapLivre($n) {
	switch ($n) {
		case '1':
			return 'Livre I ';
			break;
		case '2':
			return 'Livre II ';
			break;
		case '3':
			return 'Livre III ';
			break;
		case '4':
			return 'Livre IV ';
			break;
		case '5':
			return 'Livre V ';
			break;
		case '6':
			return 'Livre VI ';
			break;
		default:
			return false;
			break;
	}
}


// OLD VERSION

// Random quotes with or without a season or a character wanted
// $app->map(['GET', 'POST'], '/api/{mode}[/{arg1}[/{arg2}]]', function ($request, $response, $args) {
// 	if ($args['mode'] == 'random' || $args['mode'] == 'all') {
// 		global $haystackQuotes;
// 		// With a season and a character
// 		if (!empty($args['arg1']) && !empty($args['arg2'])) {
// 			$params = getParams1($args['arg1'], $args['arg2']);
// 			// Checking if the given args are correct
// 			if (empty($params['error'])) {
// 				// Creating the array with all possibles quotes
// 				foreach ($haystackQuotes as $key => $value) {
// 					if ($value['infos']['personnage'] == $params['personnage'] && $value['infos']['saison'] == mapLivre($params['livre'])) {
// 						$quotes[] = $value;
// 					}
// 				}
// 				// Creating the result
// 				if (!empty($quotes)) {
// 					$return['status'] = 1;
// 					// If mode random then get only one quote, else if it's all mode get all the quotes 
// 					if ($args['mode'] == 'random') {
// 						$return['citation'] = $quotes[array_rand($quotes)];
// 					} else {
// 						$return['citations'] = $quotes;
// 					}
// 				} else {
// 					$return['status'] = 0;
// 					$return['error'] = 'Aucun resultat';
// 				}
// 			} else {
// 				$return['status'] = 0;
// 				$return['error'] = $params['error'];
// 			}

// 		// With a season or a character wanted
// 		} elseif (!empty($args['arg1'])) {
// 			$params = getParams2($args['arg1']);
// 			// Checking if the given arg is correct
// 			if (empty($params['error'])) {
// 				// If the arg is a season
// 				if (!empty($params['livre'])) {
// 					foreach ($haystackQuotes as $key => $value) {
// 						if ($value['infos']['saison'] == mapLivre($params['livre'])) {
// 							$quotes[] = $value;
// 						}
// 					}
// 				// If the arg is a character
// 				} elseif (!empty($params['personnage'])) {
// 					// Creating the array with all possibles quotes
// 					foreach ($haystackQuotes as $key => $value) {
// 						if ($value['infos']['personnage'] == $params['personnage']) {
// 							$quotes[] = $value;
// 						}
// 					}
// 				}
// 				// Creating the result
// 				if (!empty($quotes)) {
// 					$return['status'] = 1;
// 					// If mode random then get only one quote, else if it's all mode get all the quotes 
// 					if ($args['mode'] == 'random') {
// 						$return['citation'] = $quotes[array_rand($quotes)];
// 					} else {
// 						$return['citations'] = $quotes;
// 					}
// 				} else {
// 					$return['status'] = 0;
// 					$return['error'] = 'Aucun resultat';
// 				}
// 			} else {
// 				$return['status'] = 0;
// 				$return['error'] = $params['error'];
// 			}

// 		// With nothing wanted, only a random quote
// 		} else {
// 			// Getting a random quotes without argument
// 			$return['status'] = 1;
// 			// If mode random then get only one quote, else if it's all mode get all the quotes 
// 			if ($args['mode'] == 'random') {
// 				$return['citation'] = $haystackQuotes[array_rand($haystackQuotes)];
// 			} else {
// 				$return['citations'] = $haystackQuotes;
// 			}
// 		}
// 	} else {
// 		$return['status'] = 0;
// 		$return['error'] = 'Mode de citation incorrect ("random" ou "all").';
// 	}

// 	// Printing the answer in JSON format
// 	return $response->write(json_encode($return));
// });


// Functions

// function getParams1($first, $second) {
// 	global $onlyPersos;
// 	if (is_numeric($first)) {
// 		if (intval($first) > 0 && intval($first) < 7) {
// 			$ret['livre'] = $first;
// 		} else {
// 			$ret['error'][] = 'Saison inconnue.';
// 		}
// 	} elseif (is_string($first)) {
// 		if (in_array($first, $onlyPersos)) {
// 			$ret['personnage'] = $first;
// 		} else {
// 			$ret['error'][] = 'Personnage inconnu.';
// 		}
// 	} else {
// 		$ret['error'][] = 'Mauvais argument (1).';
// 	}

// 	if (is_numeric($second)) {
// 		if (intval($second) > 0 && intval($second) < 7) {
// 			$ret['livre'] = $second;
// 		} else {
// 			$ret['error'][] = 'Saison inconnue.';
// 		}
// 	} elseif (is_string($second)) {
// 		if (in_array($second, $onlyPersos)) {
// 			$ret['personnage'] = $second;
// 		} else {
// 			$ret['error'][] = 'Personnage inconnu.';
// 		}
// 	} else {
// 		$ret['error'][] = 'Mauvais argument (2).';
// 	}

// 	return $ret;
// }

// function getParams2($first) {
// 	global $onlyPersos;
// 	if (is_numeric($first)) {
// 		if (intval($first) > 0 && intval($first) < 7) {
// 			$ret['livre'] = $first;
// 		} else {
// 			$ret['error'] = 'Saison inconnue.';
// 		}
// 	} elseif (is_string($first)) {
// 		if (in_array($first, $onlyPersos)) {
// 			$ret['personnage'] = $first;
// 		} else {
// 			$ret['error'] = 'Personnage inconnu.';
// 		}
// 	} else {
// 		$ret['error'] = 'Mauvais argument (1).';
// 	}

// 	return $ret;
// }

?>
