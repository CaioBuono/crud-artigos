<?php
/**
 * Classe responsavel por manipular os dados da referente a tabela de artigos
 * 
 * @class Artigo
 * 
 * @author Caio Buono <caio.buono8@gmail.com>
 */

namespace Artigo;

use Database\Tabela;
use Interface\DeparaObjetos;
use PDO;

class Artigo implements DeparaObjetos{

  /**
   * ID do artigo
   * @var Integer
   */
  protected $id = null;
  
  /**
   * Titulo do artigo
   * @var String
   */
  protected $titulo = null;

  /**
   * Slug de rederecionamento
   * @var String
   */
  protected $slug = null;

  /**
   * Conteudo do artigo
   * @var String
   */
  protected $conteudo = null;

  /**
   * Foto de capa do artigo
   * @var String
   */
  protected $capa = null;

  /**
   * Data da publicacao do artigo
   * @var Date
   */
  protected $dataPublicacao = null;

  /**
   * Metodo responsavel por retornar as propriedades da classe x Colunas do DB
   * @method getPropierties
   * @return Array
   */
  public function getPropierties(): Array{
    return [
      'id'             => $this->id,
      'titulo'         => $this->titulo,
      'slig'           => $this->slug,
      'conteudo'       => $this->conteudo,
      'capa'           => $this->capa,
      'dataPublicacao' => $this->dataPublicacao
    ];
  }


  // ---------- GETTERS ----------
  public function getId() { return $this->id; }
  public function getTitulo() { return $this->titulo; }
  public function getSlug() { return $this->slug; }
  public function getConteudo() { return $this->conteudo; }
  public function getCapa() { return $this->capa; }
  public function getDataPublicacao() { return $this->dataPublicacao; }

  // ---------- SETTERS ----------
  public function setId($id) { $this->id = $id; }
  public function setTitulo($titulo) { $this->titulo = $titulo; }
  public function setSlug($slug) { $this->slug = $slug; }
  public function setConteudo($conteudo) { $this->conteudo = $conteudo; }
  public function setCapa($capa) { $this->capa = $capa; }
  public function setDataPublicacao($dataPublicacao) { $this->dataPublicacao = $dataPublicacao; }

  /**
   * Metodo responsavel por retornar a tabela de manipulacao da classe
   * @method getTabela
   * @return Tabela
   */
  public static function getTabela(){
    return new Tabela('artigo');
  }

  /**
   * Metodo responsavel por realizar o depara do retorno da querie para as propriedades da classe
   * @method deparaQuery
   * @param Mixed $dados
   * @return Usuario
   */
  public static function deparaQuery(Mixed $dados){
    if(empty($dados)) return null;

    $isListagem = array_keys($dados) == range(0, count($dados) - 1);
    if($isListagem) return array_map(fn($e) => self::deparaQuery($e), $dados);

    $class = new self();

    foreach($dados as $campo => $valor){
      $metodo = 'set' .str_replace(' ', '', ucwords(str_replace('_', " ", $campo)));

      if(method_exists($class, $metodo)){
        $class->$metodo($valor);
      }
    }

    return $class;
  }

  /**
   * Metodo responsavel por retornar os artigos publicados da aplicacao
   * @method getArtigos
   * @return Array
   */
  public static function getArtigos(){
    $retornoArtigos = self::getTabela()->select()->fetchAll(PDO::FETCH_ASSOC);

    return self::deparaQuery($retornoArtigos);
  }

  public static function getAutoresVinculados(Int $id){
    if(!is_numeric($id)) return null;

    return (new Tabela('artigo_usuario'))->select('id_artigo = ' .$id)->fetchAll(PDO::FETCH_ASSOC);
  }
}