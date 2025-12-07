<?php

use Tema\Listagem\TemaListagemArtigo;
use Tema\Paginacao\TemaPaginacao;
use Tema\TemaLayout;

$variaveisPagina = [];
$variaveisPagina['retornoArtigos'] = TemaListagemArtigo::getListagemArtigos($artigosPublicados);
$variaveisPagina['paginacao']      = TemaPaginacao::getLayoutItensPaginacao($paginacao->getTotalPaginas(), $paginacao->getPaginaAtual());

$variaveisSistema['conteudo'] = TemaLayout::getLayout($variaveisPagina, 'pages/listagem', 'pages-listagem-artigos.html');