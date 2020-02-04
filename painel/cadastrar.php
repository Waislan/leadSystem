<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leader - Cadastro</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body style="background-image: url(img/background.png);">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">Informe os dados do usuário</div>
                <div class="panel-body">
                    <form id="formCadastro" class="text-center border border-light p-5">

                        <p class="h4 mb-4">Cadastro</p>

                        <div class="form-row mb-4">
                            <div class="col">
                                <input type="text" id="inputNome" name="inputNome" class="form-control" placeholder="Nome completo" required>
                                <small id="alertNomeInvalido" class="form-text text-muted mb-4" hidden>
                                    Por favor, digite um nome válido.
                                </small>
                            </div>
                            <div class="col">
                                <input type="text" id="inputLogin" name="inputLogin" class="form-control" placeholder="Login" required>
                                <small id="alertLoginInvalido" class="form-text text-muted mb-4" hidden>
                                    Por favor, digite um login.
                                </small>
                            </div>
                        </div>

                        <input type="email" id="inputEmail" name="inputEmail" class="form-control mb-4" placeholder="Email" required>
                        <small id="alertEmailInvalido" class="form-text text-muted mb-4" hidden>
                            Por favor, digite um email válido.
                        </small>

                        <input type="password" id="inputSenha" name="inputSenha" class="form-control" placeholder="Senha" aria-describedby="defaultRegisterFormPasswordHelpBlock" required>
                        <small id="alertSenhaInvalida" class="form-text text-muted mb-4" hidden>
                            Por favor, digite uma senha válida.
                        </small>
                        <small class="form-text text-muted mb-4">
                            Mínimo de 8 caracteres e 1 dígito
                        </small>

                        <input type="text" id="inputEmailRecuperacao" name="inputEmailRecuperacao" class="form-control" placeholder="Email para recuperação" aria-describedby="defaultRegisterFormPhoneHelpBlock">
                        <small class="form-text text-muted mb-4">
                            Opcional
                        </small>

                        <div class="d-flex justify-content-start">
                            <input type="checkbox" class="form-check-input" id="checkMaster">
                            <label for="checkMaster">Administrador master</label>
                        </div>
                        <!-- Newsletter -->
                        <!--
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="defaultRegisterFormNewsletter">
                            <label class="custom-control-label" for="defaultRegisterFormNewsletter">Desejo receber novidades por email</label>
                        </div>
                        -->
                        <!-- Sign up button -->
                        <div class="row">
                            <button style="margin-top: 40px;" id="btnCadastrar" name="btnCadastrar" class="btn btn-info my-4 " type="button">Cadastrar</button>
                        </div>
                        <div class="row" >
                            <a href="login.php" style="color: black;">Voltar</a>
                        </div>
                        <hr>

                        <p>Clicando em
                            <em>cadastrar</em> você aceita com nossos
                            <a href="" target="_blank">termos de serviços</a>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Funções -->
    <script src="js/cadastrar.js"></script>
</body>

</html>

<?php
//    }

?>