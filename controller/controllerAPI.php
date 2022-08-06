<?php

/** RANDOM */

/**
 * Return one random quote
 * @var Callable controllerRandom
 * @route GET /api/random
 */
$controllerRandom = function ($request, $response, $service, $app) {
	$resDB = $app->db->select('QUOTES', [''=>'random()'], ['EPISODES'=>['INNER', 'quotes_refepisode', 'episodes_id'], 'CHARACTERS'=>['INNER', 'quotes_refcharacter', 'characters_id'], 'AUTHORS'=>['INNER', 'episodes_refauthor', 'authors_id', 'EPISODES'], 'SEASONS'=>['INNER', 'episodes_refseason', 'seasons_id', 'EPISODES'], 'ACTORS'=>['INNER', 'characters_refactor', 'actors_id', 'CHARACTERS']], NULL, 1);
	$resUpdate = $app->db->update('QUOTES', ['quotes_counter_random'=>$resDB[0]['quotes_counter_random']+1], ['quotes_id'=>$resDB[0]['quotes_id']]);
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
			$resUpdate = $app->db->update('QUOTES', ['quotes_counter_random'=>$resDB[0]['quotes_counter_random']+1], ['quotes_id'=>$resDB[0]['quotes_id']]);
			$response->json(formatQuoteResponse($resDB[0]));
		} else {
			$response->json(forgeErrorResponse(400, 'Unknown character.'));
		}
	} else {
		$response->json(forgeErrorResponse(400, 'No character provided.'));
	}
};


/**
 * Return one random quote from a specific author
 * @var Callable controllerRandomAuthor
 * @route GET /api/random/auteur/[:author]
 */
$controllerRandomAuthor = function ($request, $response, $service, $app) {
	if (!empty($request->author)) {
		$author = $app->db->select('AUTHORS', NULL, NULL, ['AUTHORS'=>['authors_name'=>$request->author]]);
		if (count($author) == 1) {
			$resDB = $app->db->select('QUOTES', [''=>'random()'], ['EPISODES'=>['INNER', 'quotes_refepisode', 'episodes_id'], 'CHARACTERS'=>['INNER', 'quotes_refcharacter', 'characters_id'], 'AUTHORS'=>['INNER', 'episodes_refauthor', 'authors_id', 'EPISODES'], 'SEASONS'=>['INNER', 'episodes_refseason', 'seasons_id', 'EPISODES'], 'ACTORS'=>['INNER', 'characters_refactor', 'actors_id', 'CHARACTERS']], ['AUTHORS'=>['authors_id'=>$author[0]['authors_id']]], 1);
			$resUpdate = $app->db->update('QUOTES', ['quotes_counter_random'=>$resDB[0]['quotes_counter_random']+1], ['quotes_id'=>$resDB[0]['quotes_id']]);
			$response->json(formatQuoteResponse($resDB[0]));
		} else {
			$response->json(forgeErrorResponse(400, 'Unknown author.'));
		}
	} else {
		$response->json(forgeErrorResponse(400, 'No author provided.'));
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
			$resUpdate = $app->db->update('QUOTES', ['quotes_counter_random'=>$resDB[0]['quotes_counter_random']+1], ['quotes_id'=>$resDB[0]['quotes_id']]);
			$response->json(formatQuoteResponse($resDB[0]));
		} else {
			$response->json(forgeErrorResponse(400, 'Unknown season.'));
		}
	} else {
		$response->json(forgeErrorResponse(400, 'No season provided.'));
	}
};


/**
 * Return one random quote from a specific season and of a specific character
 * @var Callable controllerRandomSeasonCharacter
 * @route GET /api/random/livre/[:season]/personnage/[:character]
 */
