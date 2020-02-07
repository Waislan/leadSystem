<?php
    include_once("../conexao.php");

    $query = "SELECT url FROM redirecionamento;";

    if ($result = $conexao->query($query)){
        $resultado = $result->fetch_assoc();
        echo $resultado['url'];
    } else {
        echo 'erro';
    }
    $conexao->close();
    
?>
