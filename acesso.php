<?php

use Tema\TemaLayout;
use Sistema\Funcoes;
use Usuario\Usuario;

require __DIR__ . '/includes.php';

if(Usuario::verificarUsuarioLogado()) header('location: /');

$sucessoLogin = true;
if(isset($_POST['btnAcessarPainel']) and Funcoes::validarCamposObrigatorios(['usuario', 'senha'], $_POST)){
  $sucessoLogin = Usuario::logarUsuario($_POST['usuario'], $_POST['senha']);
}

include TemaLayout::getTemplate('pages/acesso', 'pages-acesso-login.php');