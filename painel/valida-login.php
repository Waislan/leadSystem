<?php
    session_start();
    include_once("../conexao.php");

    $email = $_POST['inputEmail'];
    $senha = $_POST['inputPassword'];

    $query = "SELECT * FROM admin WHERE email_admin='" . $email . "' AND senha_admin='" . MD5($senha) . "'";
    
    if ($result = $conexao->query($query)) {
        $resultado = $result->fetch_assoc();

        if (empty($resultado)) {
            $_SESSION['loginErro'] = "Usuário ou senha inválidos.";
            header("Location: login.php");
        } else {
            $_SESSION['adminId'] = $resultado["id_admin"];
            $_SESSION['adminNome'] = $resultado["nome_admin"];
            $_SESSION['adminEmail'] =  $resultado["email_admin"];
            $_SESSION['adminSenha'] =  $resultado["senha_admin"];
            header("Location: index.php");
        }
    } else {
        echo '<script>console.log("ola");</script>';
    }

    $conexao->close();
?>