<?php
include_once 'mensagem.php';
require_once 'conexao.php';
require_once 'hash.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$login = Safe::decode($_SESSION['userNome'], date('DMYH'), true);

if(!isset($_SESSION['sessaoID']) || $login != $_SESSION['sessaoID']){
    //verificando se ha sessao
      session_destroy();            //destruindo a sessao para ter segurança
      header("Location: ../logout.php"); exit;  
  }


if(isset($_POST['btn-senha'])){
    $id =  Safe::decode($_SESSION['userID'], date('DMYH'), true);
    $senha = md5($_POST['senha']);
    $sql = "UPDATE usuario SET user_senha = '$senha' WHERE user_id = '$id'";
    $stmt = Conexao::conecta()->prepare($sql);
    if($stmt->execute()){
     $_SESSION ['mensagem'] = 'Atualizado com sucesso';
     $_SESSION['userPass'] = Safe::encode($senha, date('DMYH'), true);
     header('Location: ../home.php');
    }else{
      $_SESSION ['mensagem'] = 'Erro ao atualizar';
      header('Location: ../home.php');
    }
}


?>