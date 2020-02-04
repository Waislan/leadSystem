<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leader - Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body style="background-image: url(img/background.png);">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">Seja bem-vindo</div>
                <div class="panel-body">
                    <form id="formLogin">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" id="inputEmail" name="inputEmail" type="email">
                            <input class="form-control" placeholder="Senha" id="inputSenha" name="inputSenha" type="password">
                            <small id="alertLoginInvalido" class="form-text text-muted mb-4" style="color: red;" hidden>
                                Usuário ou senha inválidos.
                            </small>
                            <div class="checkbox">
                                <label>
                                    <input id="remember" name="remember" type="checkbox" value="Remember Me">Lembrar
                                </label>
                            </div>
                        </div>
                        <div class="row" style="display: flex; justify-content: center;">
                            <button class="btn btn-info" id="btnEntrar" name="btnEntrar" type="button">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>

    <!-- Funções -->
    <script src="js/login.js"></script>
</body>

</html>

<?php
//    }

?>