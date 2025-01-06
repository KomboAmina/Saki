CREATE TABLE `projects`(
    id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    projectcode VARCHAR(12) NOT NULL,
    body TEXT,
    status ENUM('open','completed','closed'),

    PRIMARY KEY(id),
    UNIQUE(projectcode)
);

CREATE TABLE `tasks`(
    id INT(30) NOT NULL AUTO_INCREMENT,
    projectid INT(11) NOT NULL,
    task VARCHAR(100) NOT NULL,
    taskbody TEXT,
    priority INT(1) NOT NULL DEFAULT 0,
    iscomplete BOOLEAN NOT NULL DEFAULT false,

    PRIMARY KEY(id),
    FOREIGN KEY(projectid) REFERENCES `projects`(id)
);

CREATE TABLE `nestedtasks`(
    id INT(50) NOT NULL AUTO_INCREMENT,
    maintask INT(30) NOT NULL,
    linkedtask INT(30) NOT NULL,

    PRIMARY KEY(id),
    FOREIGN KEY(maintask) REFERENCES `tasks`(id),
    FOREIGN KEY(linkedtask) REFERENCES `tasks`(id)
);
