<!DOCTYPE html>
<html lang="pt-BR">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="estilo/senha.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'acoes/mensagem.php';
require_once 'acoes/conexao.php';
require_once 'acoes/hash.php';

session_start();
$home = "http://localhost/sistema_crud/";
$login = Safe::decode($_SESSION['userNome'], date('DMYH'), true);
$senha = $_SESSION['userPass'];

$home = "http://localhost/sistema_crud/";
?>

<body class="p-3 mb-2 bg-info text-white">
    <h1> Mudar senha </h1>
    <form   class="shadow p-3 mb-5 bg-white rounded" method="POST" action="acoes/updateSenha.php">
        <div class="form-group">
            <input  type="password" onfocusout="verificaSenha()" id="antSenha" class="form-control"required="">
            <small class="form-text text-muted">Digite a senha antiga</small>
        </div>
        <div class="form-group">
            <input type="password"  id="senha" name="senha" class="form-control" required="">
            <small class="form-text text-muted">Digite a nova senha</small>
        </div>
        <div class="form-group">
            <input type="password"  onfocusout="validarSenha()"  id="senha1" class="form-control" required="">
            <small class="form-text text-muted">Confirmar a nova senha</small></br>   
            <button type="submit" name="btn-senha" class="btn btn-primary">Salvar</button>
            <input type="button" class="btn btn-danger"  onclick="window.location='home.php'" value="Cancelar">
        </div>
    </form>

<script>
function verificaSenha(){ 
    $.ajax({
        url:'<?=$home?>acoes/verificaSenhaBanco.php', // Send
        type:'POST', // Back
        dataType:'JSON',//Back
        data://Send and Back
        {   
            action : 'ver_senha',
            senha:  '<?=$senha?>',
            senhaDig: $('#antSenha').val() 
        },
        success:function(data){
            if(data.status == true){
                swal (data.msg,'')
                $('#antSenha').val('')
            }else{
                return false;
            }

        },
    })
}
</script>

<!-- <script>
function mudarSenha(){
    var antSenha = document.getElementById('antSenha').value.trim()
    var senha =  document.getElementById('senha').value.trim()

    if(antSenha == senha){
        return alert('A senhas nao podem ser a mesma','')
    }else{
        $.ajax({
            url:'<?=$home?>acoes/updateSenha.php', // Send
            type:'POST', // Back
            dataType:'JSON',//Back
            data://Send and Back
            {
            action: 'senha',
            senha : $('#senha').val()
            },
            //aqui
            success:function(data){//Did Back
                if(data.status == true){
                    swal (data.msg,'') 
                }else{
                    swal (data.msg,'')
                }
            },
            error:function(e){//nem foi deu erro de conexao ou url
                alert('Erro ao se comunicar com o servidor.')
            }
        })
    }
}
</script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js" ></script>
<script src = "js/script.js" ></script> 
</body>
</html>