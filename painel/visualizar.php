<?php

if(!isset($_GET['id']) ||
   !isset($_GET['cnpj']) ||
   !isset($_GET['token']) ||
   $_GET['token'] != MD5($_GET['cnpj'] - $_GET['id'])) {
    header("Location: ../404.html");
} else {
    
    include_once("../conexao.php");
    $id = $_GET['id'];
    $query = 'SELECT * FROM ficha_admissao WHERE id_fichaAdmissao="'.$id.'"';
    $linha = '';
    
    if ($result = $conexao->query($query)) {
        $linha = $result->fetch_assoc();
        
        $query = 'SELECT nome_clientes FROM clientes WHERE cnpj_clientes="'.$linha['cnpj'].'"';
        $result = $conexao->query($query);
        $aux = $result->fetch_assoc();
        $linha['nomeEmpresa'] = $aux['nome_clientes'];
    }
    
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script type="text/javascript" src="../ajax/funcs.js"></script>
    <!-- JQuery -->
    <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>

    <!-- Estilo CSS-->
    <link href="../css/mdb.min.css" rel="stylesheet">
    <link href="../css/estilo.css" rel="stylesheet" media="all">
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <title>Constanzo</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row p-t-45">
            <div class="col-lg-8 offset-lg-2">
                <div class="card sombreamento-card bordas">
                    <h5 class="card-header text-center py-4">
                        <strong>Ficha de Admissão - <?php if(isset($linha['nomeCompleto'])) { echo $linha['nomeCompleto']; } ?></strong>
                    </h5>

                    <div class="card-body">
                        <div class="container bordas">

                            <div class="form-row">
                                <div class="col-lg-12 abs-left">
                                    <label for="form1">Data de Início</label>
                                    <input type="date" id="dataInicio" name="dataInicio" class="form-control" value="<?php if(isset($linha['dataInicio'])) { echo $linha['dataInicio']; } ?>" style="width: 200px; display: inline !important; margin-left: 10px;">

                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-3 md-form">
                                    <input type="text" id="cnpj" name="cnpj" class="form-control" value="<?php if(isset($linha['cnpj'])) { echo $linha['cnpj']; } ?>">
                                    <label for="cnpj">CNPJ</label>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-12 md-form">
                                    <input type="text" id="nomeEmpresa" name="nomeEmpresa" class="form-control" value="<?php if(isset($linha['nomeEmpresa'])) { echo $linha['nomeEmpresa']; } ?>">
                                    <label for="nomeEmpresa">Nome da empresa</label>
                                </div>
                            </div>

                            <div class="form-row ">
                                <div class="col-lg-12 md-form abs-left">
                                    <label class="label" style="position: relative !important;">Primeiro emprego?</label>

                                    <label class="radio-container m-l-10" style="position: relative !important;">Sim
                                        <input type="radio" name="emprego" value="sim" <?php if(isset($linha['primeiroEmprego']) && $linha['primeiroEmprego'] == '1') { echo 'checked="checked"'; } ?>>
                                    </label>

                                    <label class="radio-container m-l-10" style="position: relative !important;">Não
                                        <input type="radio" name="emprego" value="nao" <?php if(isset($linha['primeiroEmprego']) && $linha['primeiroEmprego'] == '0') { echo 'checked="checked"'; } ?>>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="container bordas">
                            <div class="form-row">
                                <div class="col-sm-12 md-form">
                                    <input type="text" name="nome" id="nome" class="form-control" value="<?php if(isset($linha['nomeCompleto'])) { echo $linha['nomeCompleto']; } ?>">
                                    <label for="nome">Nome completo</label>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-sm-12 col-md-6 md-form abs-left">
                                    <label class="label" style="position: relative !important;">Gênero:</label>
                                    <label class="radio-container m-l-10" style="position: relative !important;">Masculino
                                        <input type="radio" name="genero" value="masc" <?php if(isset($linha['genero']) && $linha['genero']=='1' ) { echo 'checked="checked"' ; } ?>>
                                    </label>
                                    <label class="radio-container m-l-10" style="position: relative !important;">Feminino
                                        <input type="radio" name="genero" value="fem" <?php if(isset($linha['genero']) && $linha['genero']=='2' ) { echo 'checked="checked"' ; } ?>>
                                    </label>
                                </div>

                                <div class="col-sm-12 col-md-6 md-form">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="estadoCivil" style="position:relative; top: 0;">Estado Civil</label>
                                        </div>
                                        <select class="custom-select" name="estadoCivil" id="estadoCivil">
                                            <option value="1">Solteiro(a)</option>
                                            <option value="2">Casado(a)</option>
                                            <option value="3">Divorciado(a)</option>
                                            <option value="4">Viúvo(a)</option>
                                            <option value="5">Desquitado(a)</option>
                                            <option value="6">Maritalmente</option>
                                            <option value="7">Outros</option>
                                        </select>
                                        <?php if(isset($linha['estadoCivil'])) {
                                            echo '<script type="text/javascript">
                                                $("[name=estadoCivil]").val("'.$linha["estadoCivil"].'");
                                            </script>';
                                        } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-sm-12 col-md-6 abs-left md-form">
                                    <label for="dataNascimento" style="position:relative;">Data de Nascimento</label>
                                    <input type="date" name="dataNascimento" id="dataNascimento" style="width: 150px; display: inline !important; margin-left: 10px;" class="form-control" value="<?php if(isset($linha['dataNascimento'])) { echo $linha['dataNascimento']; } ?>">
                                </div>

                                <div class="col-sm-12 col-md-6 md-form">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="cor" style="position:relative; top: 0;">Raça/Cor</label>
                                        </div>
                                        <select class="custom-select" name="cor" id="cor">
                                            <option value="1">Branco(a)</option>
                                            <option value="2">Preto(a)/Negro(a)</option>
                                            <option value="3">Amarelo(a)</option>
                                            <option value="4">Pardo(a)</option>
                                            <option value="5">Indígena</option>
                                            <option value="6">Não declarado(a)</option>
                                        </select>
                                        <?php if(isset($linha['raca'])) {
                                            echo '<script type="text/javascript">
                                                $("[name=cor]").val("'.$linha["raca"].'");
                                            </script>';
                                        } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-sm-12 col-md-6 md-form abs-left">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="estadoNascimento" style="position:relative; top: 0;">Estado de nascimento</label>
                                        </div>
                                        <select class="custom-select" name="estadoNascimento" id="estadoNascimento">
                                            <option value="--">--</option>
                                            <option value="AC">AC</option>
                                            <option value="AL">AL</option>
                                            <option value="AP">AP</option>
                                            <option value="AM">AM</option>
                                            <option value="BA">BA</option>
                                            <option value="CE">CE</option>
                                            <option value="DF">DF</option>
                                            <option value="ES">ES</option>
                                            <option value="GO">GO</option>
                                            <option value="MA">MA</option>
                                            <option value="MT">MT</option>
                                            <option value="MS">MS</option>
                                            <option value="MG">MG</option>
                                            <option value="PA">PA</option>
                                            <option value="PB">PB</option>
                                            <option value="PR">PR</option>
                                            <option value="PE">PE</option>
                                            <option value="PI">PI</option>
                                            <option value="RJ">RJ</option>
                                            <option value="RN">RN</option>
                                            <option value="RS">RS</option>
                                            <option value="RO">RO</option>
                                            <option value="RR">RR</option>
                                            <option value="SC">SC</option>
                                            <option value="SP">SP</option>
                                            <option value="SE">SE</option>
                                            <option value="TO">TO</option>
                                        </select>
                                        <?php if(isset($linha['estadoNascimento'])) {
                                            echo '<script type="text/javascript">
                                                $("[name=estadoNascimento]").val("'.$linha["estadoNascimento"].'");
                                            </script>';
                                        } ?>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 md-form">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="municipioNascimento" style="position:relative; top: 0;">Naturalidade</label>
                                        </div>
                                        <select class="custom-select" name="municipioNascimento" id="municipioNascimento">
                                            <?php if(isset($linha['municipioNascimento'])) {}
                                                echo '<script type="text/javascript">
                                                    $("#municipioNascimento").append("<option value=\"'.$linha['municipioNascimento'].'\" selected>'.$linha['municipioNascimento'].'</option>");
                                                </script>';
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-sm-12 col-md-6 md-form abs-left">
                                    <div class="input-group selDiv">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="nacionalidade" style="position:relative; top: 0;">Nacionalidade</label>
                                        </div>
                                        <select class="custom-select" name="nacionalidade" id="nacionalidade">
                                            <option value="10" selected>Brasileira</option>
                                            <option value="20">Naturalizado brasileiro</option>
                                            <option value="21">Argentina</option>
                                            <option value="22">Boliviana</option>
                                            <option value="23">Chilena</option>
                                            <option value="24">Paraguaia</option>
                                            <option value="25">Uruguaia</option>
                                            <option value="30">Alemã</option>
                                            <option value="31">Belga</option>
                                            <option value="32">Britânica</option>
                                            <option value="34">Canadense</option>
                                            <option value="35">Espanhola</option>
                                            <option value="36">Norte americana</option>
                                            <option value="37">Francesa</option>
                                            <option value="38">Suíça</option>
                                            <option value="39">Italiana</option>
                                            <option value="41">Japonesa</option>
                                            <option value="42">Chinesa</option>
                                            <option value="43">Coreana</option>
                                            <option value="45">Portuguesa</option>
                                            <option value="48">Outros (América latina)</option>
                                            <option value="49">Outros (Asiáticos)</option>
                                            <option value="50">Outros (Indeterminado)</option>
                                        </select>
                                        <?php if(isset($linha['nacionalidade'])) {
                                            echo '<script type="text/javascript">
                                                $("option[value=\"10\"]").prop("selected", false);
                                                $("option[value=\"'.$linha['nacionalidade'].'\"]").prop("selected", true);
                                            </script>';
                                        } ?>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 md-form">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="escolaridade" style="position:relative; top: 0;">Escolaridade</label>
                                        </div>
                                        <select class="custom-select" name="escolaridade" id="escolaridade">
                                            <option value="1">Analfabeto(a)</option>
                                            <option value="2">Primário - Incompleto</option>
                                            <option value="3">Primário - Completo</option>
                                            <option value="4">Fundamental - Incompleto</option>
                                            <option value="5">Fundamental - Completo</option>
                                            <option value="6">Médio - Incompleto</option>
                                            <option value="7">Médio - Completo</option>
                                            <option value="8">Superior - Incompleto</option>
                                            <option value="9">Superior - Completo</option>
                                            <option value="10">Pós-graduação/Especialização</option>
                                            <option value="11">Mestrado</option>
                                            <option value="12">Doutorado</option>
                                            <option value="13">Pós-Doutorado</option>
                                        </select>
                                        <?php if(isset($linha['escolaridade'])) {
                                            echo '<script type="text/javascript">
                                                $("[name=escolaridade]").val("'.$linha["escolaridade"].'");
                                            </script>';
                                        } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row" id="linhaDataChegada"></div>

                            <div class="form-row">
                                <div class="col-lg-12 md-form">
                                    <input type="text" name="nomeMae" id="nomeMae" class="form-control" value="<?php if(isset($linha['nomeMae'])) { echo $linha['nomeMae']; } ?>">
                                    <label for="nomeMae">Nome da Mãe</label>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-12 md-form">
                                    <input type="text" name="nomePai" id="nomePai" class="form-control" value="<?php if(isset($linha['nomePai'])) { echo $linha['nomePai']; } ?>">
                                    <label for="nomePai">Nome do pai</label>
                                </div>
                            </div>
                        </div>

                        <div class="container bordas">
                            <div class="form-row">
                                <div class="col-lg-12 md-form">
                                    <input type="text" name="cep" id="cep" class="form-control" value="<?php if(isset($linha['cepEndereco'])) { echo $linha['cepEndereco']; } ?>">
                                    <label for="cep">CEP</label>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-6 md-form">
                                    <input type="text" name="endereco" id="endereco" class="form-control" value="<?php if(isset($linha['endereco'])) { echo $linha['endereco']; } ?>">
                                    <label for="endereco">Endereço</label>
                                </div>

                                <div class="col-lg-6 md-form">
                                    <input type="text" name="bairro" id="bairro" class="form-control" value="<?php if(isset($linha['bairroEndereco'])) { echo $linha['bairroEndereco']; } ?>">
                                    <label for="bairro">Bairro</label>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-6 md-form">
                                    <input type="text" name="numero" id="numero" class="form-control" value="<?php if(isset($linha['numero'])) { echo $linha['numero']; } ?>">
                                    <label for="numero">Número</label>
                                </div>
                                <div class="col-lg-6 md-form">
                                    <input type="text" name="complemento" id="complemento" class="form-control" value="<?php if(isset($linha['complemento'])) { echo $linha['complemento']; } ?>" maxlength="44">
                                    <label for="complemento">Complemento</label>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-6 md-form">
                                    <input type="text" name="cidade" id="cidade" class="form-control" value="<?php if(isset($linha['cidadeEndereco'])) { echo $linha['cidadeEndereco']; } ?>">
                                    <label for="cidade">Cidade</label>
                                </div>

                                <div class="col-lg-6 md-form">
                                    <input type="text" name="estado" id="estado" class="form-control" value="<?php if(isset($linha['estadoEndereco'])) { echo $linha['estadoEndereco']; } ?>">
                                    <label for="estado">Estado</label>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-12 md-form">
                                    <input type="text" name="telefone" id="telefone" class="form-control" value="<?php if(isset($linha['telefone'])) { echo $linha['telefone']; } ?>">
                                    <label for="telefone">Telefone</label>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-12 md-form">
                                    <input type="text" name="email" id="email" class="form-control" value="<?php if(isset($linha['email'])) { echo $linha['email']; } ?>">
                                    <label for="email">Email</label>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-sm-12 col-md-6 md-form">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="deficiencia" style="position:relative; top: 0;">Portador de deficiência?</label>
                                        </div>
                                        <select class="custom-select" name="deficiencia" id="deficiencia">
                                            <option value="0">Não</option>
                                            <option value="1">Física</option>
                                            <option value="2">Auditiva</option>
                                            <option value="3">Visual</option>
                                            <option value="4">Mental</option>
                                            <option value="5">Múltipla</option>
                                            <option value="6">Reabilitado</option>
                                        </select>
                                        <?php if(isset($linha['deficiencia'])) {
                                            echo '<script type="text/javascript">
                                                $("[name=deficiencia]").val("'.$linha["deficiencia"].'");
                                            </script>';
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                            for($i = 1; $i <= 7; $i++) {
                                if(isset($linha['nomeDep'.$i])) {
                                    echo "<div class=\"container bordas\">" . "<div class=\"form-row\">" .
                                        "<div class=\"col-sm-12 md-form abs-left\">" .
                                            "<label for=\"nomeDependente" . $i . "\">Nome do dependente " . $i . "</label>" .
                                            "<input type=\"text\" name=\"nomeDependente" . $i . "\" id=\"nomeDependente" . $i . "\" class=\"form-control\" style=\"display: inline !important; margin-left: 10px;\" value=\"".$linha['nomeDep'.$i]."\">" .
                                        "</div>" .
                                    "</div>" .

                                    "<div class=\"form-row\">" .
                                        "<div class=\"col-sm-12 md-form\">" .
                                            "<label for=\"cpfDependente" . $i . "\">CPF</label>" .
                                            "<input type=\"text\" name=\"cpfDependente" . $i . "\" id=\"cpfDependente" . $i . "\" class=\"form-control\" value=\"".$linha['cpfDep'.$i]."\">" .
                                        "</div>" .
                                    "</div>" .

                                    "<div class=\"form-row\">" .
                                        "<div class=\"col-sm-12 abs-left\">" .
                                            "<label for=\"dataNascimentoDependente" . $i . "\" style=\"position: relative !important; top: 0;\">Data de Nascimento</label>" .
                                            "<input type=\"date\" name=\"dataNascimentoDependente" . $i . "\" id=\"dataNascimentoDependente" . $i . "\" class=\"form-control\" style=\"width: 200px; display: inline !important; margin-left: 10px;\" value=\"".$linha['nascimentoDep'.$i]."\">" .
                                        "</div>" .
                                    "</div>" .

                                    "<div class=\"form-row\">" .
                                        "<div class=\"col-sm-12 col-md-8 col-lg-6 md-form abs-left\">" .
                                            "<div class=\"input-group\">" .
                                                "<div class=\"input-group-prepend\">" .
                                                    "<label class=\"input-group-text\" for=\"grauParentesco" . $i . "\" style=\"position: relative !important; top: 0; margin-bottom: 10px;\">Grau de parentesco</label>" .
                                                "</div>" .
                                                "<select class=\"custom-select\" name=\"grauParentesco" . $i . "\" id=\"grauParentesco" . $i . "\">" .
                                                    "<option value=\"1\">Filho(a)</option>" .
                                                    "<option value=\"3\">Enteado(a)</option>" .
                                                    "<option value=\"7\">Menor pobre com guarda</option>" .
                                                    "<option value=\"9\">Conjuge</option>" .
                                                    "<option value=\"10\">Companheiro(a)</option>" .
                                                    "<option value=\"11\">Pais</option>" .
                                                    "<option value=\"12\">Avós</option>" .
                                                    "<option value=\"14\">Irmão(a) com guarda</option>" .
                                                    "<option value=\"18\">Neto(a) com guarda</option>" .
                                                "</select>" .
                                            "</div>" .
                                        "</div>" .
                                    "</div>" . "</div>";

                                    echo '<script type="text/javascript">
                                        $("[name=grauParentesco'.$i.']").val("'.$linha["grauParentescoDep$i"].'");
                                    </script>';
                                }
                            }
                        ?>

                        <div class="container bordas">
                            <div class="form-row">
                                <div class="col-sm-12 col-md-4 md-form">
                                    <input type="text" name="salario" id="salario" class="form-control" value="<?php if(isset($linha['valorSalario'])) { echo $linha['valorSalario']; } ?>">
                                    <label for="salario">Valor do salário</label>
                                </div>

                                <div class="col-sm-12 col-md-8 md-form">
                                    <input type="text" name="cargo" id="cargo" class="form-control" value="<?php if(isset($linha['cargoAdmissao'])) { echo $linha['cargoAdmissao']; } ?>">
                                    <label for="cargo">Cargo de admissão</label>
                                </div>
                            </div>
                        </div>

                        <div class="container bordas">
                            <div class="form-row">
                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 md-form">
                                    <input type="text" name="ctps" id="ctps" class="form-control" value="<?php if(isset($linha['ctps'])) { echo $linha['ctps']; } ?>">
                                    <label for="ctps">CTPS</label>
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-3 col-xl-2 md-form">
                                    <input type="text" name="serie" id="serieCtps" class="form-control" value="<?php if(isset($linha['serieCtps'])) { echo $linha['serieCtps']; } ?>">
                                    <label for="serie">Série</label>
                                </div>

                                <div class="col-sm-12 col-md-2 col-lg-4 col-xl-2 md-form abs-left">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="ufctps" style="position:relative; top: 0;">UF</label>
                                        </div>
                                        <select class="custom-select" name="ufctps" id="ufctps">
                                            <option value="AC">AC</option>
                                            <option value="AL">AL</option>
                                            <option value="AP">AP</option>
                                            <option value="AM">AM</option>
                                            <option value="BA">BA</option>
                                            <option value="CE">CE</option>
                                            <option value="DF">DF</option>
                                            <option value="ES">ES</option>
                                            <option value="GO">GO</option>
                                            <option value="MA">MA</option>
                                            <option value="MT">MT</option>
                                            <option value="MS">MS</option>
                                            <option value="MG">MG</option>
                                            <option value="PA">PA</option>
                                            <option value="PB">PB</option>
                                            <option value="PR">PR</option>
                                            <option value="PE">PE</option>
                                            <option value="PI">PI</option>
                                            <option value="RJ">RJ</option>
                                            <option value="RN">RN</option>
                                            <option value="RS">RS</option>
                                            <option value="RO">RO</option>
                                            <option value="RR">RR</option>
                                            <option value="SC">SC</option>
                                            <option value="SP">SP</option>
                                            <option value="SE">SE</option>
                                            <option value="TO">TO</option>
                                        </select>
                                        <?php
                                            if(isset($linha['ufCtps'])) {
                                                echo '<script type="text/javascript">
                                                    $("[name=ufctps]").val("'.$linha["ufCtps"].'");
                                                </script>';
                                            }
                                        ?>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-5 abs-left md-form">
                                    <label for="dataExpedicao" style="position: relative;">Data de Expedição</label>
                                    <input type="date" name="dataExpedicao" id="dataExpedicao" value="<?php if(isset($linha['dataExpedicaoCtps'])) { echo $linha['dataExpedicaoCtps']; } ?>" style="width: 150px; display: inline !important; margin-left: 10px;" class="form-control">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-sm-12 col-md-6 md-form">
                                    <input type="text" name="pis" id="pis" class="form-control" value="<?php if(isset($linha['pis'])) { echo $linha['pis']; } ?>">
                                    <label for="pis">PIS</label>
                                </div>

                                <div class="col-sm-12 col-md-6 md-form">
                                    <input type="text" name="cpf" id="cpf" class="form-control" value="<?php if(isset($linha['cpf'])) { echo $linha['cpf']; } ?>">
                                    <label for="cpf">CPF</label>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-sm-12 col-md-3 col-lg-4 col-xl-4 md-form abs-left">
                                    <input type="text" name="rg" id="rg" class="form-control" value="<?php if(isset($linha['rg'])) { echo $linha['rg']; } ?>">
                                    <label for="rg">RG</label>
                                </div>

                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 md-form">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="ufrg" style="position:relative; top: 0;">UF</label>
                                        </div>
                                        <select class="custom-select" name="ufrg" id="ufrg">
                                            <option value="AC">AC</option>
                                            <option value="AL">AL</option>
                                            <option value="AP">AP</option>
                                            <option value="AM">AM</option>
                                            <option value="BA">BA</option>
                                            <option value="CE">CE</option>
                                            <option value="DF">DF</option>
                                            <option value="ES">ES</option>
                                            <option value="GO">GO</option>
                                            <option value="MA">MA</option>
                                            <option value="MT">MT</option>
                                            <option value="MS">MS</option>
                                            <option value="MG">MG</option>
                                            <option value="PA">PA</option>
                                            <option value="PB">PB</option>
                                            <option value="PR">PR</option>
                                            <option value="PE">PE</option>
                                            <option value="PI">PI</option>
                                            <option value="RJ">RJ</option>
                                            <option value="RN">RN</option>
                                            <option value="RS">RS</option>
                                            <option value="RO">RO</option>
                                            <option value="RR">RR</option>
                                            <option value="SC">SC</option>
                                            <option value="SP">SP</option>
                                            <option value="SE">SE</option>
                                            <option value="TO">TO</option>
                                        </select>
                                        <?php
                                            if(isset($linha['ufRG'])) {
                                                echo '<script type="text/javascript">
                                                    $("[name=ufrg]").val("'.$linha["ufRG"].'");
                                                </script>';
                                            }
                                        ?>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-7 col-lg-6 col-xl-6 abs-left md-form">
                                    <label style="position: relative;">Data de Emissão</label>
                                    <input type="date" name="dataEmissao" id="dataEmissao" value="<?php if(isset($linha['dataEmissaoRg'])) { echo $linha['dataEmissaoRg']; } ?>" style="width: 150px; display: inline !important; margin-left: 10px;" class="form-control">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-sm-12 col-md-4 md-form">
                                    <input type="text" name="tituloEleitor" id="tituloEleitor" class="form-control" value="<?php if(isset($linha['tituloEleitor'])) { echo $linha['tituloEleitor']; } ?>">
                                    <label for="tituloEleitor">Título de eleitor</label>
                                </div>

                                <div class="col-sm-12 col-md-4 md-form">
                                    <input type="text" name="zona" id="zona" class="form-control" value="<?php if(isset($linha['zonaTituloEleitor'])) { echo $linha['zonaTituloEleitor']; } ?>">
                                    <label for="zona">Zona</label>
                                </div>

                                <div class="col-sm-12 col-md-4 md-form">
                                    <input type="text" name="secao" id="secao" class="form-control" value="<?php if(isset($linha['secaoTituloEleitor'])) { echo $linha['secaoTituloEleitor']; } ?>">
                                    <label for="secao">Seção</label>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-12 md-form abs-left">
                                    <label class="label" style="position: relative !important;">Vale transporte?</label>

                                    <label class="radio-container m-l-10" style="position: relative !important;">Sim
                                        <input type="radio" <?php if(isset($linha['valeTransporte']) && $linha['valeTransporte'] == '1') { echo 'checked="checked"'; } ?> name="valeTransporte" id="valeTransporteSim" value="sim">
                                    </label>

                                    <label class="radio-container m-l-10" style="position: relative !important;">Não
                                        <input type="radio" <?php if((isset($linha['valeTransporte']) && $linha['valeTransporte'] == '0') || !isset($linha['valeTransporte'])) { echo 'checked="checked"'; } ?> name="valeTransporte" id="valeTransporteNao" value="nao">
                                    </label>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-12 md-form abs-left">
                                    <label class="label" style="position: relative !important;">Desconta vale transporte?</label>

                                    <label class="radio-container m-l-10" style="position: relative !important;">Sim
                                        <input type="radio" <?php if(isset($linha['descontaValeTransporte']) && $linha['descontaValeTransporte'] == '1') { echo 'checked="checked"'; } ?> name="descontaValeTransporte" id="descontaValeTransporteSim" value="sim">
                                    </label>

                                    <label class="radio-container m-l-10" style="position: relative !important;">Não
                                        <input type="radio" <?php if((isset($linha['descontaValeTransporte']) && $linha['descontaValeTransporte'] == '0') || !isset($linha['descontaValeTransporte'])) { echo 'checked="checked"'; } ?> name="descontaValeTransporte" id="descontaValeTransporteNao" value="nao">
                                    </label>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-12 md-form abs-left">
                                    <label class="label" style="position: relative !important;">Desconta sindicato?</label>

                                    <label class="radio-container m-l-10" style="position: relative !important;">Sim
                                        <input type="radio" <?php if(isset($linha['descontaSindicato']) && $linha['descontaSindicato'] == '1') { echo 'checked="checked"'; } ?> name="descontaSindicato" id="descontaSindicatoSim" value="sim">
                                    </label>

                                    <label class="radio-container m-l-10" style="position: relative !important;">Não
                                        <input type="radio" <?php if((isset($linha['descontaSindicato']) && $linha['descontaSindicato'] == '0') || !isset($linha['descontaSindicato'])) { echo 'checked="checked"'; } ?> name="descontaSindicato" id="descontaSindicatoNao" value="nao">
                                    </label>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="col-lg-6 abs-left">
                                    <label>Data do Exame Médico</label>
                                    <input type="date" name="dataExameMedico" style="width: 200px; display: inline !important; margin-left: 10px; margin-top: 20px;" class="form-control" value="<?php if(isset($linha['dataExameMedico'])) { echo $linha['dataExameMedico']; } ?>">
                                </div>
                            </div>

                            <div class='form-row'>
                                <div class='col-sm-12 col-md-6 md-form'>
                                    <input type='text' name='tipoValeTransporteIda' id='tipoValeTransporteIda' class='form-control' value='<?php if(isset($linha["tipoValeTransporteIda"])) { echo $linha["tipoValeTransporteIda"]; } ?>'>
                                    <label for='tipoValeTransporteIda'>Tipo de vale transporte - ida</label>
                                </div>

                                <div class='col-sm-12 col-md-6 md-form'>
                                    <input type='text' name='valorValeTransporteIda' id='valorValeTransporteIda' class='form-control' value='<?php if(isset($linha["valorValeTransporteIda"])) { echo $linha["valorValeTransporteIda"]; } ?>'>
                                    <label for='valorValeTransporteIda'>Valor - ida</label>
                                </div>
                            </div>
                            
                            <div class='form-row'>
                                <div class='col-sm-12 col-md-6 md-form'>
                                    <input type='text' name='tipoValeTransporteVolta' id='tipoValeTransporteVolta' class='form-control' value='<?php if(isset($linha["tipoValeTransporteVolta"])) { echo $linha["tipoValeTransporteVolta"]; } ?>'>
                                    <label for='tipoValeTransporteVolta'>Tipo de vale transporte - volta</label>
                                </div>

                                <div class='col-sm-12 col-md-6 md-form'>
                                    <input type='text' name='valorValeTransporteVolta' id='valorValeTransporteVolta' class='form-control' value='<?php if(isset($linha["valorValeTransporteVolta"])) { echo $linha["valorValeTransporteVolta"]; } ?>'>
                                    <label for='valorValeTransporteVolta'>Valor - volta</label>
                                </div>
                            </div>
                        </div>

                        <div class="container bordas">
                            <div class="form-row">
                                <div class="col-lg-6 md-form">
                                    <input type="text" name="cnh" id="cnh" class="form-control" value="<?php if(isset($linha['cnh'])) { echo $linha['cnh']; } ?>">
                                    <label for="cnh">CNH (cargo de motorista)</label>
                                </div>
                                <div class="col-lg-6 md-form">
                                    <input type="text" name="categoriaCnh" id="categoriaCnh" class="form-control" value="<?php if(isset($linha['categoriaCnh'])) { echo $linha['categoriaCnh']; } ?>">
                                    <label for="categoriaCnh">Categoria</label>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-6 abs-left">
                                    <label>Data de Expedição</label>
                                    <input type="date" name="dataCnh" style="width: 200px; display: inline !important; margin-left: 10px;" class="form-control" value="<?php if(isset($linha['dataExpedicaoCnh'])) { echo $linha['dataExpedicaoCnh']; } ?>">
                                </div>

                                <div class="col-lg-6 abs-left">
                                    <label>Validade</label>
                                    <input type="date" name="validadeCnh" style="width: 200px; display: inline !important; margin-left: 10px;" class="form-control" value="<?php if(isset($linha['validadeCnh'])) { echo $linha['validadeCnh']; } ?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-6 md-form">
                                    <input type="text" name="rne" id="rne" class="form-control" value="<?php if(isset($linha['rne'])) { echo $linha['rne']; } ?>">
                                    <label for="rne">RNE (para estrangeiros)</label>
                                </div>
                                <div class="col-lg-6 abs-left" style="margin-top: 20px !important;">
                                    <label>Validade</label>
                                    <input type="date" name="validadeRne" style="width: 200px; display: inline !important; margin-left: 10px;" class="form-control" value="<?php if(isset($linha['validadeRne'])) { echo $linha['validadeRne']; } ?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-6 md-form">
                                    <input type="text" name="nomeConselhoRegional" id="nomeConselhoRegional" class="form-control" value="<?php if(isset($linha['nomeConselhoRegional'])) { echo $linha['nomeConselhoRegional']; } ?>">
                                    <label for="nomeConselhoRegional">Nome do conselho regional</label>
                                </div>
                                <div class="col-lg-6 md-form">
                                    <input type="text" name="numeroConselhoRegional" id="numeroConselhoRegional" class="form-control" value="<?php if(isset($linha['numeroConselhoRegional'])) { echo $linha['numeroConselhoRegional']; } ?>">
                                    <label for="numeroConselhoRegional">Número</label>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-6 abs-left">
                                    <label for="emissaoConselhoRegional">Emissão</label>
                                    <input type="date" name="emissaoConselhoRegional" style="width: 200px; display: inline !important; margin-left: 10px;" class="form-control" value="<?php if(isset($linha['dataEmissaoConselhoRegional'])) { echo $linha['dataEmissaoConselhoRegional']; } ?>">
                                </div>

                                <div class="col-lg-6 abs-left">
                                    <label for="vencimentoConselhoRegional">Vencimento</label>
                                    <input type="date" name="vencimentoConselhoRegional" style="width: 200px; display: inline !important; margin-left: 10px;" class="form-control" value="<?php if(isset($linha['dataVencimentoConselhoRegional'])) { echo $linha['dataVencimentoConselhoRegional'];} ?>">
                                </div>
                            </div>
                        </div>

                        <div class="container bordas">
                            <?php
                                if(isset($linha['entradaSegunda'])) {
                                    echo "<div class=\"col-lg-12 abs-left\">
                                        <label class=\"label\" style=\"position: relative !important;\"><strong>Segunda</strong></label>
                                    </div>
                                    <div class=\"form-row\">
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"entradaSegunda\" id=\"entradaSegunda\" class=\"form-control\" value=\"" . $linha['entradaSegunda'] . "\">
                                            <label for=\"entradaSegunda\">Entrada</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"saidaSegunda\" id=\"saidaSegunda\" class=\"form-control\" value=\"" . $linha['saidaSegunda'] . "\">
                                            <label for=\"saidaSegunda\">Saída</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form text-right\">
                                            <label class=\"label\" style=\"position: relative !important;\"> <strong>Almoço/repouso</strong> </label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"almocoSaidaSegunda\" id=\"almocoSaidaSegunda\" class=\"form-control\" value=\"" . $linha['almocoSaidaSegunda'] . "\">
                                            <label for=\"almocoSaidaSegunda\">Entrada almoço</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"almocoVoltaSegunda\" id=\"almocoVoltaSegunda\" class=\"form-control\" value=\"" . $linha['almocoVoltaSegunda'] . "\">
                                            <label for=\"almocoVoltaSegunda\">Volta almoço</label>
                                        </div>
                                    </div>";
                                }
        
                                if(isset($linha['entradaTerca'])) {
                                    echo "<div class=\"col-lg-12 abs-left\">
                                        <label class=\"label\" style=\"position: relative !important;\"><strong>Terça</strong></label>
                                    </div>
                                    <div class=\"form-row\">
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"entradaTerça\" id=\"entradaTerça\" class=\"form-control\" value=\"" . $linha['entradaTerca'] . "\">
                                            <label for=\"entradaTerça\">Entrada</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"saidaTerça\" id=\"saidaTerça\" class=\"form-control\" value=\"" . $linha['saidaTerca'] . "\">
                                            <label for=\"saidaTerça\">Saída</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form text-right\">
                                            <label class=\"label\" style=\"position: relative !important;\"> <strong>Almoço/repouso</strong> </label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"almocoSaidaTerça\" id=\"almocoSaidaTerça\" class=\"form-control\" value=\"" . $linha['almocoSaidaTerca'] . "\">
                                            <label for=\"almocoSaidaTerça\">Entrada almoço</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"almocoVoltaTerça\" id=\"almocoVoltaTerça\" class=\"form-control\" value=\"" . $linha['almocoVoltaTerca'] . "\">
                                            <label for=\"almocoVoltaTerça\">Volta almoço</label>
                                        </div>
                                    </div>";
                                }
        
                                if(isset($linha['entradaQuarta'])) {
                                    echo "<div class=\"col-lg-12 abs-left\">
                                        <label class=\"label\" style=\"position: relative !important;\"><strong>Quarta</strong></label>
                                    </div>
                                    <div class=\"form-row\">
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"entradaQuarta\" id=\"entradaQuarta\" class=\"form-control\" value=\"" . $linha['entradaQuarta'] . "\">
                                            <label for=\"entradaQuarta\">Entrada</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"saidaQuarta\" id=\"saidaQuarta\" class=\"form-control\" value=\"" . $linha['saidaQuarta'] . "\">
                                            <label for=\"saidaQuarta\">Saída</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form text-right\">
                                            <label class=\"label\" style=\"position: relative !important;\"> <strong>Almoço/repouso</strong> </label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"almocoSaidaQuarta\" id=\"almocoSaidaQuarta\" class=\"form-control\" value=\"" . $linha['almocoSaidaQuarta'] . "\">
                                            <label for=\"almocoSaidaQuarta\">Entrada almoço</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"almocoVoltaQuarta\" id=\"almocoVoltaQuarta\" class=\"form-control\" value=\"" . $linha['almocoVoltaQuarta'] . "\">
                                            <label for=\"almocoVoltaQuarta\">Volta almoço</label>
                                        </div>
                                    </div>";
                                }
        
                                if(isset($linha['entradaQuinta'])) {
                                    echo "<div class=\"col-lg-12 abs-left\">
                                        <label class=\"label\" style=\"position: relative !important;\"><strong>Quinta</strong></label>
                                    </div>
                                    <div class=\"form-row\">
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"entradaQuinta\" id=\"entradaQuinta\" class=\"form-control\" value=\"" . $linha['entradaQuinta'] . "\">
                                            <label for=\"entradaQuinta\">Entrada</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"saidaQuinta\" id=\"saidaQuinta\" class=\"form-control\" value=\"" . $linha['saidaQuinta'] . "\">
                                            <label for=\"saidaQuinta\">Saída</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form text-right\">
                                            <label class=\"label\" style=\"position: relative !important;\"> <strong>Almoço/repouso</strong> </label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"almocoSaidaQuinta\" id=\"almocoSaidaQuinta\" class=\"form-control\" value=\"" . $linha['almocoSaidaQuinta'] . "\">
                                            <label for=\"almocoSaidaQuinta\">Entrada almoço</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"almocoVoltaQuinta\" id=\"almocoVoltaQuinta\" class=\"form-control\" value=\"" . $linha['almocoVoltaQuinta'] . "\">
                                            <label for=\"almocoVoltaQuinta\">Volta almoço</label>
                                        </div>
                                    </div>";
                                }
        
                                if(isset($linha['entradaSexta'])) {
                                    echo "<div class=\"col-lg-12 abs-left\">
                                        <label class=\"label\" style=\"position: relative !important;\"><strong>Sexta</strong></label>
                                    </div>
                                    <div class=\"form-row\">
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"entradaSexta\" id=\"entradaSexta\" class=\"form-control\" value=\"" . $linha['entradaSexta'] . "\">
                                            <label for=\"entradaSexta\">Entrada</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"saidaSexta\" id=\"saidaSexta\" class=\"form-control\" value=\"" . $linha['saidaSexta'] . "\">
                                            <label for=\"saidaSexta\">Saída</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form text-right\">
                                            <label class=\"label\" style=\"position: relative !important;\"> <strong>Almoço/repouso</strong> </label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"almocoSaidaSexta\" id=\"almocoSaidaSexta\" class=\"form-control\" value=\"" . $linha['almocoSaidaSexta'] . "\">
                                            <label for=\"almocoSaidaSexta\">Entrada almoço</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"almocoVoltaSexta\" id=\"almocoVoltaSexta\" class=\"form-control\" value=\"" . $linha['almocoVoltaSexta'] . "\">
                                            <label for=\"almocoVoltaSexta\">Volta almoço</label>
                                        </div>
                                    </div>";
                                }
        
                                if(isset($linha['entradaSabado'])) {
                                    echo "<div class=\"col-lg-12 abs-left\">
                                        <label class=\"label\" style=\"position: relative !important;\"><strong>Sábado</strong></label>
                                    </div>
                                    <div class=\"form-row\">
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"entradaSábado\" id=\"entradaSábado\" class=\"form-control\" value=\"" . $linha['entradaSabado'] . "\">
                                            <label for=\"entradaSábado\">Entrada</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"saidaSábado\" id=\"saidaSábado\" class=\"form-control\" value=\"" . $linha['saidaSabado'] . "\">
                                            <label for=\"saidaSábado\">Saída</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form text-right\">
                                            <label class=\"label\" style=\"position: relative !important;\"> <strong>Almoço/repouso</strong> </label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"almocoSaidaSábado\" id=\"almocoSaidaSábado\" class=\"form-control\" value=\"" . $linha['almocoSaidaSabado'] . "\">
                                            <label for=\"almocoSaidaSábado\">Entrada almoço</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"almocoVoltaSábado\" id=\"almocoVoltaSábado\" class=\"form-control\" value=\"" . $linha['almocoVoltaSabado'] . "\">
                                            <label for=\"almocoVoltaSábado\">Volta almoço</label>
                                        </div>
                                    </div>";
                                }
        
                                if(isset($linha['entradaDomingo'])) {
                                    echo "<div class=\"col-lg-12 abs-left\">
                                        <label class=\"label\" style=\"position: relative !important;\"><strong>Domingo</strong></label>
                                    </div>
                                    <div class=\"form-row\">
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"entradaDomingo\" id=\"entradaDomingo\" class=\"form-control\" value=\"" . $linha['entradaDomingo'] . "\">
                                            <label for=\"entradaDomingo\">Entrada</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"saidaDomingo\" id=\"saidaDomingo\" class=\"form-control\" value=\"" . $linha['saidaDomingo'] . "\">
                                            <label for=\"saidaDomingo\">Saída</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form text-right\">
                                            <label class=\"label\" style=\"position: relative !important;\"> <strong>Almoço/repouso</strong> </label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"almocoSaidaDomingo\" id=\"almocoSaidaDomingo\" class=\"form-control\" value=\"" . $linha['almocoSaidaDomingo'] . "\">
                                            <label for=\"almocoSaidaDomingo\">Entrada almoço</label>
                                        </div>
                                        <div class=\"col-lg-2 md-form\">
                                            <input type=\"text\" name=\"almocoVoltaDomingo\" id=\"almocoVoltaDomingo\" class=\"form-control\" value=\"" . $linha['almocoVoltaDomingo'] . "\">
                                            <label for=\"almocoVoltaDomingo\">Volta almoço</label>
                                        </div>
                                    </div>";
                                }
                            ?>
                        </div>

                        <div class="container bordas">
                            <div class="form-row">
                                <div class="col-sm-12 md-form abs-left">
                                    RG
                                </div>
                            </div>

                            <div class="form-row">
                                <?php
                                    if(isset($linha['arquivoRg'])) {
                                        echo '<img src="../uploads/ficha-' . $id . '/' . $linha['arquivoRg'] . '" style="object-fit: contain; max-width: 100%; object-position: center top; max-height: 300px;"/>';
                                    }
                                ?>
                            </div>

                            <?php
                                if(isset($linha['arquivoCpf'])) {
                                    echo
                                    '<div class="form-row">
                                        <div class="col-sm-12 md-form abs-left">
                                            CPF
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <img src="../uploads/ficha-' . $id . '/' . $linha['arquivoCpf'] . '" style="object-fit: contain; max-width: 100%; object-position: center top; max-height: 300px;"/>
                                    </div>';
                                }
                            ?>
                            
                            <?php
                                if(isset($linha['arquivoPis'])) {
                                    echo
                                    '<div class="form-row">
                                        <div class="col-sm-12 md-form abs-left">
                                            PIS
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <img src="../uploads/ficha-' . $id . '/' . $linha['arquivoPis'] . '" style="object-fit: contain; max-width: 100%; object-position: center top; max-height: 300px;"/>
                                    </div>';
                                }
                            ?>
                            
                            <?php
                                if(isset($linha['arquivoCtps'])) {
                                    echo
                                    '<div class="form-row">
                                        <div class="col-sm-12 md-form abs-left">
                                            CTPS
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <img src="../uploads/ficha-' . $id . '/' . $linha['arquivoCtps'] . '" style="object-fit: contain; max-width: 100%; object-position: center top; max-height: 300px;"/>
                                    </div>';
                                }
                            ?>

                            <?php
                                if(isset($linha['arquivoExame'])) {
                                    echo
                                    '<div class="form-row">
                                        <div class="col-sm-12 md-form abs-left">
                                            Exame Admissional
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <img src="../uploads/ficha-' . $id . '/' . $linha['arquivoExame'] . '" style="object-fit: contain; max-width: 100%; object-position: center top; max-height: 300px;"/>
                                    </div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JQuery Mask -->
    <script type="text/javascript" src="../js/jquery.mask.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../js/mdb.js"></script>
    <!-- Custom JS -->
    <script type="text/javascript" src="js/visualizar.js"></script>
</body>

</html>

<?php
    }
?>
