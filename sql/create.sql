CREATE TABLE Blocks (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    max_points INT NOT NULL
);

CREATE TABLE Questions (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    question_text VARCHAR(255) NOT NULL
);

CREATE TABLE QuestionsBlocks (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    question_id INT NOT NULL,
    block_id INT NOT NULL,
    FOREIGN KEY (question_id) REFERENCES Questions (id),
    FOREIGN KEY (block_id) REFERENCES Blocks (id)
);

CREATE TABLE Answers (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    answer_text VARCHAR(255) NOT NULL,
    question_id INT NOT NULL,
    points INT NOT NULL,
    FOREIGN KEY (question_id) REFERENCES Questions (id)
);

CREATE TABLE Admins (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    login VARCHAR(255) NOT NULL,
    password LONGTEXT NOT NULL
);

CREATE TABLE UsersData (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    employees_count INT NOT NULL,
    user_time DATETIME
);

CREATE TABLE ResultsTexts (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    result_text LONGTEXT NOT NULL,
    block_id INT NOT NULL,
    FOREIGN KEY (block_id) REFERENCES Blocks (id)
);

CREATE TABLE Decisions (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    decision_text LONGTEXT NOT NULL,
    block_id INT NOT NULL,
    FOREIGN KEY (block_id) REFERENCES Blocks (id)
);