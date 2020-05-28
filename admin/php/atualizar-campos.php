<?php
    include_once("../../conexao.php");
    
    $dados = $_POST['data'];
    
    $query = "UPDATE campos_obrigatorios SET campo_nome = '$dados[0]', campo_email = '$dados[1]', campo_telefone = '$dados[2]',
    campo_cep = '$dados[3]', campo_endereco = '$dados[4]', campo_numero = '$dados[5]', campo_bairro = '$dados[6]', campo_cidade = '$dados[7]' WHERE id_registro = 1;";
    
    if ($conexao->query($query)) {
        echo 'success';
    }
    else {
        echo 'error';
    }
            
    $conexao->close();
?>