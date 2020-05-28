<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "leader-admin-db";

    $conn = mysqli_connect($servername, $username, $password, $db);

    $data = $_POST["data2"] != '' ? $_POST["data2"] : '';

    header('Content-Type: text/xls; charset=utf-8');

    if ($data != '') {
        header('Content-Disposition: attachment; filename=lista-pesquisas_'.$data.'.xls');
    } else {
        header('Content-Disposition: attachment; filename=lista-pesquisas.xls');

    }
    
    $output = fopen("php://output", "w");  

    fputcsv($output, array('nome', 'email', 'telefone', 'cep', 'endereco', 'numero', 'bairro', 'cidade', 'data', 'viavel'));
    
    if ($data != '') {
        $query = "SELECT nome_usuario, email_usuario, telefone_usuario, cep, endereco, numero, bairro, cidade, data, viavel FROM pesquisas WHERE data='$data';";
    } else {
        $query = "SELECT nome_usuario, email_usuario, telefone_usuario, cep, endereco, numero, bairro, cidade, data, viavel FROM pesquisas;";
    }
    
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result)){
        $cep = substr($row['cep'], 0, 5) . '-' . substr($row['cep'], 5, 8);
        $row['cep'] = $cep;
        fputcsv($output, $row);
    }
    fclose($output);
?>
