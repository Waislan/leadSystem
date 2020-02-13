<?php
    session_start();
    
    include_once("../../conexao.php");
    
    $dados = $_POST['data'];
    
    $query = "SELECT * FROM admin WHERE email_admin='$dados[0]' AND senha_admin=MD5('$dados[1]');";
    
    if ($result = $conexao->query($query)) {
        $resultado = $result->fetch_assoc();

        if (empty($resultado)) {
            echo 'invalid';
        } else {
            $_SESSION['adminId'] = $resultado['id_admin'];
            $_SESSION['adminNome'] = $resultado['nome_admin'];
            $_SESSION['adminEmail'] = $resultado['email_admin'];
            $_SESSION['adminSenha'] = $resultado['senha_admin'];
            $_SESSION['adminLogin'] = $resultado['login_admin'];
            $_SESSION['adminMaster'] = $resultado['master_admin'];
            echo 'true';
        }
    } else {
        echo 'erro';
    }
    $conexao->close();

?>