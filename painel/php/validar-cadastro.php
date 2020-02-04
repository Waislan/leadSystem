<?php
    include_once("../../conexao.php");

    $dados = $_POST['data'];

    $query = "SELECT * FROM admin WHERE email_admin='$dados[0]' AND senha_admin=MD5('$dados[1]');";

    if ($result = $conexao->query($query)){
        $resultado = $result->fetch_assoc();

        if (empty($resultado)){
            $query = "INSERT INTO admin (email_admin, senha_admin, nome_admin, login_admin, master_admin) VALUES ('$dados[0]', MD5('$dados[1]'), '$dados[2]', '$dados[3]', '$dados[4]');";
            if ($result = $conexao->query($query)){
                echo 'sucesso';
            } else {
                echo 'erro2;';
            }
        } else {
            echo 'repeticao';
        }
    } else {
        echo 'erro1';
    }
    $conexao->close();
    
?>
