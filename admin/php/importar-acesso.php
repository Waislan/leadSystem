<?php
    include_once("../conexao.php");

    if (isset($_POST["import"])) {

        $fileName = $_FILES["file"]["tmp_name"];
        $data = date("d-m-Y");

        if ($_FILES["file"]["size"] > 0) {

            $file = fopen($fileName, "r");

            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                $query = "INSERT INTO pesquisas (nome_usuario, email_usuario, telefone_usuario, cep, endereco, numero, bairro, cidade, data, viavel)
                        VALUES ('" . $column[0] . "', '" . $column[1] . "', '" . $column[2] . "', '" . $column[3] . "', '" . $column[4] . "',
                        '" . $column[5] . "', '" . $column[6] . "', '" . $column[7] . "', '" . $data . "', '" . $column[8] . "');";

                if ($result = $conexao->query($query)){
                    $type = "success";
                    $_SESSION['sucesso'] = "CSV Data Imported into the Database";
                } else {
                    $type = "error";
                    $_SESSION['erro'] = "Problem in Importing CSV Data";
                }
            }
        }
    }

?>