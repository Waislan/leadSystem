<?php
    include_once("../../conexao.php");

    $cep = $_POST["data"];

    $query = "SELECT * FROM cep WHERE cep='$cep';";

    if ($result = $conexao->query($query)){
        $resultado = $result->fetch_assoc();

        if (empty($resultado)){
            echo 'false';
        } else {
            $registros = array();
            $result = $conexao->query($query);
            
            while($resultado = $result->fetch_assoc()){
        	   $registros[] = array("id_cep" => $resultado['id_cep'], "cep" => $resultado['cep']);
            }
            echo json_encode(($registros));
        }
    } else {
        echo 'erro';
    }
    $conexao->close();
?>
