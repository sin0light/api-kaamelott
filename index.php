<?php
// Slims' Ressources
require 'vendor/autoload.php';

// Including quotes file
include 'quotes.php';

$router = new Slim\App();

$router->get('/hello/{name}', function ($request, $response, $args) {
	return $response->write("Hello, " . $args['name']);
});

$router->map(['GET', 'POST'], '/api/random[/{arg1}[/{arg2}]]', function ($request, $response, $args) {
	global $haystackQuotes;
	if (!empty($args['arg1']) && !empty($args['arg2'])) {
		$params = getParams1($args['arg1'], $args['arg2']);

		if (empty($params['error'])) {
			foreach ($haystackQuotes as $key => $value) {
				if ($value['infos']['personnage'] == $params['personnage'] && $value['infos']['saison'] == mapLivre($params['livre'])) {
					$quotes[] = $value;
				}
			}
			if (!empty($quotes)) {
				$return['status'] = 1;
				$return['citation'] = $quotes[array_rand($quotes)];
			} else {
				$return['status'] = 0;
				$return['error'] = 'Aucun resultat';
			}
		} else {
			$return['status'] = 0;
			$return['error'] = $params['error'];
		}

	} elseif (!empty($args['arg1'])) {

	} else {

	}




	// return $response->write(var_dump($haystackQuotes));
	// return $response->write(is_int($args['arg1']));
	return $response->write(json_encode($return));
});

$router->run();



function getParams1($first, $second) {
	global $onlyPersos;
	if (is_numeric($first)) {
		if (intval($first) > 0 && intval($first) < 7) {
			$ret['livre'] = $first;
		} else {
			$ret['error'][] = 'Saison inconnue.';
		}
	} elseif (is_string($first)) {
		if (in_array($first, $onlyPersos)) {
			$ret['personnage'] = $first;
		} else {
			$ret['error'][] = 'Personnage inconnu.';
		}
	} else {
		$ret['error'][] = 'Mauvais argument (1).';
	}

	if (is_numeric($second)) {
		if (intval($second) > 0 && intval($second) < 7) {
			$ret['livre'] = $second;
		} else {
			$ret['error'][] = 'Saison inconnue.';
		}
	} elseif (is_string($second)) {
		if (in_array($second, $onlyPersos)) {
			$ret['personnage'] = $second;
		} else {
			$ret['error'][] = 'Personnage inconnu.';
		}
	} else {
		$ret['error'][] = 'Mauvais argument (2).';
	}

	return $ret;
}


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




// echo('<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>');
// var_dump($haystackQuotes);

?>

<?php
// // Including quotes file
// include 'quotes.php';

// foreach ($haystackQuotes as $key => $value) {

// 	if ($value['infos']['saison'] == 'Livre I' || $value['infos']['saison'] == 'Livre II' || $value['infos']['saison'] == 'Livre II' || $value['infos']['saison'] == 'Livre IV' || $value['infos']['saison'] == 'Livre V' || $value['infos']['saison'] == 'Livre VI') {
// 		echo($value['citation'].'<br>');
// 	}
// }

// // Getting personnage requested
// if (isset($_POST['personnage'])) {
// 	$personnage = $_POST['personnage'];
// } elseif ($_GET['personnage']) {
// 	$personnage = $_GET['personnage'];
// }

// if (isset($personnage)) {
// 	if (in_array($personnage, $onlyPersos)) {
// 		foreach ($haystackQuotes as $key => $value) {
// 			if ($value['infos']['personnage'] == $personnage) { $quotes[] = $value; }
// 		}
// 	} else {
// 		$err = 'Personnage introuvable.';
// 	}
// } else {
// 	$quotes = $haystackQuotes;
// }

// // Getting mode requested
// if (isset($_POST['mode'])) { $mode = $_POST['mode'];
// } elseif (isset($_GET['mode'])) {
// 	$mode = $_GET['mode'];
// } else {
// 	$mode = 1;
// }
// if ($mode < 0 || $mode > 4) { $err = 'Mode incoonu.'; }

// // Printing result
// if (isset($err)) {
// 	echo($err);
// } else {
// 	switch ($mode) {
// 		case '1':
// 			echo(modeSimple($quotes));
// 			break;
// 		case '2':
// 			echo(modeComplete($quotes));
// 			break;
// 		case '3':
// 			echo(modeFull($quotes));
// 			break;
		
// 		default:
// 			echo('Error');
// 			break;
// 	}
// }








// // Functions for put in form the quote
// function modeSimple($array) {
// 	$key = array_rand($array);
// 	if (!isset($array[$key]['infos']['personnage'])) { $array[$key]['infos']['personnage'] = 'Inconnu'; }
// 	return $array[$key]['citation'].' - '.$array[$key]['infos']['personnage'];
// }

