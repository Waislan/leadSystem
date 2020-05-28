<?php
    function getUrlRedirecionamento(){
        require_once("../conexao.php");

        $query = "SELECT * FROM redirecionamento;";

        if ($result = $conexao->query($query)) {
            $resultado = $result->fetch_assoc();

            if (!empty($resultado)) {
                $_SESSION['urlRedirecionamento'] = $resultado["url"];
            }
        }
        $conexao->close();
    }
?>