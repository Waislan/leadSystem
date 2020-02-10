<?php
    $data = $_POST["data"] != '' ? $_POST["data"] : '';

    include_once("../../conexao.php");

    if ($data != ''){
        $query = "SELECT * FROM pesquisas WHERE data='$data' ORDER BY id_pesquisa DESC;";
    } else {
        $query = "SELECT * FROM pesquisas ORDER BY id_pesquisa DESC;";
    }
    
    if ($result = $conexao->query($query)){
        $registros = array();
        while($resultado = $result->fetch_assoc()){
        	$registros[] = array("id_pesquisa" => $resultado['id_pesquisa'],
                                "nome" => $resultado['nome_usuario'],
                                "email" => $resultado['email_usuario'],
                                "telefone" => $resultado['telefone_usuario'],
                                "cep" => $resultado['cep'],
                                "endereco" => $resultado['endereco'],
                                "numero" => $resultado['numero'],
                                "bairro" => $resultado['bairro'],
                                "cidade" => $resultado['cidade'],
                                "date" => $resultado['data'],
                                "viabilidade" => $resultado['viavel']);
        }
        echo json_encode(($registros));
    }
    $conexao->close();
?>