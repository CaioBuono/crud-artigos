<?php
/**
 * Classe responsavel por manipular os usuarios da aplicacao
 * 
 * @class Usuario
 * 
 * @author Caio Buono <caio.buono8@gmail.com>
 */

namespace Usuario;

use Database\Tabela;
use Interface\DeparaObjetos;
use PDO;
use Sistema\Sessao;

class Usuario implements DeparaObjetos{

  /**
   * ID do usuario
   * @var Integer
   */
  protected $id = null;

  /**
   * Nome do usuario
   * @var String
   */
  protected $nome = null;

  /**
   * Email do usuario
   * @var String
   */
  protected $email = null;

  /**
   * Senha do usuario
   * @var string
   */
  protected $senha = null;

  /**
   * Nivel do usuario
   * @var String ENUM(jr, pl, sr)
   */
  protected $nivel = null;

  /**
   * Conjunto de skills do usuario
   * @var string
   */
  protected $skills = null;

  /**
   * Metodo responsavel por retornar as propriedades da classe x Colunas do DB
   * @method getPropierties
   * @return Array
   */
  public function getPropierties(): Array{
    return [
      'id'     => $this->id,
      'nome'   => $this->nome,
      'email'  => $this->email,
      'senha'  => $this->senha,
      'nivel'  => $this->nivel,
      'skills' => $this->skills
    ];
  }


  // ---------- GETTERS ----------
  public function getId() { return $this->id; }
  public function getNome() { return $this->nome; }
  public function getEmail() { return $this->email; }
  public function getSenha() { return $this->senha; }
  public function getNivel() { return $this->nivel; }
  public function getSkills() { return $this->skills; }

  // ---------- SETTERS ----------
  public function setId($id) { $this->id = $id; }
  public function setNome($nome) { $this->nome = $nome; }
  public function setEmail($email) { $this->email = $email; }
  public function setSenha($senha) { $this->senha = $senha; }
  public function setNivel($nivel) { $this->nivel = $nivel; }
  public function setSkills($skills) { $this->skills = $skills; }

  /**
   * Metodo responsavel por retornar a tabela de manipulacao da classe
   * @method getTabela
   * @return Tabela
   */
  public static function getTabela(){
    return new Tabela('usuario');
  }

  /**
   * Metodo responsavel por realizar o login do usuario
   * @method logarUsuario
   * @param String $user
   * @param String $pass
   * @return Boolean
   */
  public static function logarUsuario(String $user, String $pass){
    if(!self::verificarUsuarioExistente($user, $pass, 'email', $usuario)) return false;

    Sessao::setSessaoUsuarioLogado($usuario);

    return true;
  }

  /**
   * Metodo responsavel por cadastrar um novo usuario no sistema
   * @method cadastrarUsuario
   * @param Array $dados
   * @return Boolean
   */
  public static function cadastrarUsuario($dados){
    if(
      !isset($dados['nome']) or !strlen($dados['nome']) or
      !isset($dados['email']) or !strlen($dados['email']) or 
      !isset($dados['nivel']) or !strlen($dados['nivel']) or 
      !isset($dados['senha']) or !strlen($dados['senha'])
    ) return false;

    $novoUsuario = [
      'nome'   => $dados['nome'],
      'email'  => $dados['email'],
      'nivel'  => $dados['nivel'],
      'senha'  => password_hash($dados['senha'], PASSWORD_ARGON2I),
      'skills' => $dados['skills']
    ];

    return self::getTabela()->insert($novoUsuario);
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
   * Metodo responsavel por retornar um usuario do banco pelo email
   * @method getUsuarioPorEmail
   * @param String $email
   * @return Usuario|null
   */
  public static function getUsuarioPorEmail(String $email){
    if(!strlen($email)) return false;

    $retornoUsuario = self::getTabela()->select('email = "' .$email. '"')->fetch(PDO::FETCH_ASSOC);
    return self::deparaQuery($retornoUsuario);
  }

  /**
   * Metodo responsavel por verificar se o usuario esta logado na aplicacao
   * @method verificarUsuarioLogado
   * @return Boolean
   */
  public static function verificarUsuarioLogado(){
    return (isset($_SESSION['usuario']) and !empty($_SESSION['usuario']));
  }
  
  /**
   * Metodo responsavel por verificar se o usuario existe para retornar sucesso no login
   * @method verificarUsuarioExistente
   * @param String $user
   * @param String $pass
   * @param String $campo
   * @return Boolean
   */
  private static function verificarUsuarioExistente(String $user, String $pass, String $campo, Mixed &$obUsuario){
    $condicao = $campo . ' = "' .$user. '"';
    $retornoUsuario = self::getTabela()->select($condicao)->fetch(PDO::FETCH_ASSOC);

    $obUsuario      = self::deparaQuery($retornoUsuario);
    if(!$obUsuario instanceof Usuario) return false;

    return password_verify($pass, $obUsuario->senha);
  }

}