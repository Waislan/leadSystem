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
                <label for="inputNome">Nome</label>
                <input type="text" class="form-control" id="inputNome" name="inputNome">
                
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="emailHelp" placeholder="email@exemplo.com">
                <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>

                <label for="inputTelefone">Telefone</label>
                <input type="text" class="form-control" id="inputTelefone" name="inputTelefone" placeholder="(99) 99999-9999">

                <label for="inputCep">CEP</label>
                <input type="text" class="form-control" id="inputCep" name="inputCep" placeholder="99999-999">
                <label for="inputEndereco">Endereço</label>
                <input type="text" class="form-control" id="inputEndereco" name="inputEndereco">

                <label for="inputNumero">Número</label>
                <input maxlength="10" type="text" class="form-control" id="inputNumero" name="inputNumero">

                <label for="inputBairro">Bairro</label>
                <input type="text" class="form-control" id="inputBairro" name="inputBairro">

                <label for="inputCidade">Cidade</label>
                <input type="text" class="form-control" id="inputCidade" name="inputCidade">

                <div class="row" style="display: flex; justify-content: end;">
                    <button type="submit" class="btn btn-primary">Procurar</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Funções JS -->
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/index.js"></script>

</body>

</html>