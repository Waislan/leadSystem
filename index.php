<?php
    session_start();

    include_once("conexao.php");
?>
<html lang="en">

<head>
    <title>Solicitação de Serviços</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/estilo.css" media="all">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- JQuery Mask -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

<body>
    <p class="h1 text-center">Informe seus dados</p>
    <div class="container">
        <form class="col-lg-4 offset-lg-4">
            <div class="form-group">

                <div class="form-row">
                    <label for="inputNome">Nome</label>
                    <input type="text" class="form-control" id="inputNome" name="inputNome">
                    <small id="alertNomeInvalido" name="alertNomeInvalido" style="color: red;">Digite um nome válido.</small>
                </div>

                <div class="form-row">
                    <label for="inputEmail">Email</label>
                    <input type="text" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="emailHelp" placeholder="email@exemplo.com">
                    <small id="alertEmailInvalido" name="alertEmailInvalido" style="color: red;">Digite um email válido.</small>
                    <!-- <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small> -->
                </div>

                <div class="form-row">
                    <label for="inputTelefone">Telefone</label>
                    <input type="text" class="form-control" id="inputTelefone" name="inputTelefone" placeholder="(99) 99999-9999">
                    <small id="alertTelefoneInvalido" name="alertTelefoneInvalido" style="color: red;">Digite um telefone válido.</small>
                </div>

                <div class="form-row">
                    <label for="inputCep">CEP</label>
                    <input type="text" class="form-control" id="inputCep" name="inputCep" placeholder="99999-999">
                    <small id="alertCepInvalido" name="alertCepInvalido" style="color: red;">Digite um CEP válido.</small>
                </div>

                <div class="form-row">
                    <label for="inputEndereco">Endereço</label>
                    <input type="text" class="form-control" id="inputEndereco" name="inputEndereco">
                    <small id="alertEnderecoInvalido" name="alertEnderecoInvalido" style="color: red;">Digite um endereço válido.</small>
                </div>

                <div class="form-row">
                    <label for="inputNumero">Número</label>
                    <input maxlength="10" type="text" class="form-control" id="inputNumero" name="inputNumero">
                    <small id="alertNumeroInvalido" name="alertNumeroInvalido" style="color: red;">Digite um número válido.</small>
                </div>

                <div class="form-row">
                    <label for="inputBairro">Bairro</label>
                    <input type="text" class="form-control" id="inputBairro" name="inputBairro">
                    <small id="alertBairroInvalido" name="alertBairroInvalido" style="color: red;">Digite um bairro válido.</small>
                </div>

                <div class="form-row">
                    <label for="inputCidade">Cidade</label>
                    <input type="text" class="form-control" id="inputCidade" name="inputCidade">
                    <small id="alertCidadeInvalido" name="alertCidadeInvalido" style="color: red;">Digite uma cidade válida.</small>
                </div>

                <div class="row" style="display: flex; justify-content: center;">
                    <small id="alertCamposVazios" name="alertCamposVazios" style="color: red;">Você não pode prosseguir com todos os campos vazios.</small>
                </div>
            </div>
            <div class="form-row" style="display: flex; justify-content: center;">
                <button id="btnProcurar" name="btnProcurar" type="submit" class="btn btn-primary">Procurar</button>
            </div>
        </form>
    </div>

    <!-- Funções JS -->
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/index.js"></script>

</body>

</html>