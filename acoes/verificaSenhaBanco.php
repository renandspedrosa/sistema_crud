<?php
require_once 'conexao.php';
require_once 'hash.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if(!isset($_SESSION['userID'])){//verificando se ha sessao
    session_destroy();            //destruindo a sessao para ter segurança
    header("Location: index.php"); 
 
    exit;
}
if(isset($_POST['action'])){

    $SenhaDig = md5(addslashes(trim($_POST['senhaDig'])));
    $senha = Safe::decode(addslashes($_POST['senha']), date('DMYH'), true);
    //echo $SenhaDig.'<br>'.$senha;
    if($SenhaDig != $senha){
        exit( json_encode(['status'=>true,'msg'=>'Senha incorreta'])); 
    }



}


?>