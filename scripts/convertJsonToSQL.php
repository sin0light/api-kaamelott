<?php
/*
	Script to transform JSON quotes to SQL instructions
 */

// Import JSON file
$content = file_get_contents('../assets/quotes.json');
$content = json_decode($content, JSON_OBJECT_AS_ARRAY);

// Function to escape simple quotes in SQL instructions
function escapeSQuotes($text) {
	return str_replace("'", "''", $text);
}

// Declare all characters
$characters = [
	'Vanessa Guedj' => 'Angharad',
	'Anouk Grinberg' => 'Anna',
	'Emmanuel Meirieu' => 'Appius Manilius',
	'Alexandre Astier' => 'Arthur',
	'Lan Truong' => 'Attila',
	'François Morel' => 'Belt',
	'Jean-Robert Lombard' => 'Père Blaise',
	'Nicolas Gabion' => 'Bohort',
	'Yvan le Bolloc\'h' => 'Breccan',
	'Guillaume Briat' => 'Le Roi Burgonde',
	'Bruno Salomone' => 'Caius Camillus',
	'Stéphane Margot' => 'Calogrenant',
	'François Levantal' => 'Capito',
	'Pierre Mondy' => 'César',
	'Claire Nadeau' => 'Cryda de Tintagel',
	'Antoine de Caunes' => 'Dagonet',
	'Audrey Fleurot' => 'La Dame du Lac',
	'Caroline Pascal' => 'Demetra',
	'Anne Benoît' => 'Drusilla',
	'Alain Chabat' => 'Le Duc d\'Aquitaine',
	'Émilie Dequenne' => 'Edern',
	'Bruno Fontaine' => 'Elias de Kelliwic\'h',
	'Alexis Hénon' => 'Galessin',
	'Aurélien Portehaut' => 'Gauvain',
	'Philippe Nahon' => 'Goustan',
	'Thibault Roux' => 'Grüdü',
	'Anne Girouard' => 'Guenièvre',
	'Serge Papagalli' => 'Guethenoc',
	'Tony Saba' => 'Hervé de Rinel',
	'Loránt Deutsch' => 'L\'interprète burgonde',
	'Georges Beller' => 'Le Seigneur Jacca',
	'Alexandra Saadoun et Magali Saadoun' => 'Les Jumelles du pêcheur',
	'Christian Clavier' => 'Le Jurisconsulte',
	'Brice Fournier' => 'Kadoc',
	'Jean-Christophe Hembert' => 'Karadoc',
	'Thomas Cousseau' => 'Lancelot',
	'Lionnel Astier' => 'Léodagan',
	'François Rollin' => 'Loth',
	'Christian Bujeau' => 'Le Maître d\'Armes',
	'Carlo Brandt' => 'Méléagant',
	'Tcheky Karyo' => 'Manius Macrinus Firmus',
	'Jacques Chambon' => 'Merlin',
	'Caroline Ferrus' => 'Mevanwi',
	'Franck Pitiot' => 'Perceval',
	'Gilles Graveleau' => 'Roparzh',
	'Patrick Chesnais' => 'Lucius Sillius Sallustius',
	'Axelle Laffont' => 'Séfriane d\'Aquitaine',
	'Joëlle Sevilla' => 'Séli',
	'Pascal Demolon' => 'Spurius Cordius Frontinius',
	'Alain Chapuis' => 'Le Tavernier',
	'Pascal Vincent' => 'Urgan',
	'Manu Payet' => 'Vérinus',
	'Loïc Varraut' => 'Venec',
	'Josée Drevon' => 'Ygerne',
	'Simon Astier' => 'Yvain'
];

// Seasons
$done = [];
$idSeason = [];
$i = 1;
foreach ($content as $key => $value) {
	if (!in_array($value['season'], $done)) {
		echo('INSERT INTO SEASONS (seasons_name, seasons_num) VALUES (\''.$value['season'].'\', 1);
');
		$idSeason[$value['season']] = $i;
		$i++;
		$done[] = $value['season'];
	}
}

// Actors
$done = [];
$idActors = [];
$i = 1;
foreach ($content as $key => $value) {
	if (!in_array($value['actor'], $done)) {
		echo('INSERT INTO ACTORS (actors_name) VALUES (\''.escapeSQuotes($value['actor']).'\');
');
		$idActors[$value['actor']] = $i;
		$i++;
		$done[] = $value['actor'];
	}
}

// Authors
$done = [];
$idAuthor = [];
$i = 1;
foreach ($content as $key => $value) {
	if (!in_array($value['author'], $done)) {
		echo('INSERT INTO AUTHORS (authors_name) VALUES (\''.escapeSQuotes($value['author']).'\');
');
		$idAuthor[$value['author']] = $i;
		$i++;
		$done[] = $value['author'];
	}
}

// Characters
$done = [];
$idCharacter = [];
$i = 1;
foreach ($content as $key => $value) {
	if (!empty($value['actor'])) {
		if (array_key_exists($value['actor'], $characters)) {
			if (!in_array($characters[$value['actor']], $done)) {
				echo('INSERT INTO CHARACTERS (characters_name, characters_refactor) VALUES (\''.escapeSQuotes($characters[$value['actor']]).'\', '.$idActors[$value['actor']].');
');
				$idCharacter[$characters[$value['actor']]] = $i;
				$i++;
				$done[] = $characters[$value['actor']];
			}
		}
	}
}

// Episodes
$done = [];
$idEpisode = [];
$i = 1;
foreach ($content as $key => $value) {
	if (!in_array($value['title'], $done)) {
		if (!empty($value['title']) && !empty($value['episode'])) {
			echo('INSERT INTO EPISODES (episodes_name, episodes_num, episodes_refauthor, episodes_refseason) VALUES (\''.escapeSQuotes($value['title']).'\', '.$value['episode'].', '.$idAuthor[$value['author']].', '.$idSeason[$value['season']].');
');
		} else {
			echo('INSERT INTO EPISODES (episodes_name, episodes_refauthor, episodes_refseason) VALUES (\''.escapeSQuotes($value['title']).'\', '.$idAuthor[$value['author']].', '.$idSeason[$value['season']].');
');
		}
		$idEpisode[$value['title']] = $i;
		$i++;
		$done[] = $value['title'];
	}
}

// Quotes
$done = [];
foreach ($content as $key => $value) {
	if (!in_array($value['quote'], $done)) {
		echo('INSERT INTO QUOTES (quotes_text, quotes_refepisode, quotes_refcharacter) VALUES (\''.escapeSQuotes($value['quote']).'\', '.$idEpisode[$value['title']].', '.$idCharacter[$characters[$value['actor']]].');
');
		$done[] = $value['quote'];
	}
}
