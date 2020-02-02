<?php
    session_start();
    include_once("../../conexao.php");

    $id = $_POST['idUsuario'];
    $nome = $_POST['inputNome'];
    $login = $_POST['inputLogin'];
    $senha = $_POST['inputPassword'];

    $query = "";
    if($senha == "") {
        $query = "UPDATE usuario SET nome_usuario='" . $nome . "', login_usuario='" . $login . "' WHERE id_usuario='" . $id . "'";
    } else {
        $query = "UPDATE usuario SET nome_usuario='" . $nome . "', login_usuario='" . $login . "', senha_usuario='" . MD5($senha) . "' WHERE id_usuario='" . $id . "'";
    }
    

    if ($result = $conexao->query($query)) {
        if($_SESSION['usuarioId'] == $id) {
            $_SESSION['usuarioNome'] = $nome;
        }
        header("Location: ../gerenciar-usuarios.php");
    }
    /* close connection */
    $conexao->close();
?>