$controllerRandomSeasonCharacter = function ($request, $response, $service, $app) {
	if (is_numeric($request->season) && !empty($request->character)) {
		$season = $app->db->select('SEASONS', NULL, NULL, ['SEASONS'=>['seasons_num'=>$request->season]]);
		$character = $app->db->select('CHARACTERS', NULL, NULL, ['CHARACTERS'=>['characters_name'=>$request->character]]);
		if (count($season) == 1 && count($character) == 1) {
			$resDB = $app->db->select('QUOTES', [''=>'random()'], ['EPISODES'=>['INNER', 'quotes_refepisode', 'episodes_id'], 'CHARACTERS'=>['INNER', 'quotes_refcharacter', 'characters_id'], 'AUTHORS'=>['INNER', 'episodes_refauthor', 'authors_id', 'EPISODES'], 'SEASONS'=>['INNER', 'episodes_refseason', 'seasons_id', 'EPISODES'], 'ACTORS'=>['INNER', 'characters_refactor', 'actors_id', 'CHARACTERS']], ['SEASONS'=>['seasons_id'=>$season[0]['seasons_id']], 'CHARACTERS'=>['characters_id'=>$character[0]['characters_id']]], 1);
			if (count($resDB) > 0) {
				$resUpdate = $app->db->update('QUOTES', ['quotes_counter_random'=>$resDB[0]['quotes_counter_random']+1], ['quotes_id'=>$resDB[0]['quotes_id']]);
				$response->json(formatQuoteResponse($resDB[0]));
			} else {
				$response->json(forgeErrorResponse(400, 'No quotes available for this request.'));
			}
		} else {
			$response->json(forgeErrorResponse(400, 'Unknown season or character.'));
		}
	} else {
		$response->json(forgeErrorResponse(400, 'No season or character provided.'));
	}
};


/** ALL */

/**
 * Return all quotes
 * @var Callable controllerAll
 * @route GET /api/all
 */
$controllerAll = function ($request, $response, $service, $app) {
	$resDB = $app->db->select('QUOTES', ['seasons_num'=>'ASC', 'episodes_num'=>'ASC', 'episodes_name'=>'ASC', 'quotes_text'=>'ASC'], ['EPISODES'=>['INNER', 'quotes_refepisode', 'episodes_id'], 'CHARACTERS'=>['INNER', 'quotes_refcharacter', 'characters_id'], 'AUTHORS'=>['INNER', 'episodes_refauthor', 'authors_id', 'EPISODES'], 'SEASONS'=>['INNER', 'episodes_refseason', 'seasons_id', 'EPISODES'], 'ACTORS'=>['INNER', 'characters_refactor', 'actors_id', 'CHARACTERS']]);
	$response->json(formatQuotesResponse($resDB));
};


/**
 * Return all quotes from a specific character
 * @var Callable controllerAllCharacter
 * @route GET /api/all/personnage/[:character]
 */
$controllerAllCharacter = function ($request, $response, $service, $app) {
	if (!empty($request->character)) {
		$character = $app->db->select('CHARACTERS', NULL, NULL, ['CHARACTERS'=>['characters_name'=>$request->character]]);
		if (count($character) == 1) {
			$resDB = $app->db->select('QUOTES', ['seasons_num'=>'ASC', 'episodes_num'=>'ASC', 'episodes_name'=>'ASC', 'quotes_text'=>'ASC'], ['EPISODES'=>['INNER', 'quotes_refepisode', 'episodes_id'], 'CHARACTERS'=>['INNER', 'quotes_refcharacter', 'characters_id'], 'AUTHORS'=>['INNER', 'episodes_refauthor', 'authors_id', 'EPISODES'], 'SEASONS'=>['INNER', 'episodes_refseason', 'seasons_id', 'EPISODES'], 'ACTORS'=>['INNER', 'characters_refactor', 'actors_id', 'CHARACTERS']], ['CHARACTERS'=>['characters_id'=>$character[0]['characters_id']]]);
			$response->json(formatQuotesResponse($resDB));
		} else {
			$response->json(forgeErrorResponse(400, 'Unknown character.'));
		}
	} else {
		$response->json(forgeErrorResponse(400, 'No character provided.'));
	}
};


