<?php
    include_once("../../conexao.php");

    $cep = $_POST["data"];

    if ($cep != '' && strlen($cep) == 8) {
        $query = "SELECT cep FROM cep WHERE cep='" .$cep. "';";
    
        if ($result = $conexao->query($query)){
            $resultado = $result->fetch_assoc();
            
            if (!empty($resultado)){
                echo 'cepExistente';
            } else {
                $query = "INSERT INTO cep (cep) VALUES ('$cep');";
                
                if ($conexao->query($query)){
                    $ultimoId = $conexao->insert_id;
                    echo $ultimoId;
                } else {
                    echo 'false';
                }
            }
        } else {
            echo 'false';
        }
    } else {
        echo 'cepIncorreto';
    }
    $conexao->close();
?>