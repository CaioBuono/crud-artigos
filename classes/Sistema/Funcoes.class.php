<?php
/**
 * Classe responsavel por definir funcoes padrao de validacao da aplicacao
 * 
 * @class Funcoes
 * 
 * @author Caio Buono <caio.buono8@gmail.com>
 */

namespace Sistema;

class Funcoes{

  /**
   * Metodo responsavel por validar se os campos obrigatorios aparecem nos campos recebidos
   * @method validarCamposObrigatorios
   * @param Array $camposObrigatorios
   * @param Array $camposRecebidos
   * @return Boolean
   */
  public static function validarCamposObrigatorios(Array $camposObrigatorios, Array $camposRecebidos){
    if(empty($camposObrigatorios) or empty($camposRecebidos)) return false;
    
    foreach($camposObrigatorios as $campoObrigatorio){
      if(!isset($camposRecebidos[$campoObrigatorio]) or !strlen($camposRecebidos[$campoObrigatorio])) return false;
    }

    return true;
  }

}