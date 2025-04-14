CREATE TABLE
    `posts` (
        `id` int unsigned NOT NULL AUTO_INCREMENT,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `message` varchar(255) NOT NULL,
        `image` varchar(255) DEFAULT NULL,
        PRIMARY KEY (`id`)
    );