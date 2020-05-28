<?php
    include_once("../../conexao.php");

    $query = "SELECT * FROM cep ORDER BY id_cep DESC;";

    if ($result = $conexao->query($query)){
        $resultado = $result->fetch_assoc();

        if (empty($resultado)){
            echo 'false';
        } else {
            $registros = array();
            $result = $conexao->query($query);
            
            while($resultado = $result->fetch_assoc()){
                $cep = substr($resultado['cep'], 0, 5) . '-' . substr($resultado['cep'], 5, 8);
        	    $registros[] = array($resultado['id_cep'], $cep);
            }
            echo json_encode($registros);
        }
    } else {
        echo 'erro';
    }
    $conexao->close();
?>