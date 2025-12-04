<?php

use Tema\TemaLayout;

$variaveisPagina = [];
$variaveisPagina['formCadastrarUsuario'] = TemaLayout::getLayout([], 'pages/cadastro/formulario', 'pages-cadastro-formulario-cadastrar.html');
$variaveisPagina['boxErroCadastro'] = (!$sucessoCadastro) ? TemaLayout::getLayout(['mensagem' => $mensagem], 'pages/cadastro/retorno-cadastro', 'pages-cadastro-retorno-cadastro-mensagem-erro.html')
                                                          : '';
                                                          
echo TemaLayout::getLayout($variaveisPagina, 'pages/cadastro', 'pages-cadastro-novo-usuario.html');