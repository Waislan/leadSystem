<?php
    session_start();

    require_once("php/verificar-login.php");
    include_once("php/get-url-redirecionamento.php");

    verificarLogin();
    getUrlRedirecionamento();

    include("header.php");
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Gerenciar redirecionamento</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Redirecionamento</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="min-height: 60px; height: auto;">
                    <div>Atualize o link</div>
                    <small>Insira o endereço sem 'https://'. Por exemplo: 'www.nomedosite.com.br'.</small>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="input-group">
                            <div class="form-row">
                                <span class="input-group-btn">
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="inputRedirecionamento" id="inputRedirecionamento" value="<?php if (isset($_SESSION["urlRedirecionamento"])) {echo $_SESSION["urlRedirecionamento"];} ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <button id="btnAtualizar" name="btnAtualizar" class="btn btn-default" type="button">Atualizar</button>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MDB core JavaScript -->
<script type="text/javascript" src="../js/mdb.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="js/bootstrap.min.js"></script>

<!-- Funções -->
<script type="text/javascript" src="js/gerenciar-redirecionamento.js"></script>