/**
 * Return all quotes from a specific author
 * @var Callable controllerAllAuthor
 * @route GET /api/all/author/[:author]
 */
$controllerAllAuthor = function ($request, $response, $service, $app) {
	if (!empty($request->author)) {
		$author = $app->db->select('AUTHORS', NULL, NULL, ['AUTHORS'=>['authors_name'=>$request->author]]);
		if (count($author) == 1) {
			$resDB = $app->db->select('QUOTES', ['seasons_num'=>'ASC', 'episodes_num'=>'ASC', 'episodes_name'=>'ASC', 'quotes_text'=>'ASC'], ['EPISODES'=>['INNER', 'quotes_refepisode', 'episodes_id'], 'CHARACTERS'=>['INNER', 'quotes_refcharacter', 'characters_id'], 'AUTHORS'=>['INNER', 'episodes_refauthor', 'authors_id', 'EPISODES'], 'SEASONS'=>['INNER', 'episodes_refseason', 'seasons_id', 'EPISODES'], 'ACTORS'=>['INNER', 'characters_refactor', 'actors_id', 'CHARACTERS']], ['AUTHORS'=>['authors_id'=>$author[0]['authors_id']]]);
			$response->json(formatQuotesResponse($resDB));
		} else {
			$response->json(forgeErrorResponse(400, 'Unknown author.'));
		}
	} else {
		$response->json(forgeErrorResponse(400, 'No author provided.'));
	}
};


/**
 * Return all quotes from a specific season
 * @var Callable controllerAllSeason
 * @route GET /api/all/livre/[:season]
 */
$controllerAllSeason = function ($request, $response, $service, $app) {
	if (is_numeric($request->season)) {
		$season = $app->db->select('SEASONS', NULL, NULL, ['SEASONS'=>['seasons_num'=>$request->season]]);
		if (count($season) == 1) {
			$resDB = $app->db->select('QUOTES', ['seasons_num'=>'ASC', 'episodes_num'=>'ASC', 'episodes_name'=>'ASC', 'quotes_text'=>'ASC'], ['EPISODES'=>['INNER', 'quotes_refepisode', 'episodes_id'], 'CHARACTERS'=>['INNER', 'quotes_refcharacter', 'characters_id'], 'AUTHORS'=>['INNER', 'episodes_refauthor', 'authors_id', 'EPISODES'], 'SEASONS'=>['INNER', 'episodes_refseason', 'seasons_id', 'EPISODES'], 'ACTORS'=>['INNER', 'characters_refactor', 'actors_id', 'CHARACTERS']], ['SEASONS'=>['seasons_id'=>$season[0]['seasons_id']]]);
			$response->json(formatQuotesResponse($resDB));
		} else {
			$response->json(forgeErrorResponse(400, 'Unknown season.'));
		}
	} else {
		$response->json(forgeErrorResponse(400, 'No season provided.'));
	}
};


/**
 * Return all quotes from a specific season and of a specific character
 * @var Callable controllerAllSeasonCharacter
 * @route GET /api/all/livre/[:season]
 */
$controllerAllSeasonCharacter = function ($request, $response, $service, $app) {
	if (is_numeric($request->season) && !empty($request->character)) {
		$season = $app->db->select('SEASONS', NULL, NULL, ['SEASONS'=>['seasons_num'=>$request->season]]);
		$character = $app->db->select('CHARACTERS', NULL, NULL, ['CHARACTERS'=>['characters_name'=>$request->character]]);
		if (count($season) == 1 && count($character) == 1) {
			$resDB = $app->db->select('QUOTES', ['seasons_num'=>'ASC', 'episodes_num'=>'ASC', 'episodes_name'=>'ASC', 'quotes_text'=>'ASC'], ['EPISODES'=>['INNER', 'quotes_refepisode', 'episodes_id'], 'CHARACTERS'=>['INNER', 'quotes_refcharacter', 'characters_id'], 'AUTHORS'=>['INNER', 'episodes_refauthor', 'authors_id', 'EPISODES'], 'SEASONS'=>['INNER', 'episodes_refseason', 'seasons_id', 'EPISODES'], 'ACTORS'=>['INNER', 'characters_refactor', 'actors_id', 'CHARACTERS']], ['SEASONS'=>['seasons_id'=>$season[0]['seasons_id']], 'CHARACTERS'=>['characters_id'=>$character[0]['characters_id']]]);
			$response->json(formatQuotesResponse($resDB));
		} else {
			$response->json(forgeErrorResponse(400, 'Unknown season or character.'));
		}
	} else {
		$response->json(forgeErrorResponse(400, 'No season or character provided.'));
	}
};


