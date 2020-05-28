<?php
    include_once("../../conexao.php");

    $data = $_POST["data"] != '' ? $_POST["data"] : '';

    if ($data != ''){
        $query = "SELECT * FROM pesquisas WHERE data='$data' ORDER BY id_pesquisa DESC;";
    } else {
        $query = "SELECT * FROM pesquisas ORDER BY id_pesquisa DESC;";
    }
        
    if ($result = $conexao->query($query)){
        $registros = array();

        while($resultado = $result->fetch_assoc()){
            $cep = substr($resultado['cep'], 0, 5) . '-' . substr($resultado['cep'], 5, 8);
            
            if ($resultado['viavel'] == '1'){
                $viavel = 'Sim';
            } else {
                $viavel = 'Não';
            }

        	$registros[] = array($resultado['id_pesquisa'],
                                utf8_decode($resultado['nome_usuario']),
                                $resultado['email_usuario'],
                                $resultado['telefone_usuario'],
                                $cep,
                                utf8_decode($resultado['endereco']),
                                $resultado['numero'],
                                utf8_decode($resultado['bairro']),
                                utf8_decode($resultado['cidade']),
                                $resultado['data'],
                                $viavel);
        }
        echo json_encode($registros);
    }
    $conexao->close();
?>