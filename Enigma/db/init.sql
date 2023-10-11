-- CREATE TABLE `examples` (
-- 	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
-- 	`name`	TEXT NOT NULL
-- );

-- INSERT INTO `examples` (name) VALUES ('example-1');
-- INSERT INTO `examples` (name) VALUES ('example-2');


-- Rotors --
CREATE TABLE 'rotors' (
  'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  'name' TEXT NOT NULL UNIQUE,
  'wiring_spec' TEXT NOT NULL UNIQUE
);

INSERT INTO 'rotors' (name, wiring_spec) VALUES ('I', 'EKMFLGDQVZNTOWYHXUSPAIBRCJ');
INSERT INTO 'rotors' (name, wiring_spec) VALUES ('II', 'AJDKSIRUXBLHWTMCQGZNPYFVOE');
INSERT INTO 'rotors' (name, wiring_spec) VALUES ('III', 'BDFHJLCPRTXVZNYEIWGAKMUSQO');

-- Reflectors --


-- Plugs --