<?php
#Criando a conexão para poder acessar a base de dados
try{
    class Conexao{
        public $conexao;
        public function __construct($dbname,$host,$char,$user,$pass){
            $this->conexao = new PDO("mysql:dbname={$dbname};host={$host};charset={$char}",$user,$pass);
            $this->conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }

    }

}catch(PDOException $e){
    echo 'Error!! '.$e->getMessage();

}
$connect = new Conexao('high','localhost','utf8','root','');
#consulta responsavel para alteração dos dados dinamicamente
$busca = $connect->conexao->query("SELECT *FROM curso ");
