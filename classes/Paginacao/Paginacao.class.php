<?php
/**
 * Classe responsavel por realizar as paginacoes de listagem da aplicacao
 * 
 * @class Paginacao
 * 
 * @author Caio Buono <caio.buono8@gmail.com>
 */

namespace Paginacao;

class Paginacao{
  
  /**
   * Registros retornados da tabela para paginacao
   * @var Array
   */
  private $dados = null;

  /**
   * Quantidade de dados por pagina
   * @var Integer
   */
  private $qtdPorPagina = null;

  /**
   * Pagina de dados atual
   * @var Integer
   */
  private $paginaAtual = null;  

  /**
   * Total de dados para serem renderizados
   * @var Integer
   */
  private $total = null;

  /**
   * Total de paginas na paginacao
   * @var Integer
   */
  private $totalPaginas = null;

  /**
   * Metodo construtor para definir os dados do objeto
   * @method __construct
   * @param Array $dados
   * @param integer $qtdPorPagina
   * @param integer $paginaAtual
   */
  public function __construct(Array $dados, Int $qtdPorPagina = 5, Int $paginaAtual = 1){
    $this->setDados($dados);
    $this->setQtdPorPagina($qtdPorPagina);
    $this->setPaginaAtual($paginaAtual);
    $this->setTotal(count($dados));
    $this->setTotalPaginas(ceil($this->getTotal() / $this->getQtdPorPagina()));
  }

  // ---------- GETTERS ----------
  public function getDados() { return $this->dados; }
  public function getQtdPorPagina() { return $this->qtdPorPagina; }
  public function getPaginaAtual() { return $this->paginaAtual; }
  public function getTotal() { return $this->total; }
  public function getTotalPaginas() { return $this->totalPaginas; }
  
  // ---------- SETTERS ----------
  public function setDados($dados) { $this->dados = $dados; }
  public function setQtdPorPagina($qtdPorPagina) { $this->qtdPorPagina = $qtdPorPagina; }
  public function setPaginaAtual($paginaAtual) { $this->paginaAtual = $paginaAtual; }
  public function setTotal($total) { $this->total = $total; }
  public function setTotalPaginas($totalPaginas) { $this->totalPaginas = $totalPaginas; }

  /**
   * Metodo responsavel por retornar os itens da pagina atual sendo visuaizada
   * @method getItensPaginaAtual
   * @return Array
   */
  public function getItensPaginaAtual(){
    $inicio = ($this->getPaginaAtual() - 1) * $this->getQtdPorPagina();
    return array_slice($this->getDados(), $inicio, $this->getQtdPorPagina()); 
  }


}