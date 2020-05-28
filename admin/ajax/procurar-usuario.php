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

    $query = "SELECT nome_usuario, login_usuario FROM usuario WHERE (nome_usuario LIKE '%".$nome."%' OR login_usuario LIKE '%".$nome."%')";

    if (!$result = $conexao->query($query)) {
        echo "Desculpe, a página está com alguns problemas.";
        exit;
    }

    $usuarios = array();
    while($linha = $result->fetch_assoc()) {
        $usuarios[] = array("nome" => $linha['nome_usuario'], "login" => $linha['login_usuario']);
    }
    echo json_encode($usuarios);

	$conexao->close();
?>
