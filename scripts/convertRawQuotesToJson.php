<?php
/*
	Script to transform raw quotes from wikiquotes to pretty JSON
 */

// Import quotes from file
require('../assets/exportFromWikiQuotes.php');

// Define delimiters to parse big string
// Delimiter between quotes
$delimiter ="}}
{{";
// Delimiter between fields of a quote
$delimiter2 ="
|";

// Split string into quotes
$quotes = explode($delimiter, $rawQuotes);

// Transform raw quotes from wikiquotes to pretty JSON
$newDB = [];
foreach ($quotes as $kquote => $quote) {
	$res = explode($delimiter2, $quote);

	$citation = $acteur = $auteur = $série = $saison = $épisode = $title = NULL;
	
	foreach ($res as $value) {
		if (str_starts_with($value, "citation=")) {
			$citation = substr($value, strpos($value, "=")+1);
		} elseif (str_starts_with($value, "acteur=")) {
			$acteur = substr($value, strpos($value, "=")+1);
		} elseif (str_starts_with($value, "auteur=")) {
			$auteur = substr($value, strpos($value, "=")+1);
		} elseif (str_starts_with($value, "série=")) {
			$série = substr($value, strpos($value, "=")+1);
		} elseif (str_starts_with($value, "saison=")) {
			$saison = substr($value, strpos($value, "=")+1);
		} elseif (str_starts_with($value, "épisode=")) {
			$épisode = substr($value, strpos($value, "=")+1);
		} elseif (str_starts_with($value, "title=")) {
			$title = substr($value, strpos($value, "=")+1);
		} else {
			echo("Erreur pour ".$value);
			echo("<br><br>");
			echo("<br><br>");
		}
	}

	// Check if field episode is the episode number and not episode title
	if (!is_numeric($épisode)) {
		$title = $épisode;
		$épisode = NULL;
	}

	// Populate a var with all information
	$infos = [
		'quote'=>$citation,
		'actor'=>$acteur,
		'author'=>$auteur,
		'season'=>$saison
	];

	if (!empty($title)) {
		$infos["title"] = $title;
	} else {
		var_dump($res);
	}
	if (!empty($épisode)) {
		$infos["episode"] = $épisode;
	}

	$newDB[] = $infos;
}

// Print result prettily
echo(json_encode($newDB, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
