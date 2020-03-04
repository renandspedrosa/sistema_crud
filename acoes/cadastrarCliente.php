<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'conexao.php';
require_once 'hash.php';
session_start();


  if(isset($_POST['action'])){
      $nome = $_POST['nome'];
      $nomeMae = $_POST['nomeMae'];
      $cpf = $_POST['cpf'];
      $tel = $_POST['tel'];
      $cel = $_POST['cel'];
      $id = Safe::decode($_SESSION['userID'], date('DMYH'), true);
      $sql = "INSERT INTO clientes (clt_nome, clt_nome_mae, clt_cpf, clt_tel, clt_cel, clt_user_id) VALUES ('$nome', '$nomeMae', '$cpf','$tel', '$cel','$id')";
      $exec = Conexao::conecta()->prepare($sql);
      $exec->execute();
      exit( json_encode(['status'=>true,'msg'=>'Cliente cadastrado'])); 
  }

?>