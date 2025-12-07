CREATE TABLE IF NOT EXISTS `artigo_usuario` (
  `id_artigo` INT(11) NOT NULL,
  `id_usuario` INT(11) NOT NULL,
  PRIMARY KEY (`id_artigo`, `id_usuario`)
)