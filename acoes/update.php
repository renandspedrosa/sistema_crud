<?php
require_once 'hash.php';
require_once 'conexao.php';
session_start();//deve ter sessao iniada em todas as paginas
if(!isset($_SESSION['userID'])){//verificando se ha sessao
    session_destroy();            //destruindo a sessao para ter segurança
    header("Location: index.php"); 
 
    exit;
}

$id = Safe::decode($_SESSION['userID'], date('DMYH'), true);

if(isset($_POST['btn-editar'])){
    $login = addslashes(trim($_POST['login']));
    $email = addslashes(trim($_POST['email']));
    $nome = addslashes(trim($_POST['nome']));
    $end = addslashes(trim($_POST['end']));   
    $sql = "UPDATE usuario SET user_login = '$login', user_nome_completo = '$nome', user_email = '$email', user_endereco = '$end' WHERE user_id = '$id'";
          
    $stmt = Conexao::conecta()->prepare($sql);
    if ($login == null || $email == null || $nome == null || $end == null){
        header('Location: ../editar.php');
    }else if($stmt->execute()){
            $_SESSION ['mensagem'] = 'Atualizado com sucesso';
            header('Location: ../home.php');
            }else{
                $_SESSION ['mensagem'] = 'erro ao atualizar';
                header('Location: ../home.php');
            }
    }
?>