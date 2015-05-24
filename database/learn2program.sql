DROP DATABASE if exists learn2program_db;

CREATE DATABASE learn2program_db;
USE learn2program_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT,
    pass VARCHAR(60) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    mail VARCHAR(50) NOT NULL,
    score INT NOT NULL DEFAULT 0,
    image VARCHAR(50) NOT NULL DEFAULT 'NoProfileImage.jpg', /* Link to image name in /images/users/* */
    info TEXT,
    PRIMARY KEY (id)
);

/* id1 < id2 */
CREATE TABLE friends (
    id1 INT NOT NULL,
    id2 INT NOT NULL,
    status ENUM('pending', 'accepted', 'declined') NOT NULL,
    action_user_id INT NOT NULL,
    PRIMARY KEY (id1, id2),
    FOREIGN KEY (id1) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (id2) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (action_user_id) REFERENCES users(id) ON DELETE CASCADE
);

/* TODO: conversation is deleted when one of the users deletes their account
         later maybe make it so that the other user can still see the messages?
         -> allow one of the users to be NULL or add a archived_conversations table
   iets voor na alle basisvereisten
*/
CREATE TABLE conversations (
    id INT AUTO_INCREMENT,
    PRIMARY KEY (id)
);

CREATE TABLE conversations_participants (
    conversationId INT NOT NULL,
    userId INT NOT NULL,
    PRIMARY KEY (conversationId, userId),
    FOREIGN KEY (conversationId) REFERENCES conversations(id) ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE
);

/* TODO: again, maybe add an archived_messages table?
   iets voor na alle basisvereisten

   TODO: Armin: change author column
*/
CREATE TABLE messages (
    id INT AUTO_INCREMENT,
    conversationId INT NOT NULL,
    message TEXT NOT NULL,
    author INT NOT NULL,
    is_read BOOL NOT NULL DEFAULT 0,
    date TIMESTAMP, /* 'YYYY-MM-DD HH:MM:SS' format */
    PRIMARY KEY (id),
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
    conversationId INT NOT NULL,
    private BOOL NOT NULL DEFAULT 0,
    PRIMARY KEY (id),
    FOREIGN KEY (founderId) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (conversationId) REFERENCES conversations(id) ON DELETE CASCADE
);

CREATE TABLE members_of_groups (
    memberId INT NOT NULL,
    groupId INT NOT NULL,
    status ENUM('pending', 'accepted', 'declined') NOT NULL,
    PRIMARY KEY (memberId, groupId),
    FOREIGN KEY (memberId) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (groupId) REFERENCES groups(id) ON DELETE CASCADE
);

/* Only allow 4 values for difficulty? => easy, Intermediate, hard, insane */
CREATE TABLE types (
    id INT AUTO_INCREMENT,
    subject VARCHAR(50) NOT NULL,
    difficulty ENUM('Easy', 'Intermediate', 'Hard', 'Insane') NOT NULL,
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
	views INT DEFAULT 0,
    UNIQUE (title, tId),
    PRIMARY KEY (id),
    FOREIGN KEY (makerId) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (tId) REFERENCES types(id) ON DELETE CASCADE
);

/* Again choose between pre-defined values for rating? */
CREATE TABLE series_ratings (
    userId INT,
    seriesId INT NOT NULL,
    rating ENUM('0', '1', '2', '3', '4', '5') NOT NULL,
    UNIQUE (userId, seriesId),
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (seriesId) REFERENCES series(id) ON DELETE CASCADE
);

/* Should we keep exercises somehow if someone deletes a series?
   seriesId will then be set to NULL and exercises can be shown on exercises home page?
   For now, they will be deleted
*/
CREATE TABLE exercises (
    id INT AUTO_INCREMENT,
    question TEXT NOT NULL,
    tips VARCHAR(500),
    start_code TEXT NOT NULL,
    expected_result TEXT NOT NULL,
    makerId INT NOT NULL,
    language VARCHAR(20) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (makerId) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE exercises_in_series (
    exId INT NOT NULL,
    seriesId INT NOT NULL,
    ex_index INT NOT NULL,
    PRIMARY KEY (exId, seriesId),
    FOREIGN KEY (exId) REFERENCES exercises(id) ON DELETE CASCADE,
    FOREIGN KEY (seriesId) REFERENCES series(id) ON DELETE CASCADE
);

CREATE TABLE answers (
    id INT AUTO_INCREMENT,
    given_code TEXT NOT NULL,
    success BOOL NOT NULL,
    uId INT NOT NULL,
    eId INT NOT NULL,
    time DECIMAL,
    PRIMARY KEY (id),
    FOREIGN KEY (uId) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (eId) REFERENCES exercises(id) ON DELETE CASCADE
);

/* Examples: type: friends;                      object_id: userId;
             type: series;                       object_id: seriesId;
             type: friend accomplished exercise; object_id: userId;   */
CREATE TABLE notifications (
    id INT AUTO_INCREMENT,
    user_id INT NOT NULL,
    generator_user_id INT NOT NULL, /* -1 when the notification is not generated by another user */
    type VARCHAR(128) NOT NULL,
    object_id INT,
    is_read BOOL NOT NULL DEFAULT 0,
    date TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    /*FOREIGN KEY (generator_user_id) REFERENCES users(id) ON DELETE CASCADE*/
);

CREATE TABLE challenges (
    id INT AUTO_INCREMENT,
    userA INT NOT NULL,
    userB INT NOT NULL,
    exId INT NOT NULL,
    winner INT,
    PRIMARY KEY (id),
    FOREIGN KEY (userA) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (userB) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (exId) REFERENCES exercises(id) ON DELETE CASCADE
);

CREATE TABLE guides (
    id INT AUTO_INCREMENT,
    writerId INT NOT NULL,
    title VARCHAR(50) NOT NULL UNIQUE,
    content TEXT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (writerId) REFERENCES users(id) ON DELETE CASCADE
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
BEFORE INSERT ON answers
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

/* Make sure title and content are not empty. */
delimiter //
CREATE TRIGGER check_guide
BEFORE INSERT ON guides
FOR EACH ROW 
BEGIN
    IF NEW.title = "" THEN
        SET NEW.title = Null;
    END IF;
    IF NEW.content = "" THEN
        SET NEW.content = Null;
    END IF;
END;//
