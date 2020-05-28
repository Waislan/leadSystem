<?php
    session_start();
    include_once("../../conexao.php");

    if (($_SESSION['usuarioId'] == "") ||
        ($_SESSION['usuarioNome'] == "") ||
        ($_SESSION['usuarioLogin'] == "") ||
        ($_SESSION['usuarioSenha'] == "")) {
            header("Location: login.html");
    } else {
        
        $apelido = $_POST['inputApelido'];
        $nome = $_POST['inputNome'];
        $cnpj = $_POST['inputCnpj'];
        
        $query = "UPDATE clientes SET apelido='$apelido', nome_clientes='$nome' WHERE cnpj_clientes='$cnpj'";
        
        if ($conexao->query($query) === TRUE) {
            header("Location: ../gerenciar-clientes.php");
        }
    }
    /* close connection */
    $conexao->close();
?>
