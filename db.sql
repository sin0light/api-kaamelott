CREATE TABLE SEASONS (
	seasons_id SERIAL UNIQUE NOT NULL PRIMARY KEY,
	seasons_name VARCHAR(100) NOT NULL,
	seasons_num INT NOT NULL
);

CREATE TABLE ACTORS (
	actors_id SERIAL UNIQUE NOT NULL PRIMARY KEY,
	actors_name VARCHAR(100) NOT NULL
);

CREATE TABLE AUTHORS (
	authors_id SERIAL UNIQUE NOT NULL PRIMARY KEY,
	authors_name VARCHAR(100) NOT NULL
);

CREATE TABLE CHARACTERS (
	characters_id SERIAL UNIQUE NOT NULL PRIMARY KEY,
	characters_name VARCHAR(100) NOT NULL,
	characters_pic TEXT,
	characters_refactor INT NOT NULL REFERENCES ACTORS(actors_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE EPISODES (
	episodes_id SERIAL UNIQUE NOT NULL PRIMARY KEY,
	episodes_num INT,
	episodes_name VARCHAR(100) NOT NULL,
	episodes_refauthor INT NOT NULL REFERENCES AUTHORS(authors_id) ON UPDATE CASCADE ON DELETE CASCADE,
	episodes_refseason INT NOT NULL REFERENCES SEASONS(seasons_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE QUOTES (
	quotes_id SERIAL UNIQUE NOT NULL PRIMARY KEY,
	quotes_text VARCHAR NOT NULL,
	quotes_refepisode INT NOT NULL REFERENCES EPISODES(episodes_id) ON UPDATE CASCADE ON DELETE CASCADE,
	quotes_refcharacter INT NOT NULL REFERENCES CHARACTERS(characters_id) ON UPDATE CASCADE ON DELETE CASCADE,
	quotes_counter_random INT NOT NULL DEFAULT 0
);

CREATE TABLE SOUNDS (
	sounds_id SERIAL UNIQUE NOT NULL PRIMARY KEY,
	sounds_filename VARCHAR NOT NULL,
	sounds_refquote INT NOT NULL REFERENCES QUOTES(quotes_id) ON UPDATE CASCADE ON DELETE CASCADE,
	sounds_counter INT NOT NULL DEFAULT 0
);
