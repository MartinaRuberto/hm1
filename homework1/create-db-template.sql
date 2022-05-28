CREATE DATABASE hw1;

use hw1;

CREATE TABLE users(
id INTEGER AUTO_INCREMENT,
username VARCHAR(255),
password VARCHAR(255),
name VARCHAR(255),
surname VARCHAR(255),
email VARCHAR(255), 

PRIMARY KEY(id)
);

SELECT * from users;

   
CREATE table section(

title TEXT,
id integer PRIMARY KEY,
immagine TEXT
);
/*drop TABLE section*/
INSERT INTO section VALUES("Friends", 1,
"Friends.jpg"
);

INSERT INTO section VALUES("How i met your mother",2,
"HMYM.jpg"

);
INSERT INTO section VALUES("Glee",3,
"Glee.jpg"
);

INSERT INTO section VALUES("Breaking Bad",4,
"BreakingBad.jpg"

);
INSERT INTO section VALUES("Stranger Things",5,
"StrangerThings.jpg"
);
/*DROP TABLE preferiti*/

CREATE table preferiti(

section_id integer,
FOREIGN KEY(section_id) REFERENCES section(id),
user_id INTEGER,
FOREIGN KEY(user_id) REFERENCES users(id),
PRIMARY KEY(section_id,user_id)
);

/*DROP TABLE salvati*/

CREATE table salvati(

generi_id integer,
FOREIGN KEY(generi_id) REFERENCES section(id),
use_id INTEGER,
FOREIGN KEY(use_id) REFERENCES users(id),
PRIMARY KEY(generi_id,use_id)
);

/* DROP TABLE generi*/
CREATE table generi(
title TEXT,
id integer PRIMARY KEY,
immagine TEXT
);

drop TABLE generi;


