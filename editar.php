
<!DOCTYPE html>
<html lang="pt-BR">
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/editar.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo/editar.css">

    <title>Editar</title>
</head>
<?php
require_once 'acoes/conexao.php';
require_once 'acoes/hash.php';

session_start();

$login = Safe::decode($_SESSION['userNome'], date('DMYH'), true);

if(!isset($_SESSION['sessaoID']) || $login != $_SESSION['sessaoID']){
  //verificando se ha sessao
    session_destroy();            //destruindo a sessao para ter segurança
    header("Location: logout.php"); exit;  
}

$id = Safe::decode($_SESSION['userID'], date('DMYH'), true);

$sql = "select * from usuario where user_id ='$id'";

$result = Conexao::conecta()->query($sql)->fetchAll()[0];

$home = "http://localhost/sistema/";

?>

<body class="p-3 mb-2 bg-info text-white">
<?php include_once 'acoes/mensagem.php'; ?>
    <h1> Atualização de Dados</h1>

    <form action="acoes/update.php" class="shadow p-3 mb-5 bg-white rounded" method="POST" >
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Login : </label>
                <input type="text"  class="form-control" name="login" id="login" value="<?php echo $result['user_login']; ?>" require></br>
                <div onclick="verificarLogin()" class="btn btn-success" >Verificar disponibilidade</div>
            </div>
            <div class="form-group col-md-6">
                <label>E-mail : </label>
                <input type="email"  class="form-control" name="email" id="user_nome_completo" value="<?php echo $result['user_email']; ?>" require>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Nome completo:  </label>
                <input type="text" class="form-control" name="nome" id="user_nome_completo" value="<?php echo $result['user_nome_completo']; ?>" require>
            </div>
            <div class="form-group col-md-6">
                <label>Endereço: </label>
                <input type="text" class="form-control" name="end" id="user_endereco" value="<?php echo $result['user_endereco']; ?>" require>
            </div>
        </div>
        <button type="submit" name="btn-editar" class="btn btn-primary">Salvar</button>
        <input type="button" class="btn btn-danger"  onclick="window.location='home.php'" value="Cancelar">
    </form>

<script>
    function verificarLogin(){
        var campo = document.getElementById('login').value.trim()

        if(campo == ""){
            return swal ('o campo precisa ser preenchido','')
        }else{
            $.ajax({
                url:'<?=$home?>acoes/verificaLogin.php', // Send
                type:'POST', // Back
                dataType:'JSON',//Back
                data://Send and Back
                {
                    action        : 'ver_login_up',
                    login       : $('#login').val()
                            
                    },
            //aqui
                success:function(data){//Did Back
                    
                    if(data.status == true){
                            var borda = document.getElementById('login')
                            borda.style.background = "#9efbb4d9"
                            swal (data.msg,'')
                            
                    }else{
                            var borda = document.getElementById('login')
                            borda.style.background = "#fb9e9ed9"
                            swal (data.msg,'')
                        }
                    },
                        error:function(e){//nem foi deu erro de conexao ou url
                            alert('Erro ao se comunicar com o servidor.')
                        }
            })
        }
    }
</script>





<script src="https://use.fontawesome.com/19a91ab86c.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js" ></script> 
<script src="js/script.js"></script>
</body>
</html>

