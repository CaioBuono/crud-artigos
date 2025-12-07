<?php

use Artigo\Artigo;
use Paginacao\Paginacao;
use Tema\TemaLayout;

require __DIR__ . '/includes.php';

extract($_GET);

//TITLE HEADER
$tituloCabecalho = 'Artigos';

//RETORNO DOS ARTIGOS PUBLICADOS
$artigosPublicados = Artigo::getArtigos();

$paginaAtual       = isset($p) ? (int) $p : 1;
$paginacao         = new Paginacao($artigosPublicados, 5, $paginaAtual);
$artigosPublicados = $paginacao->getItensPaginaAtual();

//CONTEUDO
include TemaLayout::getTemplate('pages/listagem', 'pages-listagem-artigos.php');

//HEADER
include TemaLayout::getTemplate('estrutura', 'estrutura-header.php');

//FOOTER
include TemaLayout::getTemplate('estrutura', 'estrutura-footer.php');