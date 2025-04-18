CREATE TABLE
    `users` (
        `userID` int unsigned NOT NULL AUTO_INCREMENT,
        `name` varchar(255) DEFAULT NULL,
        `password` varchar(255) DEFAULT NULL,
        `bio` varchar(255) DEFAULT NULL,
        `status` varchar(255) DEFAULT NULL,
        PRIMARY KEY (`userID`)
    )