-- CREATE TABLE `examples` (
-- 	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
-- 	`name`	TEXT NOT NULL
-- );

-- INSERT INTO `examples` (name) VALUES ('example-1');
-- INSERT INTO `examples` (name) VALUES ('example-2');


-- Reptiles --

CREATE TABLE reptiles (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  name TEXT,
  species TEXT NOT NULL,
  family TEXT NOT NULL,
  type TEXT NOT NULL,
  price INTEGER,
  file_name TEXT NOT NULL,
  file_ext TEXT NOT NULL,
  source TEXT

);

INSERT INTO reptiles (name, species, family, type, price, file_name, file_ext, source) VALUES ('Betcky', '66% Lavender Hognose Snake', 'Hognose', 'Snake', 100, '1.jpg', 'jpg', 'https://www.instagram.com/agreptilecollection/');
INSERT INTO reptiles (name, species, family, type, price, file_name, file_ext, source) VALUES ('Oliver', 'Normal Bearded Dragon', 'Bearded Dragon', 'Lizard', 80, '2.jpg', 'jpg', 'https://www.instagram.com/agreptilecollection/');
INSERT INTO reptiles (name, species, family, type, price, file_name, file_ext, source) VALUES (NULL, 'Single Gene Clown', 'Ball Python', 'Snake', 350, '3.jpg', 'jpg', 'https://www.instagram.com/agreptilecollection/');
INSERT INTO reptiles (name, species, family, type, price, file_name, file_ext, source) VALUES (NULL, '0.1 Leopard Het Clown', 'Ball Python', 'Snake', 325, '4.jpg', 'jpg', 'https://www.instagram.com/agreptilecollection/');
INSERT INTO reptiles (name, species, family, type, price, file_name, file_ext, source) VALUES (NULL, 'Super Vanilla Mojave', 'Ball Python', 'Snake', 800, '5.jpg', 'jpg', 'https://www.instagram.com/agreptilecollection/');
INSERT INTO reptiles (name, species, family, type, price, file_name, file_ext, source) VALUES (NULL, 'Pastel Pinstripe Ultramel', 'Ball Python', 'Snake', 1200, '6.jpg', 'jpg', 'https://www.instagram.com/agreptilecollection/');
INSERT INTO reptiles (name, species, family, type, price, file_name, file_ext, source) VALUES (NULL, 'Mystic Fire Het Ultramel', 'Ball Python', 'Snake', 400, '7.jpg', 'jpg', 'https://www.instagram.com/agreptilecollection/');
INSERT INTO reptiles (name, species, family, type, price, file_name, file_ext, source) VALUES (NULL, 'Orange Dream Fire Hypo/Ghost', 'Ball Python', 'Snake', 600, '8.jpg', 'jpg', 'https://www.instagram.com/agreptilecollection/');
INSERT INTO reptiles (name, species, family, type, price, file_name, file_ext, source) VALUES (NULL, 'Banana Pinstripe', 'Ball Python', 'Snake', 350, '9.jpg', 'jpg', 'https://www.instagram.com/agreptilecollection/');
INSERT INTO reptiles (name, species, family, type, price, file_name, file_ext, source) VALUES (NULL, 'Fire Yellowbelly 100% Het Hypo/Ghost', 'Ball Python', 'Snake', 650, '10.jpg', 'jpg', 'https://www.instagram.com/agreptilecollection/');
INSERT INTO reptiles (name, species, family, type, price, file_name, file_ext, source) VALUES (NULL, 'Normal Ball Python', 'Ball Python', 'Snake', 100, '11.jpg', 'jpg', 'https://www.instagram.com/agreptilecollection/');
INSERT INTO reptiles (name, species, family, type, price, file_name, file_ext, source) VALUES (NULL, 'Butter Fire Pastel', 'Ball Python', 'Snake', 300, '12.jpg', 'jpg', 'https://www.instagram.com/agreptilecollection/');
INSERT INTO reptiles (name, species, family, type, price, file_name, file_ext, source) VALUES (NULL, 'Pastel Enchi Ghost/Hypo', 'Ball Python', 'Snake', 700, '13.jpg', 'jpg', 'https://www.instagram.com/agreptilecollection/');
INSERT INTO reptiles (name, species, family, type, price, file_name, file_ext, source) VALUES (NULL, '1.0 Toffee Western Hognose 100% Het Lavender', 'Hognose', 'Snake', 500, '14.jpg', 'jpg', 'https://www.instagram.com/agreptilecollection/');


-- Tags --

CREATE TABLE tags (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  tag_name TEXT NOT NULL UNIQUE
);

INSERT INTO tags (id, tag_name) VALUES (1, 'snake');
INSERT INTO tags (id, tag_name) VALUES (2, 'hognose');
INSERT INTO tags (id, tag_name) VALUES (3, 'ball python');
INSERT INTO tags (id, tag_name) VALUES (4, 'lizard');
INSERT INTO tags (id, tag_name) VALUES (5, 'bearded dragon');
INSERT INTO tags (id, tag_name) VALUES (6, 'gecko');
INSERT INTO tags (id, tag_name) VALUES (7, 'crested gecko');


-- Reptile Tags --

CREATE TABLE reptile_tags (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  reptile_id INTEGER NOT NULL,
  tag_id INTEGER NOT NULL,

  FOREIGN KEY (reptile_id) REFERENCES reptiles(id),
  FOREIGN KEY (tag_id) REFERENCES tags(id)

);

INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (1, 1);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (1, 2);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (2, 4);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (2, 5);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (3, 1);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (3, 3);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (4, 1);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (4, 3);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (5, 1);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (5, 3);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (6, 1);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (6, 3);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (7, 1);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (7, 3);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (8, 1);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (8, 3);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (9, 1);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (9, 3);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (10, 1);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (10, 3);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (11, 1);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (11, 3);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (12, 1);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (12, 3);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (13, 1);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (13, 3);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (14, 1);
INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (14, 2);


-- Users --

CREATE TABLE users (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  name TEXT NOT NULL,
  username TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL
);

INSERT INTO users (name, username, password) VALUES ('Rodrigo Cervantes', 'rodi', '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.'); -- password: monkey
INSERT INTO users (name, username, password) VALUES ('Diego Cervantes', 'diego', '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.'); -- password: monkey
INSERT INTO users (name, username, password) VALUES ('Isaac Cervantes', 'isaac', '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.'); -- password: monkey


-- Sessions --

CREATE TABLE sessions (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  user_id INTEGER NOT NULL,
  session TEXT NOT NULL UNIQUE,
  last_login TEXT NOT NULL,

  FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Groups --

CREATE TABLE groups (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  name TEXT NOT NULL UNIQUE
);

INSERT INTO groups (name) VALUES ('admin');
INSERT INTO groups (name) VALUES ('consumer');

-- Group Membership --

CREATE TABLE memberships (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  group_id INTEGER NOT NULL,
  user_id INTEGER NOT NULL,

  FOREIGN KEY (group_id) REFERENCES groups(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO memberships (group_id, user_id) VALUES (1, 1); -- User 'Rodrigo Cervantes' is a member of the 'admin' group.
INSERT INTO memberships (group_id, user_id) VALUES (2, 2); -- User 'Diego Cervantes' is a member of the 'consumer' group.
INSERT INTO memberships (group_id, user_id) VALUES (2, 3); -- User 'Isaac Cervantes' is a member of the 'consumer' group.
