<?php
    session_start();

    include_once("../conexao.php");
    
    $cep = (isset($_POST['cep'])) ? $_POST['cep'] : '';
    
    $query = "SELECT * FROM cep WHERE cep='$cep'";

    if ($result = $conexao->query($query)) {
        $resultado = $result->fetch_assoc();
        
        $nomeUsuario = $_POST['nome'];
        $emailUsuario = $_POST['email'];
        $telefoneUsuario = $_POST['telefone'];
        $endereco = $_POST['endereco'];
        $numero = $_POST['numero'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        
        if ($nomeUsuario == '' &&
            $emailUsuario == '' &&
            $telefoneUsuario == '' &&
            $endereco == '' &&
            $numero == '' &&
            $bairro == '' &&
            $cidade == ''){
            $_SESSION['camposVazios'] = "Não é possível fazer busca com todos os campos vazios.";
            header ("Location: ../index.php");
            $conexao->close();
            exit;
        }
        
        $data = date("Y-m-d");
        
        if (empty($resultado)) {
            $viavel = 0;
            
            $query = "INSERT INTO pesquisas (nome_usuario, email_usuario, telefone_usuario, cep, endereco, numero, bairro, cidade, data, viavel) VALUES ('$nomeUsuario', '$emailUsuario', '$telefoneUsuario', '$cep', '$endereco', '$numero', '$bairro', '$cidade', '$data', '$viavel')";
            
            if (!$conexao->query($query)) {
                $_SESSION['erroBD'] = "Ops, parece que ocorreu um erro! Favor contatar o administrador. (1)";
                echo "Ops, parece que ocorreu um erro! Favor contatar o administrador. (1)<br/>";
                echo "Error updating record: " . $conexao->error;
                exit;
            }
            
            $_SESSION['cepErro'] = "CEP indisponível no momento! Deseja pesquisar outro endereço?";
            
            header("Location: ../index.php");
        }
        else {
            $viavel = 1;
            
            $query = "INSERT INTO pesquisas (nome_usuario, email_usuario, telefone_usuario, cep, endereco, numero, bairro, cidade, data, viavel) VALUES ('$nomeUsuario', '$emailUsuario', '$telefoneUsuario', '$cep', '$endereco', '$numero', '$bairro', '$cidade', '$data', '$viavel')";
            
            if (!$conexao->query($query)) {
                $_SESSION['erroBD'] = "Ops, parece que ocorreu um erro! Favor contatar o administrador. (2)";
                echo "Ops, parece que ocorreu um erro! Favor contatar o administrador. (2)<br/>";
                echo "Error updating record: " . $conexao->error;
                exit;
            }
            
            session_destroy();
            
            // redirecionar para outra página
            $query = "SELECT url FROM redirecionamento;";
            
            if ($result = $conexao->query($query)){
                $resultado = $result->fetch_assoc();
                $url = $resultado["url"];
                if($url == ''){
                    header("Location: ../index");
                } else if (strpos($url, 'http') !== false) {
                    header("Location: $url");
                } else {
                    header("Location: http://$url/");
                }
            }
            else {
                $_SESSION['erroBD'] = "Ops, parece que ocorreu um erro! Favor contatar o administrador. (3)";
                echo "Ops, parece que ocorreu um erro! Favor contatar o administrador. (3)<br/>";
                echo "Error updating record: " . $conexao->error;
                exit;
            }
        }
    }
    $conexao->close();
?>
