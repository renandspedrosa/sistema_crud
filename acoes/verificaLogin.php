<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'conexao.php';
require_once 'hash.php';

switch($_POST['action']){
  case 'ver_login':
    ver_login();
  break;
  case 'ver_login_up':
    var_login_up();
  break;

}

function ver_login(){

    $login = trim($_POST['login']);

    $sql = "SELECT * FROM usuario WHERE user_login = '$login'";

    $result = Conexao::conecta()->query($sql)->fetchAll();

    $contador = (is_array($result)? count($result) : 0);

    if($contador >= 1) {
        exit( json_encode(['status'=>false,'msg'=>'Usuario Já Cadastrado ']));
      } else {     
        exit( json_encode(['status'=>true,'msg'=>'Usuário disponivel']));  
    }     
   
}



function var_login_up(){
  
session_start();//deve ter sessao iniada em todas as paginas
if(!isset($_SESSION['userID'])){//verificando se ha sessao
    session_destroy();            //destruindo a sessao para ter segurança
    header("Location: ../index.php"); exit;
}

  $loginS = Safe::decode($_SESSION['userNome'], date('DMYH'), true);
  $login = trim($_POST['login']);

  $sql = "SELECT * FROM usuario WHERE user_login = '$login'";

  $result = Conexao::conecta()->query($sql)->fetchAll();

  $contador = (is_array($result)? count($result) : 0);

  if($login == $loginS){
    
    exit( json_encode(['status'=>true,'msg'=>'Usuário disponivel']));

  }else if ($contador >= 1) {

        exit( json_encode(['status'=>false,'msg'=>'Usuario Já Cadastrado ']));

  } else {

        exit( json_encode(['status'=>true,'msg'=>'Usuário disponivel']));  
    }     
}
