<?php
    session_start();

    $url = $_POST["url"];
    
    include_once("../../conexao.php");
    
    $query = "SELECT * FROM redirecionamento;";

    if ($result = $conexao->query($query)){
        $resultado = $result->fetch_assoc();
        
        if (empty($resultado)) {
            $query = "INSERT INTO redirecionamento (url) VALUES ('$url');";
        
            if (!$conexao->query($query)){
                echo 'false';
            } else {
                echo 'true';
            }
        } else {
            $query = "UPDATE redirecionamento SET url='$url';";
            
            if (!$conexao->query($query)){
                echo 'false';
            } else {
                echo 'true';
            }
        }
    }
    $conexao->close();
?>