<?php
    function getCamposObrigatorios(){
        require_once("../conexao.php");

        $query = "SELECT * FROM campos_obrigatorios WHERE id_registro=1;";

        if ($result = $conexao->query($query)) {
            $resultado = $result->fetch_assoc();

            if (empty($resultado)) {
                $_SESSION['erro'] = "Ocorreu um erro inesperado! Favor contatar o administrador.(1)";
            } else {
                $_SESSION['selectNome'] = $resultado["campo_nome"];
                $_SESSION['selectEmail'] = $resultado["campo_email"];
                $_SESSION['selectTelefone'] = $resultado["campo_telefone"];
                $_SESSION['selectCep'] = $resultado["campo_cep"];
                $_SESSION['selectEndereco'] = $resultado["campo_endereco"];
                $_SESSION['selectNumero'] = $resultado["campo_numero"];
                $_SESSION['selectBairro'] = $resultado["campo_bairro"];
                $_SESSION['selectCidade'] = $resultado["campo_cidade"];
            }
        }
        $conexao->close();
    }
?>