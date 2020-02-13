<?php
include_once("../conexao.php");

$dados = $_POST['data'];

if ($dados[3] == '') {
    echo 'invalid';
} else {
    $query = "SELECT * FROM cep WHERE cep=$dados[3];";

    if ($result = $conexao->query($query)) {
        $resultado = $result->fetch_assoc();

        $data = date("Y-m-d");

        if (empty($resultado)) {
            $query = "INSERT INTO pesquisas (nome_usuario, email_usuario, telefone_usuario, cep, endereco, numero, bairro, cidade, data, viavel) VALUES ('$dados[0]', '$dados[1]', '$dados[2]', '$dados[3]', '$dados[4]', '$dados[5]', '$dados[6]', '$dados[7]', '$data', '0');";

            if ($conexao->query($query)) {
                echo 'inviavel';
            } else {
                echo 'erro1';
            }
        } else {
            $query = "INSERT INTO pesquisas (nome_usuario, email_usuario, telefone_usuario, cep, endereco, numero, bairro, cidade, data, viavel) VALUES ('$dados[0]', '$dados[1]', '$dados[2]', '$dados[3]', '$dados[4]', '$dados[5]', '$dados[6]', '$dados[7]', '$data', '1');";

            if ($conexao->query($query)) {
                echo 'success';
            } else {
                echo 'erro2';
            }
        }
    } else {
        echo 'erro3';
    }
}
$conexao->close();
?>
