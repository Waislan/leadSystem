<?php
    session_start();
    include_once("../../conexao.php");

    $apelido = $_POST['inputApelido'];
    $nome = $_POST['inputNome'];
    $cnpj = $_POST['inputCnpj'];
    $senha = $_POST['inputSenha'];
    $proxCod = $_POST['inputProxCodigo'];

    $query = "";
    if($senha == "") {
        $query = "UPDATE clientes SET apelido='" . $apelido . "', nome_clientes='" . $nome . "', proximoCodigo='" . $proxCod . "' WHERE cnpj_clientes='" . $cnpj . "'";
    } else {
        $query = "UPDATE clientes SET apelido='" . $apelido . "', nome_clientes='" . $nome . "', proximoCodigo='" . $proxCod . "', senha_clientes='" . MD5($senha) . "' WHERE cnpj_clientes='" . $cnpj . "'";
    }
    

    if ($result = $conexao->query($query)) {
        header("Location: ../gerenciar-clientes.php");
    }
    /* close connection */
    $conexao->close();
?>
