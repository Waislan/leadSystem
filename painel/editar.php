<?php
    session_start();
    include_once("../conexao.php");

    if (($_SESSION['usuarioId'] == "") ||
        ($_SESSION['usuarioNome'] == "") ||
        ($_SESSION['usuarioLogin'] == "") ||
        ($_SESSION['usuarioSenha'] == "")) {
            header("Location: login.html");
    } else {

        $id = $_GET['id'];
        $cnpj = $_GET['cnpj'];

        $query = "SELECT * FROM ficha_admissao WHERE id_fichaAdmissao='" . $id . "'";

        if ($result = $conexao->query($query)) {
            $resultado = $result->fetch_assoc();

            $_SESSION['dataInicio'] = $resultado["dataInicio"];
            $_SESSION['cnpj'] = $resultado["cnpj"];
            $_SESSION['emprego'] = $resultado["primeiroEmprego"];

            $_SESSION['nome'] = $resultado["nomeCompleto"];
            $_SESSION['genero'] = $resultado["genero"];
            $_SESSION['estadoCivil'] = $resultado["estadoCivil"];
            $_SESSION['dataNascimento'] = $resultado["dataNascimento"];
            $_SESSION['cor'] = $resultado["raca"];
            $_SESSION['municipioNascimento'] = $resultado["municipioNascimento"];
            $_SESSION['estadoNascimento'] = $resultado["estadoNascimento"];
            $_SESSION['nacionalidade'] = $resultado["nacionalidade"];
            $_SESSION['dataChegada'] = $resultado["dataChegada"];
            $_SESSION['escolaridade'] = $resultado["escolaridade"];
            $_SESSION['nomeMae'] = $resultado["nomeMae"];
            $_SESSION['nomePai'] = $resultado["nomePai"];
            $_SESSION['endereco'] = $resultado["endereco"];
            $_SESSION['numero'] = $resultado["numero"];
            $_SESSION['complemento'] = $resultado["complemento"];
            $_SESSION['cep'] = $resultado["cepEndereco"];
            $_SESSION['bairro'] = $resultado["bairroEndereco"];
            $_SESSION['cidade'] = $resultado["cidadeEndereco"];
            $_SESSION['estado'] = $resultado["estadoEndereco"];
            $_SESSION['telefone'] = $resultado["telefone"];
            $_SESSION['email'] = $resultado["email"];
            $_SESSION['deficiencia'] = $resultado["deficiencia"];

            $_SESSION['qtdDependentes'] = $resultado["quantidadeDep"];
            for ($i = 1; $i <= $_SESSION['qtdDependentes']; $i++) {
                if(!empty($resultado["nomeDep".$i])){
                    $_SESSION['nomeDependente'.$i] = $resultado["nomeDep".$i];
                    $_SESSION['cpfDependente'.$i] = $resultado["cpfDep".$i];
                    $_SESSION['dataNascimentoDependente'.$i] = $resultado["nascimentoDep".$i];
                    $_SESSION['grauParentesco'.$i] = $resultado["grauParentescoDep".$i];
                }
            }

            $_SESSION['salario'] = $resultado["valorSalario"];
            $_SESSION['cargo'] = $resultado["cargoAdmissao"];

            $_SESSION['ctps'] = $resultado["ctps"];
            $_SESSION['serie'] = $resultado["serieCtps"];
            $_SESSION['dataExpedicao'] = $resultado["dataExpedicaoCtps"];
            $_SESSION['ufctps'] = $resultado["ufCtps"];
            $_SESSION['pis'] = $resultado["pis"];
            $_SESSION['cpf'] = $resultado["cpf"];
            $_SESSION['rg'] = $resultado["rg"];
            $_SESSION['dataEmissao'] = $resultado["dataEmissaoRg"];
            $_SESSION['ufrg'] = $resultado["ufRG"];
            $_SESSION['tituloEleitor'] = $resultado["tituloEleitor"];
            $_SESSION['ufTituloEleitor'] = $resultado["ufTituloEleitor"];
            $_SESSION['zona'] = $resultado["zonaTituloEleitor"];
            $_SESSION['secao'] = $resultado["secaoTituloEleitor"];
            $_SESSION['valeTransporte'] = $resultado["valeTransporte"];
            $_SESSION['descontaValeTransporte'] = $resultado["descontaValeTransporte"];
            $_SESSION['descontaSindicato'] = $resultado["descontaSindicato"];
            $_SESSION['tipoValeTransporte'] = $resultado["tipoValeTransporte"];
            $_SESSION['valorValeTransporte'] = $resultado["valorValeTransporte"];

            $_SESSION['cnh'] = $resultado["cnh"];
            $_SESSION['dataCnh'] = $resultado["dataExpedicaoCnh"];
            $_SESSION['categoriaCnh'] = $resultado["categoriaCnh"];
            $_SESSION['validadeCnh'] = $resultado["validadeCnh"];
            $_SESSION['rne'] = $resultado["rne"];
            $_SESSION['validadeRne'] = $resultado["validadeRne"];
            $_SESSION['nomeConselhoRegional'] = $resultado["nomeConselhoRegional"];
            $_SESSION['numeroConselhoRegional'] = $resultado["numeroConselhoRegional"];
            $_SESSION['emissaoConselhoRegional'] = $resultado["dataEmissaoConselhoRegional"];
            $_SESSION['vencimentoConselhoRegional'] = $resultado["dataVencimentoConselhoRegional"];

            $qtdDias = 0;
            if(!empty($resultado["entradaSegunda"])){
                $_SESSION['entradaSegunda'] = $resultado["entradaSegunda"];
                $_SESSION['saidaSegunda'] = $resultado["saidaSegunda"];
                $_SESSION['almocoSaidaSegunda'] = $resultado["almocoSaidaSegunda"];
                $_SESSION['almocoVoltaSegunda'] = $resultado["almocoVoltaSegunda"];
                $qtdDias++;
            }
            if(!empty($resultado["entradaTerca"])){
                $_SESSION['entradaTerça'] = $resultado["entradaTerca"];
                $_SESSION['saidaTerça'] = $resultado["saidaTerca"];
                $_SESSION['almocoSaidaTerça'] = $resultado["almocoSaidaTerca"];
                $_SESSION['almocoVoltaTerça'] = $resultado["almocoVoltaTerca"];
                $qtdDias++;
            }
            if(!empty($resultado["entradaQuarta"])){
                $_SESSION['entradaQuarta'] = $resultado["entradaQuarta"];
                $_SESSION['saidaQuarta'] = $resultado["saidaQuarta"];
                $_SESSION['almocoSaidaQuarta'] = $resultado["almocoSaidaQuarta"];
                $_SESSION['almocoVoltaQuarta'] = $resultado["almocoVoltaQuarta"];
                $qtdDias++;
            }
            if(!empty($resultado["entradaQuinta"])){
                $_SESSION['entradaQuinta'] = $resultado["entradaQuinta"];
                $_SESSION['saidaQuinta'] = $resultado["saidaQuinta"];
                $_SESSION['almocoSaidaQuinta'] = $resultado["almocoSaidaQuinta"];
                $_SESSION['almocoVoltaQuinta'] = $resultado["almocoVoltaQuinta"];
                $qtdDias++;
            }
            if(!empty($resultado["entradaSexta"])){
                $_SESSION['entradaSexta'] = $resultado["entradaSexta"];
                $_SESSION['saidaSexta'] = $resultado["saidaSexta"];
                $_SESSION['almocoSaidaSexta'] = $resultado["almocoSaidaSexta"];
                $_SESSION['almocoVoltaSexta'] = $resultado["almocoVoltaSexta"];
                $qtdDias++;
            }
            if(!empty($resultado["entradaSabado"])){
                $_SESSION['entradaSábado'] = $resultado["entradaSabado"];
                $_SESSION['saidaSábado'] = $resultado["saidaSabado"];
                $_SESSION['almocoSaidaSábado'] = $resultado["almocoSaidaSabado"];
                $_SESSION['almocoVoltaSábado'] = $resultado["almocoVoltaSabado"];
                $qtdDias++;
            }
            if(!empty($resultado["entradaDomingo"])){
                $_SESSION['entradaDomingo'] = $resultado["entradaDomingo"];
                $_SESSION['saidaDomingo'] = $resultado["saidaDomingo"];
                $_SESSION['almocoSaidaDomingo'] = $resultado["almocoSaidaDomingo"];
                $_SESSION['almocoVoltaDomingo'] = $resultado["almocoVoltaDomingo"];
                $qtdDias++;
            }
            $_SESSION['qtdDias'] = $qtdDias;

            $_SESSION['radioRGExameAdmissional'] = $resultado["envioObrigatorio"];

            $_SESSION['idFormulario'] = $id;

            if(!empty($resultado["nomeArquivoUpload"])) {
                $_SESSION['nomeArquivoUpload'] = $resultado["nomeArquivoUpload"];
            }

            /* close connection */
            $conexao->close();
            header("Location: ../index.php");
        }
    }
?>
