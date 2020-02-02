<?php
    session_start();
    include_once("../conexao.php");

    $nome = $_POST['inputNome'];
    $login = $_POST['inputLogin'];
    $senha = $_POST['inputPassword'];
    
    $query = "INSERT INTO usuario (nome_usuario, login_usuario, senha_usuario) VALUES ('" . $nome . "', '" . $login . "', '" . MD5($senha) . "')";

    if ($result = $conexao->query($query)) {
        header("Location: gerenciar-usuarios.php");
    }
    /* close connection */
    $conexao->close();
?>
