<?php
    session_start();
    
    include_once("../../conexao.php");

    $dados = $_POST['data'];

    $query = "SELECT * FROM colaboradores WHERE email_colaborador='$dados[0]' AND senha_colaborador=MD5('$dados[1]');";

    if ($result = $conexao->query($query)){
        $resultado = $result->fetch_assoc();

        if (empty($resultado)){
            $query = "INSERT INTO colaboradores (email_colaborador, senha_colaborador, nome_colaborador, login_colaborador, permissoes_admin, cpf_colaborador) VALUES ('$dados[0]', MD5('$dados[1]'), '$dados[2]', '$dados[3]', '$dados[4]', '$dados[5]');";
            
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
