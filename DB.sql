-- artists table
CREATE TABLE `artists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- albums table
CREATE TABLE `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `cover_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`artist_id`) REFERENCES `artists`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- songs table
CREATE TABLE `songs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `album_order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`artist_id`) REFERENCES `artists`(`id`),
  FOREIGN KEY (`album_id`) REFERENCES `albums`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add some sample data (adjust paths as needed)
INSERT INTO `artists` (`id`, `name`) VALUES
(1, 'Daddy Yankee'),
(2, 'Don Omar');

INSERT INTO `albums` (`id`, `title`, `artist_id`, `cover_path`) VALUES
(1, 'Barrio Fino (Bonus Track Version)', 1, 'assets/images/barrio_fino.jpg'),
(2, 'The Last Don', 2, 'assets/images/the_last_don.jpg');

INSERT INTO `songs` (`id`, `title`, `artist_id`, `album_id`, `duration`, `file_path`, `album_order`) VALUES
(1, 'Gasolina', 1, 1, '3:13', 'assets/music/gasolina.mp3', 1),
(2, 'Lo Que Pasó, Pasó', 1, 1, '3:31', 'assets/music/lo_que_paso.mp3', 2),
(3, 'Dile', 2, 2, '3:25', 'assets/music/dile.mp3', 1),
(4, 'Dale Don Dale', 2, 2, '3:32', 'assets/music/dale_don_dale.mp3', 2);