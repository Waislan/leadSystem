<?php
    session_start();
    
    require_once("php/verificar-login.php");
    require_once("php/get-campos-obrigatorios.php");

    verificarLogin();
    getCamposObrigatorios();

    include("header.php");
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Gerenciar campos</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Campos</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <form name="formCampos" method="POST" class="form-signin" action="php/atualizar-campos.php">
                    <div class="panel-heading" style="min-height: 60px; height: auto;">
                        <div class="col-sm-12 col-md-6">
                            Obrigatoriedade nos campos do formulário
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive col-md-12">
                            <table id="dataTable" name="dataTable" class="display table table-striped table-hover">
                                <thead style="display: flex;">
                                    <tr>
                                        <th class="col-lg-6">Campo / Obrigatoriedade</th>
                                    </tr>
                                </thead>
                                <tbody style="display: flex;">
                                    <tr>
                                        <td>Nome</td>
                                        <td>
                                            <select class="custom-select" name="selectNome" id="selectNome">
                                                <option value="true">Obrigatório</option>
                                                <option value="false">Opcional</option>
                                            </select>
                                            <?php if (isset($_SESSION['selectNome'])) {
                                                echo '<script type="text/javascript">
                                                $("[name=selectNome]").val("' . $_SESSION["selectNome"] . '");
                                                </script>';
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>
                                            <select class="custom-select" name="selectEmail" id="selectEmail">
                                                <option value="true">Obrigatório</option>
                                                <option value="false">Opcional</option>
                                            </select>
                                            <?php if (isset($_SESSION['selectEmail'])) {
                                                echo '<script type="text/javascript">
                                                $("[name=selectEmail]").val("' . $_SESSION["selectEmail"] . '");
                                                </script>';
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Telefone</td>
                                        <td>
                                            <select class="custom-select" name="selectTelefone" id="selectTelefone">
                                                <option value="true">Obrigatório</option>
                                                <option value="false">Opcional</option>
                                            </select>
                                            <?php if (isset($_SESSION['selectTelefone'])) {
                                                echo '<script type="text/javascript">
                                                $("[name=selectTelefone]").val("' . $_SESSION["selectTelefone"] . '");
                                                </script>';
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CEP</td>
                                        <td>
                                            <select class="custom-select" name="selectCep" id="selectCep">
                                                <option value="true">Obrigatório</option>
                                                <option value="false">Opcional</option>
                                            </select>
                                            <?php if (isset($_SESSION['selectCep'])) {
                                                echo '<script type="text/javascript">
                                                $("[name=selectCep]").val("' . $_SESSION["selectCep"] . '");
                                                </script>';
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Endereço</td>
                                        <td>
                                            <select class="custom-select" name="selectEndereco" id="selectEndereco">
                                                <option value="true">Obrigatório</option>
                                                <option value="false">Opcional</option>
                                            </select>
                                            <?php if (isset($_SESSION['selectEndereco'])) {
                                                echo '<script type="text/javascript">
                                                $("[name=selectEndereco]").val("' . $_SESSION["selectEndereco"] . '");
                                                </script>';
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Número</td>
                                        <td>
                                            <select class="custom-select" name="selectNumero" id="selectNumero">
                                                <option value="true">Obrigatório</option>
                                                <option value="false">Opcional</option>
                                            </select>
                                            <?php if (isset($_SESSION['selectNumero'])) {
                                                echo '<script type="text/javascript">
                                                $("[name=selectNumero]").val("' . $_SESSION["selectNumero"] . '");
                                                </script>';
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bairro</td>
                                        <td>
                                            <select class="custom-select" name="selectBairro" id="selectBairro">
                                                <option value="true">Obrigatório</option>
                                                <option value="false">Opcional</option>
                                            </select>
                                            <?php if (isset($_SESSION['selectBairro'])) {
                                                echo '<script type="text/javascript">
                                                $("[name=selectBairro]").val("' . $_SESSION["selectBairro"] . '");
                                                </script>';
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cidade</td>
                                        <td>
                                            <select class="custom-select" name="selectCidade" id="selectCidade">
                                                <option value="true">Obrigatório</option>
                                                <option value="false">Opcional</option>
                                            </select>
                                            <?php if (isset($_SESSION['selectCidade'])) {
                                                echo '<script type="text/javascript">
                                                $("[name=selectCidade]").val("' . $_SESSION["selectCidade"] . '");
                                                </script>';
                                            } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row" style="display: flex; justify-content: center;">
                            <button id="atualizar" name="atualizar" class="btn btn-deafult" type="button">Atualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JQuery scripts -->
<script type="script/javascript" src="../js/jquery-3.3.1.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="../js/mdb.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="js/bootstrap.min.js"></script>

<!-- Arquivos para o dataTables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

<!-- Funções -->
<script type="text/javascript" src="js/gerenciar-campos.js"></script>