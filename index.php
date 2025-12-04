<?php
use Tema\TemaLayout;

require __DIR__ . '/includes.php';

$tituloCabecalho = 'Artigos';

//CONTEUDO
include TemaLayout::getTemplate('pages/listagem', 'pages-listagem-artigos.php');

//HEADER
include TemaLayout::getTemplate('estrutura', 'estrutura-header.php');

//FOOTER
include TemaLayout::getTemplate('estrutura', 'estrutura-footer.php');