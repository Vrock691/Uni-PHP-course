CREATE TABLE
    `posts` (
        `postID` int unsigned NOT NULL AUTO_INCREMENT,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `content` longtext NOT NULL,
        `title` varchar(255) DEFAULT NULL,
        `desc` varchar(255) DEFAULT NULL,
        `author` int unsigned NOT NULL DEFAULT '0',
        PRIMARY KEY (`postID`)
    )