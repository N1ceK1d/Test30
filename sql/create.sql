CREATE TABLE Services (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE Questions (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    question_text VARCHAR(255) NOT NULL,
    service_id INT NOT NULL,
    FOREIGN KEY (service_id) REFERENCES Services (id)
);

CREATE TABLE Answers (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    answer_text VARCHAR(255) NOT NULL,
    question_id INT NOT NULL,
    points INT NOT NULL,
    FOREIGN KEY (question_id) REFERENCES Questions (id)
);