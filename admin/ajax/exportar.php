<?php

    if(session_status() == PHP_SESSION_NONE){
        //session has not started
        session_start();
    }


    /*
    if (($_SESSION['usuarioId'] == "") ||
        ($_SESSION['usuarioNome'] == "") ||
        ($_SESSION['usuarioLogin'] == "") ||
        ($_SESSION['usuarioSenha'] == "")) {
            header("Location: ../login.html");
            exit;
    }
    */

    $dir = '';
    if(isset($exportarParaEmail) && $exportarParaEmail == TRUE) {
        $dir = '../painel/tmp/'.session_id();
    } else {
        include_once("../../conexao.php");
        $dir = '../tmp/'.session_id();
    }

    $query = "";
    if(isset($_GET['cnpj'])) {
        $query = "SELECT cnpj_clientes, apelido FROM clientes WHERE cnpj_clientes = '" . $_GET['cnpj'] . "'";
    } else if(isset($exportarParaEmail) && $exportarParaEmail == TRUE) {
        $query = "SELECT cnpj_clientes, apelido FROM clientes WHERE cnpj_clientes = '" . $cnpjTratado . "'";
    } else {
        $query = "SELECT cnpj_clientes, apelido FROM clientes";
    }

    if (!$result2 = $conexao->query($query)) {

        echo "Desculpe, a página está com alguns problemas.";

        // Again, do not do this on a public site, but we'll show you how
        // to get the error information
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $query . "\n";
        echo "Errno: " . $conexao->errno . "\n";
        echo "Error: " . $conexao->error . "\n";
        exit;
    }

    while($row2 = $result2->fetch_assoc()) {
        
        $query = '';
        if(isset($exportarParaEmail) && $exportarParaEmail == TRUE) {
            $query = "SELECT * FROM ficha_admissao WHERE cnpj='" . $cnpjTratado . "' AND id_fichaAdmissao = '" . $proximoID . "'";
        } else {
            $query = "SELECT * FROM ficha_admissao WHERE cnpj = " . $row2["cnpj_clientes"];
        }
        
        if (!$result = $conexao->query($query)) {
            echo "Desculpe, a página está com alguns problemas.";
            exit;
        }

        if($result->num_rows === 0) {
            continue;
        }

        $fun = "";
        $dep = "";
        $his = "";
        
        while($row = $result->fetch_assoc()) {
            
            // APELIDO.FUN
            if(!isset($row["codigo"])) {
                echo "Não tem código! Valor: \"".$row["codigo"]."\"";
            }
            $fun = $fun.numSize($row["codigo"], 10);                                                // Código -- constanzo
            $fun = $fun.strSize($row["nomeCompleto"], 70);
            $fun = $fun.strSize($row["endereco"], 40);
            $fun = $fun.numSize($row["numero"], 10);
            $fun = $fun.strSize($row["complemento"], 25);
            $fun = $fun.strSize($row["bairroEndereco"], 30);
            $fun = $fun.strSize($row["cidadeEndereco"], 30);
            $fun = $fun.strSize($row["estadoEndereco"], 2);
            $fun = $fun.strSize($row["cepEndereco"], 9);

            $aux = $row["telefone"];
            if(strlen($aux) == 14) {
                $aux = "(00".substr($aux, 1, 3).substr($aux, 5, 4)."-".str_replace("-", "", substr($aux, 9, 5));
            } else if(strlen($aux) == 15) {
                $aux = "(0".substr($aux, 1, 2).substr($aux, 5, 1).")".substr($aux, 6, 4)."-".substr($aux, 11, 4);
            }
            $fun = $fun.strSize($aux, 15);

            $fun = $fun.strSize($row["nomeMae"], 70);
            $fun = $fun.strSize($row["nomePai"], 70);
            $fun = $fun.strSize($row["naturalidade"], 30);
            $fun = $fun.strSize($row["ufNaturalidade"], 2);
            $fun = $fun.strSize(trataData($row["dataNascimento"]), 10);
            $fun = $fun.numSize($row["genero"], 1);
            $fun = $fun.numSize($row["estadoCivil"], 1);
            $fun = $fun.numSize("", 1);                                                             // Tipo sanguíneo -- em branco
            $fun = $fun.numSize($row["folha"], 7);                                                  // Número da folha -- em branco
            $fun = $fun.numSize($row["registro"], 10);                                              // Número do registro -- em branco
            $fun = $fun.numSize($row["chapa"], 10);                                                 // Número da chapa -- em branco
            $fun = $fun.numSize($row["departamento"], 5);                                           // Código de Departamento -- em branco
            $fun = $fun.numSize($row["setor"], 5);                                                  // Código de Setor -- em branco
            $fun = $fun.numSize($row["secao"], 5);                                                  // Código de Seção -- em branco
            $fun = $fun.numSize($row["deficiencia"], 1);
            $fun = $fun.numSize($row["raca"], 1);
            $fun = $fun.numSize($row["nacionalidade"], 2);

            if(isset($row["dataChegada"])) {
                $fun = $fun.strSize(trataData($row["dataChegada"]), 10);
            } else {
                $fun = $fun."00/00/0000";
            }

            $fun = $fun.numSize("", 2);                                                             // Situação no CAGED -- em branco
            $fun = $fun.numSize($row["escolaridade"], 2);
            $fun = $fun.numSize("", 2);                                                             // Vincúlo Empregatício -- em branco
            $fun = $fun.numSize("", 1);                                                             // Alvará para Func. menor de 16 anos -- em branco
            $fun = $fun.strSize("", 100);                                                           // Formação Acadêmica -- em branco
            $fun = $fun.numSize($row["tipoContrato"], 1);
            $fun = $fun.numSize("", 1);                                                             // Op. 13 Ferias -- em branco
            $fun = $fun.numSize($row["tipoConta"], 1);                                              // Tipo da Conta Bancária -- em branco
            $fun = $fun.numSize($row["banco"], 5);                                                  // Número do Banco -- em branco
            $fun = $fun.strSize($row["contaBanco"], 12);                                            // Número da C/C -- em branco
            $fun = $fun.numSize("", 2);                                                             // Qtde de Dep. Sal. Família -- em branco
            $fun = $fun.numSize("", 2);                                                             // Qtde de Dep. IRRF -- em branco
            $fun = $fun.numSize("45", 3);                                                           // Dias de Experiência
            $fun = $fun.numSize("45", 3);                                                           // Dias de Prorrogação

            //if(isset($row["terminoProrrogacao"])) {
                //$fun = $fun.strSize(trataData($row["terminoProrrogacao"]), 10);                   // Data do Termino Prorrogação
            //} else {
                $fun = $fun."00/00/0000";
            //}

            $fun = $fun.strSize(trataData($row["dataInicio"]), 10);
            $fun = $fun."00/00/0000";                                                               // Data de Transferência -- em branco
            $fun = $fun."00/00/0000";                                                               // Data de Exame Médico -- faltando
            $fun = $fun.numSize("", 2);                                                             // Validade Exame Médico -- 12 meses
            $fun = $fun."00/00/0000";                                                               // Data de Rescisão -- em branco
            $fun = $fun.numSize("", 1);                                                             // Adm RE FGTS -- em branco
            $fun = $fun."00/00/0000";                                                               // Data de Opção do FGTS -- em branco
            $fun = $fun.strSize("", 10);                                                            // Número de Conta do FGTS -- em branco
            $fun = $fun.numSize($row["tipoTributacao"], 1);                                         // Tp Tributação Sindicato -- em branco
            $fun = $fun.strSize($row["matriculaSindicato"], 7);                                     // Matrícula do Sindicato -- em branco
            $fun = $fun.numSize($row["ctps"], 8);
            $fun = $fun.numSize($row["serieCtps"], 5);
            $fun = $fun.strSize($row["ufCtps"], 2);
            $fun = $fun.strSize("", 1);                                                             // Espaço livre
            $fun = $fun.strSize(trataData($row["dataExpedicaoCtps"]), 10);
            $fun = $fun.strSize($row["pis"], 15);
            $fun = $fun.strSize($row["rg"], 14);
            $fun = $fun.strSize($row["cpf"], 18);
            $fun = $fun.strSize($row["tituloEleitor"], 14);
            $fun = $fun.numSize($row["zonaTituloEleitor"], 3);
            $fun = $fun.numSize($row["secaoTituloEleitor"], 4);
            $fun = $fun.strSize($row["cnh"], 11);
            $fun = $fun.strSize($row["categoriaCnh"], 5);
            $fun = $fun.strSize(trataData($row["validadeCnh"]), 10);
            $fun = $fun.numSize("", 1);                                                             // Tipo de Docto Militar -- em branco
            $fun = $fun.strSize("", 15);                                                            // Número de Docto Militar -- em branco
            $fun = $fun.strSize("", 5);                                                             // Categoria de Docto Militar -- em branco
            $fun = $fun.strSize($row["nomeConselhoRegional"], 40);
            $fun = $fun.strSize("", 10);                                                            // Sigla Cons. Regional -- em branco
            $fun = $fun.strSize($row["numeroConselhoRegional"], 10);
            $fun = $fun.strSize("", 1);                                                             // Orgão Emissor RG -- em branco
            $fun = $fun.strSize($row["ufRG"], 2);
            $fun = $fun.strSize(trataData($row["dataEmissaoRg"]), 10);
            $fun = $fun."00/00/0000";                                                               // Data de Cad. PIS -- em branco
            $fun = $fun.strSize($row["rne"], 15);
            if(isset($row["validadeRne"])) {
                $fun = $fun.strSize(trataData($row["validadeRne"]), 10);
            } else {
                $fun = $fun."00/00/0000";
            }
            $fun = $fun.strSize($row["ctps"], 13);
            $fun = $fun."00/00/0000";                                                               // Validade da CTPS -- em branco
            $fun = $fun.strSize(trataData($row["dataExpedicaoCtps"]), 10);
            $fun = $fun.strSize("", 25);                                                            // Tipo de Visto -- em branco
            $fun = $fun.strSize("", 4);                                                             // Tipo de Salário -- em branco
            $fun = $fun.strSize("", 2);                                                             // Classe INSS Antiga -- em branco
            $fun = $fun.strSize("", 8);                                                             // Código Pagamento GPS -- em branco

            $fun = $fun."\n";
            
            // Arquivo APELIDO.DEP
            for ($i = 1; $i <= $row["quantidadeDep"]; $i++) {
                $dep = $dep.numSize($row["codigo"], 10);
                $dep = $dep.strSize($row["nomeDep$i"], 38);
                $dep = $dep.strSize(trataData($row["nascimentoDep$i"]), 10);
                $dep = $dep.numSize($row["grauParentescoDep$i"], 2);
                $dep = $dep.strSize("", 85);
                $dep = $dep.strSize(trataData($row["dataInicio"]), 10);
                $dep = $dep.strSize($row["cpfDep$i"], 14);
                $dep = $dep.numSize(1, 4);
                $dep = $dep.numSize($i, 10);
                $dep = $dep."\n";
            }
            
            // Arquivo APELIDO.HIS
            $his = $his.numSize("1", 10);
            $his = $his.numSize($row["codigo"], 10);
            $his = $his.strSize(trataData($row["dataInicio"]), 10);
            $his = $his.strSize(trataData($row["dataInicio"]), 10);
            $his = $his.numSize("1", 1);
            $his = $his.trataFloat($row["horasSemanais"], 4);
            $his = $his.trataFloat($row["horasMensais"], 5);
            $his = $his.trataFloat($row["valorSalario"], 16);
            $his = $his.numSize("0", 1);
            $his = $his.strSize("Admissao", 30);
            $his = $his."\n";
        }
        // $fun = substr($fun, 0, -1); // Remove o último \n
        // $dep = substr($dep, 0, -1); // Remove o último \n
        // $his = substr($his, 0, -1); // Remove o último \n

        if(!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($dir . "/" . $row2["apelido"] . '.FUN' , $fun);
        if(!isset($exportarParaEmail) || !$exportarParaEmail) {
            file_put_contents($dir . "/" . $row2["apelido"] . '.DEP' , $dep);
            file_put_contents($dir . "/" . $row2["apelido"] . '.HIS' , $his);
        }
    }

	$conexao->close();


    if(file_exists($dir)) {
        // Get real path for our folder
        $rootPath = realpath($dir);

        // Initialize archive object
        $zip = new ZipArchive();
        $fileName = getDatetimeNow() . '.zip';
        $zip->open($rootPath.'/'.$fileName, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Initialize empty "delete list"
        $filesToDelete = array();

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            // Skip directories (they would be added automatically)
            if (!$file->isDir()) {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);

                // Add current file to "delete list"
                // delete it later cause ZipArchive create archive only after calling close function and ZipArchive lock files until archive created)
                if ($file->getFilename() != 'important.txt') {
                    $filesToDelete[] = $filePath;
                }
            }
        }

        // Zip archive will be created only after closing object
        $zip->close();

        // Delete all files from "delete list"
        foreach ($filesToDelete as $file) {
            unlink($file);
        }

        if(!isset($exportarParaEmail) || !$exportarParaEmail) {
            // Headers para download do zip
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"".$fileName."\"");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: ".filesize($dir.'/'.$fileName));
            ob_end_flush();
            @readfile($dir.'/'.$fileName);

            unlink($dir.'/'.$fileName); // talvez tenha que tirar
            
        } else { // PHP do envio que chamou este arquivo, para gerar o zip e enviar por email
            $caminhoArquivoZip = $dir.'/'.$fileName;
        }
    }


    function strSize($str, $size) {
        
        $str = tirarAcentos($str);
        
    	if(mb_strlen($str) > $size) {
    		return substr($str, 0, $size);
    	} else if(mb_strlen($str) < $size) {
    		return mb_str_pad($str, $size);
    	} else {
    		return $str;
    	}
    }

    function numSize($num, $size) {
        
        $num = preg_replace('/[^0-9]+/', '', $num);
        
    	if(strlen($num) > $size) {
    		return substr($num, 0, $size);
    	} else if(strlen($num) < $size) {
    		return str_pad($num, $size, "0", STR_PAD_LEFT);
    	} else {
    		return $num;
    	}
    }

    function moneySize($num, $size) {
        
        $num = str_replace('.', ',', $num);
        
    	if(strlen($num) > $size) {
    		return substr($num, 0, $size);
    	} else if(strlen($num) < $size) {
    		return str_pad($num, $size, "0", STR_PAD_LEFT);
    	} else {
    		return $num;
    	}
    }

    function trataData($data) {
        
        if($data != null && preg_match('/\d{4}-\d{2}-\d{2}/', $data)) {
    	   return substr($data, 8, 2)."/".substr($data, 5, 2)."/".substr($data, 0, 4);
        } else {
            return "";
        }
    }

    function trataFloat($numero, $qtdCasas) {
        
        $numero = str_replace('.', '', $numero);
        $numero = str_replace(',', '', $numero);
        
        return numSize($numero, $qtdCasas);
    }

    function trataHorasSemanais($horasSemanais) {
        
        $split = explode(".", $horasSemanais);
        
        if(strlen($split[0]) == 2 && strlen($split[1]) < 2) {
            return $split[0].",".str_pad($split[1], 1, "0", STR_PAD_RIGHT);
        } else if(strlen($split[0]) == 2 && strlen($split[1]) >= 2) {
            return $split[0].",".substr($split[1], 0, 1);
        } else if(strlen($split[0]) == 1 && strlen($split[1]) == 2) {
            return $split[0].",".$split[1];
        } else if(strlen($split[0]) == 1 && strlen($split[1]) == 1) {
            return $split[0].",".str_pad($split[1], 2, "0", STR_PAD_RIGHT);
        } else if(strlen($split[0]) >= 2 && strlen($split[1]) >= 2) {
            return substr($split[0], 0, 2).",".substr($split[1], 0, 2);
        }
    }

    function trataHorasMensais($horasSemanais) {
        
        $split = explode(".", $horasSemanais);
        
        if(strlen($split[0]) == 3 && strlen($split[1]) < 2) {
            return $split[0].",".str_pad($split[1], 1, "0", STR_PAD_RIGHT);
        } else if(strlen($split[0]) == 3 && strlen($split[1]) >= 2) {
            return $split[0].",".substr($split[1], 0, 1);
        } else if(strlen($split[0]) == 2 && strlen($split[1]) > 2) {
            return $split[0].",".substr($split[1], 0, 2);
        } else if(strlen($split[0]) == 2 && strlen($split[1]) <= 2) {
            return $split[0].",".str_pad($split[1], 2, "0", STR_PAD_RIGHT);
        } else if(strlen($split[0]) == 1 && strlen($split[1]) > 3) {
            return $split[0].",".substr($split[1], 0, 3);
        } else if(strlen($split[0]) == 1 && strlen($split[1]) <= 3) {
            return $split[0].",".str_pad($split[1], 3, "0", STR_PAD_RIGHT);
        }
    }

    function getDatetimeNow() {
        $tz_object = new DateTimeZone('Brazil/East');

        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('d\-m\-Y\-H\-i\-s');
    }

    function mb_str_pad($input, $pad_length, $pad_string = ' ', $pad_type = STR_PAD_RIGHT) {
        $diff = strlen( $input ) - mb_strlen( $input );
        return str_pad( $input, $pad_length + $diff, $pad_string, $pad_type );
    }

    function tirarAcentos($string) {
        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"), $string);
    }

?>
