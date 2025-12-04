<?php
/**
 * Classe responsavel por gerenciar a conexao e manipulacao das tabelas do banco de dados
 * 
 * @class Tabela
 * 
 * @author Caio Buono <caio.buono8@gmail.com>
 */

namespace Database;

use Exception;
use PDO;
use PDOException;

class Tabela{

  /**
   * HOST do banco de dados
   * @var String
   */
  const HOST = 'localhost';
  
  /**
   * Nome do banco de dados
   * @var String
   */
  const NAME = 'aplicacao_artigos';

  /**
   * Usuario de acesso
   * @var String
   */
  const USER = 'root';

  /**
   * Senha de acesso
   * @var String
   */
  const PASS = 'toor';

  /**
   * Tabela que esta sendo utilizada
   * @var String
   */
  private $tabela = null;

  /**
   * Conexao com o banco de dados
   */
  private $connection = null;

  /**
   * Metodo construtor responsavel por definir a tabela que sera manipulada e realizar a conexao com o banco de dados
   * @method __construct
   * @param String $nomeTabela
   * @return Void
   */
  public function __construct(String $nomeTabela){
    try{
      $this->tabela     = $nomeTabela;
      $this->connection = new PDO('mysql:host=' .self::HOST. ';dbname=' .self::NAME, self::USER, self::PASS); 
    }catch(PDOException $e){
      throw new Exception('ERROR: ' . $e->getMessage());
    }
  }
  
  /**
   * Metodo responsavel por consultar os registros da tabela que esta setada
   * @method select
   * @param String $where
   * @param String $order
   * @param String $limit
   * @param String $fields
   * @return Statement
   */
  public function select(String $where = '', String $order = '', String $limit = '', String $fields = '*'){
    $where = strlen($where) ? 'WHERE ' .$where : '';
    $order = strlen($order) ? 'ORDER BY ' .$order : '';
    $limit = strlen($limit) ? 'LIMIT ' .$limit : '';

    $query = 'SELECT ' .$fields. ' FROM ' .$this->tabela. ' ' .$where. ' ' .$order. ' ' .$limit;

    return $this->executarSQL($query);
  }

  /**
   * Metodo responsavel por inserir novos registros na tabela setada
   * @method insert
   * @param Array $values
   * @return Integer
   */
  public function insert(Array $values){
    $fields = array_keys($values);

    $binds = array_pad([], count($fields), '?');

    $query = 'INSERT INTO ' .$this->tabela. ' (' .implode(',', $fields). ') VALUES(' .implode(',', $binds). ')';

    $this->executarSQL($query, array_values($values));

    return $this->connection->lastInsertId();
  }

  /**
   * Metodo responsavel por executar as queries no banco de dados
   * @method executarSQL
   * @param String $query
   * @param Array $params
   * @return Void
   */
  private function executarSQL(String $query, Array $params = []){
    try{
      $statement = $this->connection->prepare($query);
      $statement->execute($params);
      return $statement;
    }catch(PDOException $e){
      throw new Exception('ERROR: ' . $e->getMessage());
    }
  }


}