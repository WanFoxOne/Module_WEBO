
CREATE TABLE table_users (
  id smallint(5) NOT NULL auto_increment,
  pseudo varchar(30) NOT NULL default '',
  email varchar(250) NOT NULL default '',
  PRIMARY KEY  (id)
) Engine=INODB;

INSERT INTO table_users VALUES (1, 'bobe', 'bobe@domain.com');
INSERT INTO table_users VALUES (2, 'AllCoKe', 'AllCoKe@domain2.net');
INSERT INTO table_users VALUES (3, 'toto', 'toto@domain3.fr');

