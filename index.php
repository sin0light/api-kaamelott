<?php

require 'vendor/autoload.php';

$app = new Slim\App();

$app->get('/hello/{name}', function ($request, $response, $args) {
    return $response->write("Hello, " . $args['name']);
});

$app->run();

?>

<?php
// Including quotes file
include 'quotes.php';

// Getting personnage requested
if (isset($_POST['personnage'])) {
	$personnage = $_POST['personnage'];
} elseif ($_GET['personnage']) {
	$personnage = $_GET['personnage'];
}

if (isset($personnage)) {
	if (in_array($personnage, $onlyPersos)) {
		foreach ($haystackQuotes as $key => $value) {
			if ($value['infos']['personnage'] == $personnage) { $quotes[] = $value; }
		}
	} else {
		$err = 'Personnage introuvable.';
	}
} else {
	$quotes = $haystackQuotes;
}

// Getting mode requested
if (isset($_POST['mode'])) { $mode = $_POST['mode'];
} elseif (isset($_GET['mode'])) {
	$mode = $_GET['mode'];
} else {
	$mode = 1;
}
if ($mode < 0 || $mode > 4) { $err = 'Mode incoonu.'; }

// Printing result
if (isset($err)) {
	echo($err);
} else {
	switch ($mode) {
		case '1':
			echo(modeSimple($quotes));
			break;
		case '2':
			echo(modeComplete($quotes));
			break;
		case '3':
			echo(modeFull($quotes));
			break;
		
		default:
			echo('Error');
			break;
	}
}








// Functions for put in form the quote
function modeSimple($array) {
	$key = array_rand($array);
	if (!isset($array[$key]['infos']['personnage'])) { $array[$key]['infos']['personnage'] = 'Inconnu'; }
	return $array[$key]['citation'].' - '.$array[$key]['infos']['personnage'];
}

function modeComplete($array) {
	$key = array_rand($array);
	if (!isset($array[$key]['infos']['personnage'])) { $array[$key]['infos']['personnage'] = 'Inconnu'; }
	if (!isset($array[$key]['infos']['saison'])) { $array[$key]['infos']['saison'] = 'Inconnu'; }
	if (!isset($array[$key]['infos']['episode'])) { $array[$key]['infos']['episode'] = 'Inconnu'; }
	return $array[$key]['citation'].' - '.$array[$key]['infos']['personnage'].' - '.$array[$key]['infos']['saison'].', '.$array[$key]['infos']['episode'];
}

function modeFull($array) {
	$key = array_rand($array);
	if (!isset($array[$key]['infos']['personnage'])) { $array[$key]['infos']['personnage'] = 'Inconnu'; }
	if (!isset($array[$key]['infos']['acteur'])) { $array[$key]['infos']['acteur'] = 'Inconnu'; }
	if (!isset($array[$key]['infos']['saison'])) { $array[$key]['infos']['saison'] = 'Inconnu'; }
	if (!isset($array[$key]['infos']['episode'])) { $array[$key]['infos']['episode'] = 'Inconnu'; }
	if (!isset($array[$key]['infos']['auteur'])) { $array[$key]['infos']['auteur'] = 'Inconnu'; }
	return $array[$key]['citation'].' - '.$array[$key]['infos']['personnage'].' ('.$array[$key]['infos']['acteur'].') - '.$array[$key]['infos']['saison'].', '.$array[$key]['infos']['episode'].' ('.$array[$key]['infos']['auteur'].')';
}




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
