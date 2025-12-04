<?php
/**
 * Classe responsavel por manipular os arquivos de template/layout do projeto
 * 
 * @class TemaLayout
 * 
 * @author Caio Buono <caio.buono8@gmail.com>
 */

namespace Tema;
 
class TemaLayout{

  /**
   * Metodo responsavel por retornar o caminho do template da pagina a ser renderizada
   * @method getTemplate
   * @param String $pasta
   * @param String $arquivo
   * @return String
   */
  public static function getTemplate(String $pasta, String $arquivo){
    if(!strlen($pasta) or !strlen($arquivo)) return null;

    $caminho = CAMINHO_TEMPLATE . $pasta . '/' . $arquivo;

    if(!file_exists($caminho)) die('Arquivo de layout nāo encontrado' . $caminho);

    return $caminho;
  }

  /**
   * Metodo responsavel por retornar o arquivo de layout renderizado por completo
   * @method getLayout
   * @param Array $variaveis
   * @param String $pasta
   * @param String $arquivo
   * @return String[html]
   */
  public static function getLayout(Array $variaveis, String $pasta, String $arquivo){
    if(!strlen($pasta) or !strlen($arquivo)) return null;

    $caminho = CAMINHO_LAYOUT . $pasta . '/' . $arquivo;

    if(!file_exists($caminho)) die('Arquivo de layout nāo encontrado: ' . $caminho);

    $conteudoArquivo = file_get_contents($caminho);

    $conteudoArquivo = (!empty($variaveis)) ? self::deparaConteudo($variaveis, $conteudoArquivo)
                                            : $conteudoArquivo;

    return $conteudoArquivo;
  }

  /**
   * Metodo responsavel por realizar o depara das variaveis de interpolacao pelos html gerados
   * @method deparaConteudo
   * @param Array $variaveis
   * @param String $conteudo
   * @return String[html]
   */
  private static function deparaConteudo(Array $variaveis, String $conteudo){
    foreach($variaveis as $key => $value){
      $conteudo = str_replace('{{' .$key. '}}', $value, $conteudo);
    }

    return $conteudo;
  }

}