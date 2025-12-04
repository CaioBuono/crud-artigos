<?php

use Tema\TemaLayout;


$variaveisPagina = [];

$variaveisPagina['boxAcessoUsuario']  = TemaLayout::getLayout([], 'pages/acesso/formulario', 'pages-acesso-formulario-acessar-usuario.html');
$variaveisPagina['boxLoginIncorreto'] = (!$sucessoLogin) ? TemaLayout::getLayout(['mensagem' => 'Usuário ou senha incorretos'], 'pages/acesso/retorno-login', 'pages-acesso-retorno-login-usuario-incorreto.html') 
                                                         : '';

echo TemaLayout::getLayout($variaveisPagina, 'pages/acesso', 'pages-acesso-login.html');