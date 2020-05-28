<?php
    session_start();

    require_once("../conexao.php");
    require_once("php/verificar-login.php");

    verificarLogin();

    include("header.php");
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Gerenciar colaboradores</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Colaboradores cadastrados</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="min-height: 60px; height: auto;">
                    <div class="col-12 col-sm-12 col-md-6">
                        Lista de colaboradores
                    </div>
                    <div class="col-md-6">
                        <div class="row" style="display: flex; justify-content: flex-end; margin-right: 5px;">
                            <a class="btn btn-default waves-effect waves-light" type="button" title="Cadastrar usuário" id="btnCadastrar"><i class="fas fa-user-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive col-md-12">
                        <table id="example" name="example" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="col-lg-1">ID</th>
                                    <th class="col-lg-2">Nome</th>
                                    <th class="col-lg-2">CPF</th>
                                    <th class="col-lg-2">Login</th>
                                    <th class="col-lg-4">Email</th>
                                    <th class="col-lg-3">Permissões</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $conexao->query("SELECT * FROM colaboradores;");
                                while ($linha = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td class="col-lg-1">' . $linha['id_colaborador'] . '</td> ';
                                    echo '<td class="col-lg-2">' . $linha['nome_colaborador'] . '</td> ';
                                    echo '<td class="col-lg-2">' . $linha['cpf_colaborador'] . '</td> ';
                                    echo '<td class="col-lg-2">' . $linha['username_colaborador'] . '</td>';
                                    echo '<td class="col-lg-4">' . $linha['email_colaborador'] . '</td>';
                                    if ($linha['permissoes_admin'] == 'true') {
                                        echo '<td class="col-lg-3">Administrador</td>';
                                    } else {
                                        echo '<td class="col-lg-3">Usuário comum</td>';
                                    }
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
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

<!-- JQuery scripts -->
<script type="script/javascript" src="../js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap scripts -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- Custom scripts -->
<script type="script/javascript" src="assets/js/custom.js"></script>

<!-- Arquivos para o dataTables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

<!-- Funções -->
<script type="text/javascript" src="js/gerenciar-colaboradores.js"></script>