// function modeComplete($array) {
// 	$key = array_rand($array);
// 	if (!isset($array[$key]['infos']['personnage'])) { $array[$key]['infos']['personnage'] = 'Inconnu'; }
// 	if (!isset($array[$key]['infos']['saison'])) { $array[$key]['infos']['saison'] = 'Inconnu'; }
// 	if (!isset($array[$key]['infos']['episode'])) { $array[$key]['infos']['episode'] = 'Inconnu'; }
// 	return $array[$key]['citation'].' - '.$array[$key]['infos']['personnage'].' - '.$array[$key]['infos']['saison'].', '.$array[$key]['infos']['episode'];
// }

// function modeFull($array) {
// 	$key = array_rand($array);
// 	if (!isset($array[$key]['infos']['personnage'])) { $array[$key]['infos']['personnage'] = 'Inconnu'; }
// 	if (!isset($array[$key]['infos']['acteur'])) { $array[$key]['infos']['acteur'] = 'Inconnu'; }
// 	if (!isset($array[$key]['infos']['saison'])) { $array[$key]['infos']['saison'] = 'Inconnu'; }
// 	if (!isset($array[$key]['infos']['episode'])) { $array[$key]['infos']['episode'] = 'Inconnu'; }
// 	if (!isset($array[$key]['infos']['auteur'])) { $array[$key]['infos']['auteur'] = 'Inconnu'; }
// 	return $array[$key]['citation'].' - '.$array[$key]['infos']['personnage'].' ('.$array[$key]['infos']['acteur'].') - '.$array[$key]['infos']['saison'].', '.$array[$key]['infos']['episode'].' ('.$array[$key]['infos']['auteur'].')';
// }




// Process to get all the quotes in an array
// $once = explode('{{citation|citation=', $infos);

// foreach ($once as $keyOnce => $valueOnce) {
// 	$i = 1;
// 	foreach (explode('{{Réf Série', $valueOnce) as $keyCitation => $valueCitation) {
// 		if ($i%2 == 1) {
// 			$result[$keyOnce]['citation'] = substr($valueCitation, 0, -4);
// 		} else {
// 			foreach (explode('|', $valueCitation) as $keyInfo => $valueInfo) {
// 				$valueInfo = str_replace("'", "", $valueInfo);
// 				if (strpos($valueInfo, 'acteur') !== FALSE) {
// 					$result[$keyOnce]['infos']['acteur'] = substr($valueInfo, 7, -2);
// 					$result[$keyOnce]['infos']['personnage'] = $persos[$result[$keyOnce]['infos']['acteur']];
// 				} elseif (strpos($valueInfo, 'auteur') !== FALSE) {
// 					$result[$keyOnce]['infos']['auteur'] = substr($valueInfo, 7, -2);
// 				} elseif (strpos($valueInfo, 'serie') !== FALSE) {
// 					$result[$keyOnce]['infos']['serie'] = substr($valueInfo, 7, -2);
// 				} elseif (strpos($valueInfo, 'saison') !== FALSE) {
// 					$result[$keyOnce]['infos']['saison'] = substr($valueInfo, 7);
// 				} elseif (strpos($valueInfo, 'épisode') !== FALSE) {
// 					$result[$keyOnce]['infos']['episode'] = substr($valueInfo, 9, -6);
// 				}
// 			}
// 		}
// 		$i++;
// 	}
// }


// Output php array
// echo('[');
// foreach ($result as $key => $value) {
// 	echo($key.' => [
// 			\'citation\' => \''.$value['citation'].'\',
// 		');
// 		if (isset($value['infos']['serie'])) {
// 			echo('\'serie\' => \''.$value['infos']['serie'].'\',
// 			');
// 		}
// 		if (isset($value['infos']['saison'])) {
// 			echo('\'saison\' => \''.$value['infos']['saison'].'\',
// 			');
// 		}
// 		if (isset($value['infos']['episode'])) {
// 			echo('\'episode\' => \''.$value['infos']['episode'].'\',
// 			');
// 		}
// 		if (isset($value['infos']['auteur'])) {
// 			echo('\'auteur\' => \''.$value['infos']['auteur'].'\',
// 			');
// 		}
// 		if (isset($value['infos']['acteur'])) {
// 			echo('\'acteur\' => \''.$value['infos']['acteur'].'\',
// 			');
// 		}
// 		if (isset($value['infos']['personnage'])) {
// 			echo('\'personnage\' => \''.$value['infos']['personnage'].'\',
// 			');
// 		}
// 		echo(']');
// }
// echo(']');


// Output all the quotes
// foreach ($result as $key => $value) {
// 	echo($value['citation'].'<br>');
// 	foreach ($value['infos'] as $key2 => $value2) {
// 		echo('&nbsp;&nbsp;&nbsp;'.$value2.'<br>');
// 	}
// 	echo('<br> <br>');
// }






?>
