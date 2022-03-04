CREATE TABLE SEASONS (
	seasons_id SERIAL UNIQUE NOT NULL PRIMARY KEY,
	seasons_name VARCHAR(100) NOT NULL,
	seasons_num INT NOT NULL
);

CREATE TABLE CHARACTERS (
	characters_id SERIAL UNIQUE NOT NULL PRIMARY KEY,
	characters_name VARCHAR(100) NOT NULL,
	characters_refactor INT NOT NULL REFERENCES ACTORS(actors_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE ACTORS (
	actors_id SERIAL UNIQUE NOT NULL PRIMARY KEY,
	actors_name VARCHAR(100) NOT NULL
);

CREATE TABLE EPISODES (
	episodes_id SERIAL UNIQUE NOT NULL PRIMARY KEY,
	episodes_name VARCHAR(100) NOT NULL,
	episodes_refseason INT NOT NULL REFERENCES SEASONS(seasons_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE QUOTES (
	quotes_id SERIAL UNIQUE NOT NULL PRIMARY KEY,
	quotes_text VARCHAR NOT NULL,
	quotes_refepisode INT NOT NULL REFERENCES EPISODES(episodes_id) ON UPDATE CASCADE ON DELETE CASCADE,
	quotes_refcharacter INT NOT NULL REFERENCES SEASONS(characters_id) ON UPDATE CASCADE ON DELETE CASCADE,
	quotes_analytics INT NOT NULL DEFAULT 0
);