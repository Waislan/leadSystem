<?php
    session_start();

    require_once("../conexao.php");
    require_once("php/verificar-login.php");

    verificarLogin();

    include("header.php");
    /*
    $conn = mysqli_connect("localhost", "u745700149_waislan", "L/NnVWHd", "u745700149_leaderAdmin");

    if (isset($_POST["import"])) {

        $fileName = $_FILES["file"]["tmp_name"];
        $data = date("Y-m-d");

        if ($_FILES["file"]["size"] > 0) {

            $file = fopen($fileName, "r");

            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                $sqlInsert = "INSERT INTO cep (cep) VALUES ('" . $column[0] . "');";
                $result = mysqli_query($conn, $sqlInsert);

                if (!empty($result)) {
                    $type = "success";
                    $_SESSION['sucesso'] = "Arquivo importado com sucesso!";
                } else {
                    $type = "error";
                    $_SESSION['erro'] = "Ops, parece que houve um erro na importação! Verifique se o seu arquivo segue o modelo de importação do sistema ou contacte o administrador.";
                }
            }
        }
    }
    */
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
<div class="row">
    <ol class="breadcrumb">
        <li><a href="index.php">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">Gerenciar CEP's</li>
    </ol>
</div>

<div class="row">
    <div class="col-lg-12">
    </div>
</div>

<div class="panel panel-container">
    <div class="row">
        <div class="col-xs-12 no-padding">
            <div class="panel panel-teal panel-widget border-right">
                <div class="row no-padding"><em class="fas fa-check color-blue" style="font-size: 30px;"></em>
                    <div class="large"><?php if ($result = $conexao->query("SELECT * FROM cep;")) {
                                            echo $result->num_rows;
                                        } ?></div>
                    <div class="text-muted">CEP's cadastrados</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="min-height: 60px; height: auto;">
                <div class="col-sm-12 col-md-6">
                    Insira, importe, pesquise e exporte
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="row" style="display: flex; justify-content: flex-end; margin-right: 5px;">
                        <form class="form-row" id="formExport" action="php/exportar-ceps.php" method="POST" name="download_excel" enctype="multipart/form-data">
                            <span class="input-group-btn">
                                <input class="form-control" id="inputCep" name="inputCep" style="width: 150px; display: inline !important; margin-left: 50px;" placeholder="Insira um CEP" maxlength="9">
                                <button id="btnPesquisarCep" name="btnPesquisarCep" class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                <button id="btnImportarCep" name="btnImportarCep" class="btn btn-default" type="button"><span class="fas fa-upload" aria-hidden="true"></span></button>
                                <button id="exportarListaCep" name="exportarListaCep" class="btn btn-default" type="submit"><span class="glyphicon glyphicon-download-alt" aria-hidden="true" value="Exportar"></span></button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive col-md-12">
                    <table id="dataTable" name="dataTable" class="display table table-striped table-hover">
                        
                    </table>
                </div>
            </div>
            <div class="panel-footer" style="min-height: 60px; height: auto;">
                <div class="col-md-12">
                    <div class="row" style="display: flex; justify-content: flex-end; margin-right: 5px;">
                        <label style="margin-right: 50px;">Importe em CSV</label>
                        <form style="margin-left: 10px;" method="POST" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                            <label id="labelImport" class="btn btn-default" type="button" for="file">Procurar</label>
                            <input style="display: none;" class="btn" type="file" name="file" id="file" accept=".csv">
                            <button class="btn btn-default" type="submit" id="import" name="import" class="btn-submit">Importar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- BOOTSTRAP SCRIPTS -->
<script src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="../js/mdb.js"></script>
<!-- Bootbox -->
<script type="text/javascript" src="js/bootbox.min.js"></script>
<script type="text/javascript" src="js/bootbox.locales.min.js"></script>
<!-- CUSTOM SCRIPTS -->
<script type="text/javascript" src="ajax/procurar-empresa.js"></script>
<script type="text/javascript" src="js/custom.js"></script>

<!-- Arquivos para o dataTables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

<!-- JQuery Mask -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<!-- Funções -->
<script type="text/javascript" src="js/gerenciar-ceps.js"></script>