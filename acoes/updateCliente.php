<?php
require_once 'hash.php';
require_once 'conexao.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();//deve ter sessao iniada em todas as paginas
if(!isset($_SESSION['userID'])){//verificando se ha sessao
    session_destroy();            //destruindo a sessao para ter segurança
    header("Location: index.php"); 
 
    exit;
}

if(isset($_POST['action'])){
    $numId = addslashes(trim($_POST['id']));
    $id = Safe::decode($numId, date('DMYH'), true);
    $nome = addslashes(trim($_POST['nome']));
    $nomeMae = addslashes(trim($_POST['nomeMae']));
    $cpf = addslashes(trim($_POST['cpf']));
    $tel = addslashes(trim($_POST['tel']));
    $cel = addslashes(trim($_POST['cel']));

    $sql = "UPDATE clientes SET clt_nome = '$nome', clt_nome_mae = '$nomeMae', clt_cpf = '$cpf', clt_tel = '$tel', clt_cel = '$cel' WHERE clt_id = '$id'";
          
    $stmt = Conexao::conecta()->prepare($sql);
    $stmt->execute();
    exit( json_encode(['status'=>true,'msg'=>'Cliente atualizado'])); 
}
    // if ($login == null || $email == null || $nome == null || $end == null){
    //     header('Location: ../editar.php');
    // }else if($stmt->execute()){
    //         $_SESSION ['mensagem'] = 'Atualizado com sucesso';
    //         header('Location: ../home.php');
    //         }else{
    //             $_SESSION ['mensagem'] = 'erro ao atualizar';
    //             header('Location: ../home.php');
    //         }
    // }

?>