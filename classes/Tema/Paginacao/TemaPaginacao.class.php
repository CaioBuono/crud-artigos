<?php
/**
 * Classe responsavel por renderizar o layout de paginacao da aplicacao
 * 
 * @class TemaPaginacao
 * 
 * @author Caio Buono <caio.buono8@gmail.com>
 */

namespace Tema\Paginacao;

use Tema\TemaLayout;

class TemaPaginacao{

  /**
   * Metodo responsavel por retornar o layout de prev, nex e pagina atual da paginacao
   * @method getLayoutItensPaginacao
   * @param Int $totalPaginas
   * @param Int $paginaAtual
   * @return String[html]
   */
  public static function getLayoutItensPaginacao(Int $totalPaginas, Int $paginaAtual){
    if($totalPaginas <= 1) return '';

    $retornoBotao = self::getLayoutBotoes($totalPaginas, $paginaAtual);
    
    $varLayout    = [
      'prevPagina'             => max(1, $paginaAtual - 1),
      'nextPagina'             => min($totalPaginas, $paginaAtual + 1),
      'retornoBotoesPaginacao' => $retornoBotao,
    ];

    return TemaLayout::getLayout($varLayout, 'estrutura/paginacao', 'estrutura-paginacao.html');
  }

  private static function getLayoutBotoes(Int $totalPaginas, Int $paginaAtual){
    $retorno = null;
    for($i =  1; $i <= $totalPaginas; $i++){
      $varLayout = [
        'classeSelecao' => ($i == $paginaAtual) ? 'selecionado' : '',
        'pagina'        => $i
      ];

      $retorno .= TemaLayout::getLayout($varLayout, 'estrutura/paginacao/item', 'estrutura-paginacao-item.html');
    }

    return $retorno;
  }
}