CREATE TABLE IF NOT EXISTS `usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `nivel` ENUM('jr', 'pl', 'sr') NOT NULL DEFAULT 'jr',
  `skills` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`email`)
)