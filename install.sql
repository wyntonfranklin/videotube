CREATE TABLE `categories` (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `name` varchar(45) DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `comments` (
                            `id` int(11) NOT NULL,
                            `videoId` int(11) DEFAULT NULL,
                            `responseTo` int(11) DEFAULT NULL,
                            `datePosted` varchar(45) DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `dislikes` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `videoId` int(11) DEFAULT NULL,
                            `username` varchar(45) DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `likes` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `videoId` int(11) DEFAULT NULL,
                         `username` varchar(45) DEFAULT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `subscribers` (
                               `id` int(11) NOT NULL AUTO_INCREMENT,
                               `userTo` int(11) DEFAULT NULL,
                               `userFrom` int(11) DEFAULT NULL,
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `thumbnails` (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `videoId` int(11) DEFAULT NULL,
                              `selected` int(11) DEFAULT NULL,
                              `filePath` varchar(125) DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `users` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `username` varchar(45) DEFAULT NULL,
                         `firstName` varchar(45) DEFAULT NULL,
                         `lastName` varchar(45) DEFAULT NULL,
                         `email` varchar(45) DEFAULT NULL,
                         `profilePic` varchar(45) DEFAULT NULL,
                         `signUpDate` varchar(45) DEFAULT NULL,
                         `password` varchar(225) DEFAULT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `videos` (
                          `id` int(11) NOT NULL AUTO_INCREMENT,
                          `uploadedBy` varchar(45) DEFAULT NULL,
                          `title` varchar(45) DEFAULT NULL,
                          `description` varchar(45) DEFAULT NULL,
                          `privacy` varchar(45) DEFAULT NULL,
                          `filePath` varchar(45) DEFAULT NULL,
                          `category` varchar(45) DEFAULT NULL,
                          `uploadDate` varchar(45) DEFAULT NULL,
                          `views` int(11) DEFAULT NULL,
                          `duration` varchar(45) DEFAULT NULL,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
