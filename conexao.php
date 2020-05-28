<?php
    $host="localhost";
    $user="root";
    $pass="";
    $db="leader-admin-db";

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $conexao = new mysqli($host, $user, $pass, $db);

    if ($conexao->connect_errno) {
        echo "Connection failed: (" . $conexao->connect_errno . ") " . $conexao->connect_error;
        exit;
    }

?>
