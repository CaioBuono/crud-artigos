<?php
/**
 * Classe responsavel por manipuar a renderizacao da pagina de listagem da aplicacao
 * 
 * @class TemaListagemArtigo
 * 
 * @author Caio Buono <caio.buono8@gmail.com>
 */

namespace Tema\Listagem;

use Artigo\Artigo;
use Tema\TemaLayout;

class TemaListagemArtigo{


  public static function getListagemArtigos(Array $retornoArtigos){
    if(empty($retornoArtigos)) return '';

    $retorno = null;
    foreach($retornoArtigos as $obArtigo){
      $varLayout = [
        'titulo'  => $obArtigo->getTitulo(),
        'resumo'  => $obArtigo->getConteudo(),
        'autores' => self::getAutoresArtigo($obArtigo)
      ];

      $retorno .= TemaLayout::getLayout($varLayout, 'pages/listagem/artigo-item', 'pages-listagem-artigo-item-resultado.html');
    }

    return $retorno;
  }

  /**
   * Metodo responsavel por retornar os autores vinculados ao artigo
   * @method getAutoresArtigo
   * @param Artigo $obArtigo
   * @return String[html]
   */
  private static function getAutoresArtigo(Artigo $obArtigo){
    if(!$obArtigo instanceof Artigo) return null;

    $autoresVinculados    = Artigo::getAutoresVinculados($obArtigo->getId());
    $idsAutoresVinculados = array_map(function($e){return $e['id_usuario'];}, $autoresVinculados);
    
    $retorno = null;
    foreach($idsAutoresVinculados as $idAutor){
      //IMPLEMENTAR IMAGEM AUTORES (CAIO)
      $retorno .= TemaLayout::getLayout([], 'pages/listagem/artigo-autor', 'pages-listagem-artigo-autor-item.html');
    }

    return $retorno;
  }
}