/**
 * Return a sound file 
 * @var Callable controllerSounds
 * @route GET /api/sounds/[:filename]
 */
$controllerSounds = function ($request, $response, $service, $app) {
	if (!empty($request->filename)) {
		$knownFiles = scandir('./assets/sounds');
		if (in_array($request->filename, $knownFiles)) {
			$response->file('./assets/sounds/'.$request->filename);
		} else {
			$response->json(forgeErrorResponse(400, 'Unknown sound file.'));
		}
	} else {
		$response->json(forgeErrorResponse(400, 'No sound file provided.'));
	}
};


/** OTHERS */

/**
 * Return a character's picture
 * @var Callable controllerCharacterPic
 * @route GET /api/personnage/[:character]/pic
 */
$controllerCharacterPic = function ($request, $response, $service, $app) {
	if (!empty($request->character)) {
		$character = $app->db->select('CHARACTERS', NULL, NULL, ['CHARACTERS'=>['characters_name'=>$request->character]]);
		if (count($character) == 1) {
			if (!empty($character[0]["characters_pic"])) {
				$response->header("Content-Type", "image/jpeg");
				$response->append(base64_decode($character[0]["characters_pic"]));
				$response->send();
			} else {
				$response->json(forgeErrorResponse(400, 'Picture for this character is unavailable.'));
			}
		} else {
			$response->json(forgeErrorResponse(400, 'Unknown character.'));
		}
	} else {
		$response->json(forgeErrorResponse(400, 'No character provided.'));
	}
};


/**
 * Return all characters
 * @var Callable controllerCharactersAll
 * @route GET /api/personnage/all
 */
$controllerCharactersAll = function ($request, $response, $service, $app) {
	$resDB = $app->db->select('CHARACTERS', ['characters_name'=>'ASC']);
	$return = new stdClass;
	$return->status = 1;
	$return->characters = [];
	foreach ($resDB as $value) {
		$return->characters[] = $value['characters_name'];
	}
	$response->json($return);
};


/**
 * Return all authors
 * @var Callable controllerAuthorsAll
 * @route GET /api/authors/all
 */
$controllerAuthorsAll = function ($request, $response, $service, $app) {
	$resDB = $app->db->select('AUTHORS', ['authors_name'=>'ASC']);
	$return = new stdClass;
	$return->status = 1;
	$return->authors = [];
	foreach ($resDB as $value) {
		$return->authors[] = $value['authors_name'];
	}
	$response->json($return);
};



/**
 * MISC
 */

/**
 * Format response for a single quote as a JSON document
 * @param array $quote Array with the DB result of the quote
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

/**
 * Format response for multiple quotes as a JSON document
 * @param array $quote Array with the DB result of the quote selection
 * @return stdClass The forged object
 */
function formatQuotesResponse(array $quotes) : stdClass {
	$return = new stdClass;
	$return->status = 1;
	$return->citation = [];
	foreach ($quotes as $value) {
		$quote = new stdClass;
		$quote->citation = $value['quotes_text'];
		$quote->infos = new stdClass;
		$quote->infos->auteur = $value['authors_name'];
		$quote->infos->acteur = $value['actors_name'];
		$quote->infos->personnage = $value['characters_name'];
		$quote->infos->saison = $value['seasons_name'];
		$quote->infos->episode = $value['episodes_name'];
		
		$return->citation[] = $quote;
	}

	return $return;
}
