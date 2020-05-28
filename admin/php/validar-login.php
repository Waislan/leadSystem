<?php
    session_start();
    
    include_once("../../conexao.php");
    
    $dados = $_POST['data'];
    
    $query = "SELECT * FROM colaboradores WHERE username_colaborador='$dados[0]' AND password_colaborador=MD5('$dados[1]');";
    
    if ($result = $conexao->query($query)) {
        $resultado = $result->fetch_assoc();

        if (empty($resultado)) {
            echo 'invalid';
        } else {
            $_SESSION['idColaborador'] = $resultado['id_colaborador'];
            $_SESSION['nomeColaborador'] = $resultado['nome_colaborador'];
            $_SESSION['emailColaborador'] = $resultado['email_colaborador'];
            $_SESSION['passwordColaborador'] = $resultado['password_colaborador'];
            $_SESSION['usernameColaborador'] = $resultado['username_colaborador'];
            $_SESSION['permissoesAdmin'] = $resultado['permissoes_admin'];
            $_SESSION['cpfColaborador'] = $resultado['cpf_colaborador'];
            echo 'true';
        }
    } else {
        echo 'erro';
    }
    $conexao->close();
?>