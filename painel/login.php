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
    <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body style="background-image: url(img/background.png);">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">Seja bem-vindo</div>
                <div class="panel-body">
                    <form role="form" method="POST" action="valida-login.php">
                        <fieldset>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email" name="inputEmail" type="text" autofocus="">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Senha" name="inputPassword" type="password" value="">                                
                            </div>
                            <p class="text-center text-danger">
                                <?php
                                    if (isset($_SESSION['loginErro'])) {
                                        echo "<script>alert('$_SESSION[loginErro]')</script>";
                                        unset ($_SESSION['loginErro']);
                                    }
                                ?>
                            </p>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Lembrar
                                </label>
                            </div>
                            <div class="row" style="display: flex; justify-content: center;">
                                <button class="btn btn-info" id="submit" type="submit">Entrar</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->


    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>

<?php
    //    }

?>
