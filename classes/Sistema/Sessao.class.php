<?php
/**
 * Classe responsavel por controlar a sessao do usuario
 * 
 * @class Sessao
 * 
 * @author Caio Buono <caio.buono8@gmail.com>
 */

namespace Sistema;

use Usuario\Usuario;

class Sessao{

  /**
   * Metodo responsavel por definir a sessao do usuario logado
   * @method setSessaoUsuarioLogado
   * @param Usuario $obUsuario
   * @return Void
   */
  public static function setSessaoUsuarioLogado(Usuario $obUsuario){
    $_SESSION['usuario']          = [];
    $_SESSION['usuario']['id']    = $obUsuario->getId();
    $_SESSION['usuario']['nome']  = $obUsuario->getNome();
    $_SESSION['usuario']['email'] = $obUsuario->getEmail();
  }

}