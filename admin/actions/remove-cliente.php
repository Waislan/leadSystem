<?php
    session_start();
    include_once("../../conexao.php");

    $cnpj = $_POST['cnpj'];
    $query = "DELETE FROM clientes WHERE cnpj_clientes='".$cnpj."'";

    if ($result = $conexao->query($query)) {
        header("Location: ../gerenciar-clientes.php");
    }
    /* close connection */
    $conexao->close();
?>
