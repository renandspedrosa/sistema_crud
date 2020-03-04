<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//sessao
session_start();

//conexao
require_once 'conexao.php';

if (isset($_POST['action'])) {

	$id = $_POST['id'];
	$sql = "DELETE FROM `sistema`.`clientes` WHERE clt_id = '$id'"; 
    $exec = Conexao::conecta()->prepare($sql);
    $exec->execute();
    exit( json_encode(['status'=>true,'msg'=>'Cliente deletado'])); 
}