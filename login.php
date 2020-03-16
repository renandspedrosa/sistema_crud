<?php
   require_once 'acoes/conexao.php';
   require_once 'acoes/hash.php';

   $login = $_POST['login']; //atribui o dados do login e senha passando por ajax
   $senha = md5($_POST['senha']);
   $secretKey = "6LdX2uAUAAAAALPJTVQXGji839kDOJd_b_UAONZD";
   $responseKey = $_POST['g-recaptcha-response'];
   $userIP = $_SERVER['REMOTE_ADDR'];

    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    $response = file_get_contents($url);
    $response = json_decode($response);

    // //consutando os dados no banco
    $sql="select * from usuario where user_login='$login' and user_senha ='$senha'";
    $result  = Conexao::conecta()->query($sql)->fetchAll(PDO::FETCH_ASSOC)[0]; //faz a consulta e trnasforma no array
    $contador = (is_array($result)? count($result) : 0);//no array 7.2 nao conta o valor null por conta teve que fazer essa gambiarra

        if($response->success){
            if(count($contador) >= 1 && !isset($_SESSION)){//verifica se ja tem uma sessao aberta e se o array
                session_start(); //inicia a sessao
                //atribuindo valores da sessao
                $_SESSION['sessaoID'] = $result['user_login'];
                $_SESSION['userID'] = Safe::encode($result['user_id'], date('DMYH'), true);
                $_SESSION['userNome'] = Safe::encode($result['user_login'], date('DMYH'), true);
                $_SESSION['userPass'] = Safe::encode($result['user_senha'], date('DMYH'), true);
                header('Location: home.php');
            }else{
                header('Location: logout.php');
            }
        }else{
            header('Location: index.php');
        }


?>
