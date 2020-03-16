<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo/style.css">
    <title>Sistema</title>
</head>
<body class="p-3 mb-2 bg-info text-white">
    <form   class="shadow p-3 mb-5 bg-white rounded" id="formlogin" action="login.php" method="POST">
        <div class="form-group">
            <label  >Usuário</label>
            <input type="text"  class="form-control" name="login" id="login" required="">
            <small class="form-text text-muted">Digite o seu usuário</small>
        </div>
        <div class="form-group">
            <label>Senha</label>
            <input type="password" class="form-control"  name="senha" id="senha" required=""></br>
            <p><button type="submit"  class="btn btn-primary">Entrar</button>&nbsp;&nbsp;<a href="cadastrar.php">Não sou cadastrado</a></p>
            <div class="g-recaptcha" data-sitekey="6LdX2uAUAAAAADu9Fynu7cVpfHkUtavUPSPk1cky"></div>
            <span id="captcha_error" class="text-danger"></span>
            
        </div>
    </form>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js" ></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>