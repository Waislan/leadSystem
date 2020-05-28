<?php
    session_start();
    include_once("../../conexao.php");

    $apelido = $_POST['inputApelido'];
    $nome = $_POST['inputNome'];
    $cnpj = $_POST['inputCnpj'];
    // $senha = MD5($_POST['inputSenha']);
    $proximoCodigo = $_POST['inputProxCodigo'];

    //$query = "INSERT INTO clientes (apelido, nome_clientes, cnpj_clientes, senha_clientes, proximoCodigo) VALUES ('".$apelido."', '".$nome."', '".$cnpj."', '".$senha."', '".$proximoCodigo."')";
    $query = "INSERT INTO clientes (apelido, nome_clientes, cnpj_clientes, proximoCodigo) VALUES ('".$apelido."', '".$nome."', '".$cnpj."', '".$proximoCodigo."')";

    if ($result = $conexao->query($query)) {
        header("Location: ../gerenciar-clientes.php");
    }
    /* close connection */
    $conexao->close();
?>
