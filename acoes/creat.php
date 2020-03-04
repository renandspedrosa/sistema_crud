<?php 
require_once 'conexao.php';

if(isset($_POST['btn-cadastrar'])){

    $login = addslashes(trim($_POST['login']));
    $senha = addslashes(md5(trim($_POST['senha'])));
    $email = addslashes(trim($_POST['email']));
    $nome = addslashes(trim($_POST['nome']));
    $end = addslashes(trim($_POST['end']));
    
    $verifica = "SELECT user_login FROM usuario WHERE user_login = '$login'";
    $result = Conexao::conecta()->query($verifica)->fetchAll();

    $contador = (is_array($result)? count($result) : 0);

    if($contador >= 1){
        header("Location: ../cadastrar.php");
    }else if ($login == null || $senha == null || $email == null || $nome == null || $end == null){
        header("Location: ../cadastrar.php");
    }else{
        $sql = "INSERT INTO usuario (user_login, user_senha, user_nome_completo, user_endereco, user_email) VALUES ('$login','$senha','$nome','$end','$email')";
        $stmt = Conexao::conecta()->prepare($sql);
        $stmt->execute();
       
        header("Location: ../index.php");
    }
}

?>