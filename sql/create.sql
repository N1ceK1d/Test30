CREATE TABLE Services (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE Questions (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    question_text VARCHAR(255) NOT NULL,
    characteristic_id INT NOT NULL,
    FOREIGN KEY (characteristic_id) REFERENCES Characteristics (id)
);

CREATE TABLE Answers (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    answer_text VARCHAR(255) NOT NULL,
    question_id INT NOT NULL,
    points INT NOT NULL,
    FOREIGN KEY (question_id) REFERENCES Questions (id)
);