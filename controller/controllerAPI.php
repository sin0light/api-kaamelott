<?php
/**
 * Return one random quote
 * @var Callable controllerRandom
 * @route GET /api/random
 */
$controllerRandom = function ($request, $response, $service, $app) {
	$resDB = $app->db->select('QUOTES', [''=>'random()'], ['EPISODES'=>['INNER', 'quotes_refepisode', 'episodes_id'], 'CHARACTERS'=>['INNER', 'quotes_refcharacter', 'characters_id'], 'AUTHORS'=>['INNER', 'episodes_refauthor', 'authors_id', 'EPISODES'], 'SEASONS'=>['INNER', 'episodes_refseason', 'seasons_id', 'EPISODES'], 'ACTORS'=>['INNER', 'characters_refactor', 'actors_id', 'CHARACTERS']], NULL, 1);
	$response->json(formatQuoteResponse($resDB[0]));
};


/**
 * Return one random quote from a specific character
 * @var Callable controllerRandomCharacter
 * @route GET /api/random/personnage/[:character]
 */
$controllerRandomCharacter = function ($request, $response, $service, $app) {
	if (!empty($request->character)) {
		$character = $app->db->select('CHARACTERS', NULL, NULL, ['CHARACTERS'=>['characters_name'=>$request->character]]);
		if (count($character) == 1) {
			$resDB = $app->db->select('QUOTES', [''=>'random()'], ['EPISODES'=>['INNER', 'quotes_refepisode', 'episodes_id'], 'CHARACTERS'=>['INNER', 'quotes_refcharacter', 'characters_id'], 'AUTHORS'=>['INNER', 'episodes_refauthor', 'authors_id', 'EPISODES'], 'SEASONS'=>['INNER', 'episodes_refseason', 'seasons_id', 'EPISODES'], 'ACTORS'=>['INNER', 'characters_refactor', 'actors_id', 'CHARACTERS']], ['CHARACTERS'=>['characters_id'=>$character[0]['characters_id']]], 1);
			$response->json(formatQuoteResponse($resDB[0]));
		} else {
			$response->json(forgeErrorResponse(400, 'Unknown character.'));
		}
	} else {
		$response->json(forgeErrorResponse(400, 'No character provided.'));
	}
};


/**
 * Return one random quote from a specific season
 * @var Callable controllerRandomSeason
 * @route GET /api/random/livre/[:season]
 */
$controllerRandomSeason = function ($request, $response, $service, $app) {
	if (is_numeric($request->season)) {
		$season = $app->db->select('SEASONS', NULL, NULL, ['SEASONS'=>['seasons_num'=>$request->season]]);
		if (count($season) == 1) {
			$resDB = $app->db->select('QUOTES', [''=>'random()'], ['EPISODES'=>['INNER', 'quotes_refepisode', 'episodes_id'], 'CHARACTERS'=>['INNER', 'quotes_refcharacter', 'characters_id'], 'AUTHORS'=>['INNER', 'episodes_refauthor', 'authors_id', 'EPISODES'], 'SEASONS'=>['INNER', 'episodes_refseason', 'seasons_id', 'EPISODES'], 'ACTORS'=>['INNER', 'characters_refactor', 'actors_id', 'CHARACTERS']], ['SEASONS'=>['seasons_id'=>$season[0]['seasons_id']]], 1);
			$response->json(formatQuoteResponse($resDB[0]));
		} else {
			$response->json(forgeErrorResponse(400, 'Unknown season.'));
		}
	} else {
		$response->json(forgeErrorResponse(400, 'No season provided.'));
	}
};



/**
 * MISC
 */

/**
 * Format response as a JSON document
 * @param array $quote Array with the DB result of the quote selection
 * @return stdClass The forged object
 */
function formatQuoteResponse(array $quote) : stdClass {
	$return = new stdClass;
	$return->status = 1;
	$return->citation = new stdClass;
	$return->citation->citation = $quote['quotes_text'];
	$return->citation->infos = new stdClass;
	$return->citation->infos->auteur = $quote['authors_name'];
	$return->citation->infos->acteur = $quote['actors_name'];
	$return->citation->infos->personnage = $quote['characters_name'];
	$return->citation->infos->saison = $quote['seasons_name'];
	$return->citation->infos->episode = $quote['episodes_name'];

	return $return;
}