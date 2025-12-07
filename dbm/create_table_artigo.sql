CREATE TABLE IF NOT EXISTS `artigo` (
  `id` INT(11) AUTO_INCREMENT,
  `titulo` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `conteudo` TEXT NOT NULL,
  `capa` VARCHAR(255) NULL,
  `data_publicacao` DATE DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE (`slug`)
)