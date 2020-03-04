<?php
include_once 'acoes/mensagem.php';
require_once 'acoes/conexao.php';
require_once 'acoes/hash.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if(!isset($_SESSION['sessaoID']) || $login != $_SESSION['sessaoID']){
    //verificando se ha sessao
      session_destroy();            //destruindo a sessao para ter segurança
      header("Location: logout.php"); exit;  
  }


if(isset($_POST['action'])){
    $id =  Safe::decode($_SESSION['userID'], date('DMYH'), true);
    $senha = md5($_POST['senha']);
    $sql = '"UPDATE usuario SET user_senha = '$senha' WHERE user_id = '$id'";'
    $stmt = Conexao::conecta()->prepare($sql);

    if($stmt->execute()){
        exit( json_encode(['status'=>true,'msg'=>'Cliente atualizado'])); 
    }else{
        exit( json_encode(['status'=>true,'msg'=>'Erro ao atualizar'])); 
    }
}


?>