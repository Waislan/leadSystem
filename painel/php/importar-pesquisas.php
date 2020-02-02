<?php
    echo "<script>alert('oi')</script>";

    $conn = mysqli_connect("localhost", "root", "", "leadsystem_db");

    $fileName = $_FILES["file"]["tmp_name"];
    $data = date("Y-m-d");

    if ($_FILES["file"]["size"] > 0) {

        $file = fopen($fileName, "r");

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $sqlInsert = "INSERT INTO pesquisas (nome_usuario, email_usuario, telefone_usuario, cep, endereco, numero, bairro, cidade, data, viavel)
                VALUES ('" .$column[0]. "', '" .$column[1]. "', '" .$column[2]. "', '" .$column[3]. "', '" .$column[4]. "',
                '" .$column[5]. "', '" .$column[6]. "', '" .$column[7]. "', '" .$data. "', '" .$column[8]. "');";
            $result = mysqli_query($conn, $sqlInsert);

            if (!empty($result)) {
                $type = "success";
                echo 'true';
            } else {
                $type = "error";
                echo 'false';
            }
        }
    }
?>
