CREATE TABLE User(
    id INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    fullName VARCHAR(100) NOT NULL,
    active TINYINT(1) DEFAULT 1
    PRIMARY KEY(id)
);

CREATE TABLE Tweet (
      id INT AUTO_INCREMENT,
      text TEXT NOT NULL,
      user_id INT,
      PRIMARY KEY(id),
      FOREIGN KEY(user_id) REFERENCES `User`(id) ON DELETE CASCADE
);


CREATE TABLE Comments(
    id INT AUTO_INCREMENT,
    text VARCHAR(255) NOT NULL,
    creation_date DATE NOT NULL,
    user_id INT,
    tweet_id INT,
    PRIMARY KEY(id),
    FOREIGN KEY(tweet_id) REFERENCES Tweet(id) ON DELETE CASCADE
);

CREATE TABLE Messages (
    id INT AUTO_INCREMENT NOT NULL,
    message TEXT NOT NULL,
    readed TINYINT(1) DEFAULT 1,
    PRIMARY KEY(id)
) 

CREATE TABLE User_Messages (
    id INT AUTO_INCREMENT NOT NULL,
    user_id INT NOT NULL,
    message_id INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES `User`(id) ON DELETE CASCADE,
    FOREIGN KEY(message_id) REFERENCES Messages(id) ON DELETE CASCADE
)

