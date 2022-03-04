<?php
/**
 * Return one random quote
 * @var Callable controllerRandom
 * @route GET /api/random
 */
$controllerRandom = function ($request, $response, $service, $app) {
	// TODO
};



/**
 * MISC
 */
/**
 * Format response as a JSON document
 * @param array $quote Array with the DB result of the quote selection
 * @return string The JSON encoded document
 */
function formatQuoteResponse(array $quote) : string {
	$return = new stdClass;
	$return->status = 1;
	$return->citation = new stdClass;
	$return->citation->citation = $quote['quotes_text'];
	$return->citation->infos = new stdClass;
	$return->citation->infos->auteur = "Alexandre Astier";
	$return->citation->infos->acteur = $quote['actors_name'];
	$return->citation->infos->personnage = $quote['characters_name'];
	$return->citation->infos->saison = $quote['seasons_name'];
	$return->citation->infos->episode = $quote['episodes_name'];

	return json_encode($return);
}