<?php
    session_start();
    include_once("../../conexao.php");

    if (($_SESSION['usuarioId'] == "") ||
        ($_SESSION['usuarioNome'] == "") ||
        ($_SESSION['usuarioLogin'] == "") ||
        ($_SESSION['usuarioSenha'] == "")) {
            header("Location: ../login.html");
    }

    $nome = $_POST['nome'];

    $query = "SELECT apelido, nome_clientes, cnpj_clientes, proximoCodigo FROM clientes WHERE (nome_clientes LIKE '%".$nome."%' OR apelido LIKE '%".$nome."%')";

    if (!$result = $conexao->query($query)) {
        echo "Desculpe, a página está com alguns problemas.";
        exit;
    }

    $empresas = array();
    while($linha = $result->fetch_assoc()) {

        $qtdFuncionarios = 0;

        $query2 = "SELECT cnpj FROM ficha_admissao";
        if($result2 = $conexao->query($query2)) {
            while ($linha2 = $result2->fetch_assoc()) {
                if($linha2['cnpj'] == $linha['cnpj_clientes']) {
                    $qtdFuncionarios += 1;
                }
            }
        }

        $empresas[] = array("apelido" => $linha['apelido'], "nome" => $linha['nome_clientes'], "cnpj" => $linha['cnpj_clientes'], "qtdFuncionarios" => $qtdFuncionarios, "proxCod" => $linha['proximoCodigo']);
    }
    echo json_encode($empresas);

	$conexao->close();
?>
