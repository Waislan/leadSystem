<?php
    session_start();

    include_once("../../conexao.php");
        
    $query = "SELECT * FROM campos_obrigatorios WHERE id_registro=1;";

    if ($result = $conexao->query($query)) {
        $resultado = $result->fetch_assoc();
        
        if (empty($resultado)) {
            $_SESSION['erro'] = "Ocorreu um erro inesperado! Favor contatar o administrador.";
            
            header("Location: ../gerenciar-campos.php");
        } else {
            $preenchimentoNome = $_POST['selectNome'];
            $preenchimentoEmail = $_POST['selectEmail'];
            $preenchimentoTelefone = $_POST['selectTelefone'];
            $preenchimentoCep = $_POST['selectCep'];
            $preenchimentoEndereco = $_POST['selectEndereco'];
            $preenchimentoNumero = $_POST['selectNumero'];
            $preenchimentoBairro = $_POST['selectBairro'];
            $preenchimentoCidade = $_POST['selectCidade'];
            
            $query = "UPDATE campos_obrigatorios SET campo_nome = '$preenchimentoNome', campo_email = '$preenchimentoEmail', campo_telefone = '$preenchimentoTelefone', campo_cep = '$preenchimentoCep', campo_endereco = '$preenchimentoEndereco', campo_numero = '$preenchimentoNumero', campo_bairro = '$preenchimentoBairro', campo_cidade = '$preenchimentoCidade' WHERE id_registro = 1;";
            
            if ($conexao->query($query)) {
                $_SESSION['sucesso'] = "Atualização feita com sucesso!";
            }
            else {
                $_SESSION['erro'] = "Erro ao atualizar!";
            }
            
            header("Location: ../gerenciar-campos.php");
        }
    }
    $conexao->close();
?>