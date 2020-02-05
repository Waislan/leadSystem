<?php
    include_once("../conexao.php");
        
    $query = "SELECT * FROM campos_obrigatorios;";

    if ($result = $conexao->query($query)) {
        $registros = array();
        
        while ($resultado = $result->fetch_assoc()){
            $registros[] = array("nome" => $resultado['campo_nome'], "email" => $resultado['campo_email'], "telefone" => $resultado['campo_telefone'],
            "cep" => $resultado['campo_cep'], "endereco" => $resultado['campo_endereco'], "numero" => $resultado['campo_numero'],
            "bairro" => $resultado['campo_bairro'], "cidade" => $resultado['campo_cidade']);
        }
        echo json_encode(($registros));        
    } else {
        echo 'erro';
    }
    
    $conexao->close();
?>