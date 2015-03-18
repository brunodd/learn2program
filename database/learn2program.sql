DROP DATABASE if exists learn2program_db;

CREATE DATABASE learn2program_db;
USE learn2program_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT,
    pass VARCHAR(60) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    mail VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE friends (
    id1 INT NOT NULL,
    id2 INT NOT NULL,
    PRIMARY KEY (id1, id2),
    FOREIGN KEY (id1) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (id2) REFERENCES users(id) ON DELETE CASCADE
);

/* TODO: conversation is deleted when one of the users deletes their account
         later maybe make it so that the other user can still see the messages?
         -> allow one of the users to be NULL or add a archived_conversations table
   iets voor na alle basisvereisten
 */
CREATE TABLE conversations (
    id INT AUTO_INCREMENT,
    userA INT NOT NULL,
    userB INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (userA) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (userB) REFERENCES users(id) ON DELETE CASCADE
);

/* TODO: again, maybe add an archived_messages table?
   iets voor na alle basisvereisten

   TODO: Armin: change author column
*/
CREATE TABLE messages (
    conversationId INT NOT NULL,
    message VARCHAR(512) NOT NULL,
    author int NOT NULL,
    date TIMESTAMP, /* 'YYYY-MM-DD HH:MM:SS' format */
    FOREIGN KEY (conversationId) REFERENCES conversations(id) ON DELETE CASCADE
);

/* Armin: Maybe allow founderId to be NULL in case founder deletes their account?
          Or force them to choose another 'founder' before deleting.
          For now, group get deleted
*/
CREATE TABLE groups (
    id INT AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE,
    founderId INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (founderId) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE members_of_groups (
    memberId INT NOT NULL,
    groupId INT NOT NULL,
    PRIMARY KEY (memberId, groupId),
    FOREIGN KEY (memberId) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (groupId) REFERENCES groups(id) ON DELETE CASCADE
);

/* Only allow 4 values for difficulty? => easy, Intermediate, hard, insane */
CREATE TABLE types (
    id INT AUTO_INCREMENT,
    subject VARCHAR(50) NOT NULL,
    difficulty ENUM('easy', 'Intermediate', 'hard', 'insane') NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (subject, difficulty)
);

/* Must make sure that at least 1 exercise belongs to a serie
    => design the site so that this is always the case?

   Allow makerId to be NULL in case the maker deletes their account?
   This way all their work will not be deleted and users can still do things with the series.
   If types cannot be deleted then there is no problem for types.

   Used ON CASCADE DELETE for both for now, which is very bad :P -> worries for later
*/
CREATE TABLE series (
    id INT AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    description VARCHAR(500),
    makerId INT NOT NULL,
    tId INT NOT NULL,
    UNIQUE (title, tId),
    PRIMARY KEY (id),
    FOREIGN KEY (makerId) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (tId) REFERENCES types(id) ON DELETE CASCADE
);

/* Again choose between pre-defined values for rating? */
CREATE TABLE series_ratings (
    userId INT,
    serieId INT NOT NULL,
    rating ENUM('0', '1', '2', '3', '4', '5') NOT NULL,
    UNIQUE (userId, serieId),
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (serieId) REFERENCES series(id) ON DELETE CASCADE
);

/* Should we keep exercises somehow if someone deletes a series?
   serieId will then be set to NULL and exercises can be shown on exercises home page?
   For now, they will be deleted
*/
CREATE TABLE exercises (
    id INT AUTO_INCREMENT,
    question VARCHAR(500) NOT NULL,
    tips VARCHAR(500),
    start_code TEXT NOT NULL,
    expected_result TEXT NOT NULL,
    serieId INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (serieId) REFERENCES series(id) ON DELETE CASCADE
);

CREATE TABLE exercises_answers (
    id INT AUTO_INCREMENT,
    given_code TEXT NOT NULL,
    success BOOL NOT NULL,
    uId INT NOT NULL,
    eId INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (uId) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (eId) REFERENCES exercises(id) ON DELETE CASCADE
);






/* Make sure password, username and mail are not empty. */
delimiter //
CREATE TRIGGER check_users
BEFORE INSERT ON users 
FOR EACH ROW 
BEGIN
    IF NEW.pass = "" THEN
        SET NEW.pass = Null;
    END IF;
    IF NEW.username = "" THEN
        SET NEW.username = Null;
    END IF;
    IF NEW.mail = "" THEN
        SET NEW.pass = Null;
    END IF;
END;//

delimiter ;

/* Make sure the answer is not empty. */
delimiter //
CREATE TRIGGER check_answer
BEFORE INSERT ON exercises_answers
FOR EACH ROW 
BEGIN
    IF NEW.given_code = "" THEN
        SET NEW.given_code = Null;
    END IF; 
END;//

delimiter ;

/* Make sure the title from serie is not empty. */
delimiter //
CREATE TRIGGER check_title
BEFORE INSERT ON series
FOR EACH ROW 
BEGIN
    IF NEW.title = "" THEN
        SET NEW.title = Null;
    END IF; 
END;//

delimiter ;

/* Make sure the group name is not empty. */
delimiter //
CREATE TRIGGER check_group
BEFORE INSERT ON groups
FOR EACH ROW 
BEGIN
    IF NEW.name = "" THEN
        SET NEW.name = Null;
    END IF; 
END;//

delimiter ;

/* Make sure the subject and difficulty are not empty. */
delimiter //
CREATE TRIGGER check_type
BEFORE INSERT ON types
FOR EACH ROW 
BEGIN
    IF NEW.subject = "" THEN
        SET NEW.subject = Null;
    END IF; 
    IF NEW.difficulty = "" THEN
        SET NEW.difficulty = Null;
    END IF;
END;//

delimiter ;

/* Make sure question, start_code and expected_result are not empty. */
delimiter //
CREATE TRIGGER check_exercise
BEFORE INSERT ON exercises
FOR EACH ROW 
BEGIN
    IF NEW.question = "" THEN
        SET NEW.question = Null;
    END IF;
    IF NEW.start_code = "" THEN
        SET NEW.start_code = Null;
    END IF;
    IF NEW.expected_result = "" THEN
        SET NEW.expected_result = Null;
    END IF;
END;//

/* Make sure question, start_code and expected_result are not empty. */
delimiter //
CREATE TRIGGER check_friends
BEFORE INSERT ON friends
FOR EACH ROW 
BEGIN
    IF NEW.id1 = NEW.id2 THEN
        SET NEW.id1 = Null;
    END IF;
    IF EXISTS (SELECT * FROM friends WHERE (id1 = NEW.id1 and id2 = NEW.id2) or (id1 = NEW.id2 and id2 = NEW.id1)) THEN
        SET NEW.id1 = Null;
    END IF;
END;//
