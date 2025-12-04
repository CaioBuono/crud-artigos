<?php

use Sistema\Funcoes;
use Tema\TemaLayout;
use Usuario\Usuario;

require __DIR__ . '/../includes.php';

if(Usuario::verificarUsuarioLogado()) header('location: /');

$sucessoCadastro = true;
$mensagem = null;
if(isset($_POST['btnCadastrarUsuario']) and Funcoes::validarCamposObrigatorios(['nome', 'email', 'nivel', 'senha', 'skills'], $_POST)){
  $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
  if($obUsuario instanceof Usuario){
    $sucessoCadastro = false;
    $mensagem = 'O email enviado já está vínculado a um usuário';
  }

  if(!$obUsuario instanceof Usuario and !Usuario::cadastrarUsuario($_POST)) $sucessoCadastro = false;

  if($sucessoCadastro){
    header('location: /acesso.php?success=1');
  }
}

include TemaLayout::getTemplate('pages/cadastro', 'pages-cadastro-novo-usuario.php');