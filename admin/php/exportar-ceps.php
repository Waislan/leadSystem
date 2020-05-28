<?php
    $servername = "localhost";
    $username = "u745700149_waislan";
    $password = "L/NnVWHd";
    $db = "u745700149_leaderAdmin";

    $conn = mysqli_connect($servername, $username, $password, $db);
 
    header('Content-Type: text/csv; charset=utf-8');  
    header('Content-Disposition: attachment; filename=lista-ceps.csv');

    $output = fopen("php://output", "w");  
    fputcsv($output, array('id', 'cep'));
    $query = "SELECT * FROM cep;";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result)){
       fputcsv($output, array((string)$row['id_cep'], (string)$row['cep']));
    }
    fclose($output);
?>