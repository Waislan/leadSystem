<?php
    session_start();

    require_once("php/verificar-login.php");
    require_once("php/importar-acesso.php");

    verificarLogin();
    
    include("header.php");
?>
        
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Histórico de acessos</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Histórico de acessos</h1>
        </div>
    </div>

    <div class="panel panel-container">
        <div class="row">
            <div class="col-xs-6 no-padding">
                <div class="panel panel-teal panel-widget border-right">
                    <div class="row no-padding"><em class="fas fa-check color-blue" style="font-size: 30px;"></em>
                        <div class="large"><?php if ($result = $conexao->query("SELECT * FROM pesquisas WHERE viavel='1';")) {
                                                echo $result->num_rows;
                                            } ?></div>
                        <div class="text-muted">Leads viáveis</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 no-padding">
                <div class="panel panel-blue panel-widget">
                    <div class="row no-padding"><em class="fas fa-times color-red" style="font-size: 30px;"></em>
                        <div class="large"><?php if ($result = $conexao->query("SELECT * FROM pesquisas WHERE viavel='0';")) {
                                                echo $result->num_rows;
                                            } ?></div>
                        <div class="text-muted">Leads não viáveis</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="min-height: 60px; height: auto;">
                    <div class="col-12 col-sm-12 col-md-6">
                        Acessos
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="row" style="display: flex; justify-content: flex-end; margin-right: 5px;">
                            <label for="data" style="font-size: 15px;">Filtre por data</label>

                            <input class="form-control" id="data" name="data" type="date" style="width: 150px; margin-left: 10px; display: inline !important;">

                            <form class="form-row" id="formExport" action="php/exportar-pesquisas.php" method="POST" name="download_excel" enctype="multipart/form-data">
                                <input class="form-control" id="data2" name="data2" type="hidden">
                                <span class="input-group-btn">
                                    <button id="btnSearch" name="btnSearch" class="btn btn-default" type="button" style="margin-left: 3px;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                    <button id="exportar" name="exportar" class="btn btn-default" type="submit"><span class="glyphicon glyphicon-download-alt" aria-hidden="true" value="Exportar"></span></button>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive col-md-12">
                        <table id="example" name="example" class="display table table-striped table-hover">
                            
                        </table>
                    </div>
                </div>
                <div class="panel-footer" style="min-height: 60px; height: auto;">
                    <div class="col-sm-12">
                        <div class="row" style="display: flex; justify-content: flex-end; margin-right: 5px;">
                            <label style="margin-right: 50px;">Importe em CSV</label>
                            <form style="margin-left: 10px;" action="" method="POST" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
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
</div>

<!-- MDB core JavaScript -->
<script type="text/javascript" src="../js/mdb.js"></script>
<script type="text/javascript" src="js/chart.min.js"></script>
<script type="text/javascript" src="js/chart-data.js"></script>
<script type="text/javascript" src="js/easypiechart.js"></script>
<script type="text/javascript" src="js/easypiechart-data.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>

<!-- JQUERY SCRIPTS -->
<script type="script/javascript" src="../js/jquery-3.3.1.min.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- CUSTOM SCRIPTS -->
<script type="script/javascript" src="assets/js/custom.js"></script>

<!-- Arquivos para o dataTables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

<!-- Funções -->
<script type="text/javascript" src="js/index.js"></script>