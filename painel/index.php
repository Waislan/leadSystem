<?php
session_start();
include_once("../conexao.php");

if (
    !isset($_SESSION['adminId']) ||
    !isset($_SESSION['adminNome']) ||
    !isset($_SESSION['adminEmail']) ||
    !isset($_SESSION['adminSenha']) ||
    !isset($_SESSION['adminLogin']) ||
    !isset($_SESSION['adminMaster'])
) {
    header("Location: login.php");
} else {
    include_once("../conexao.php");

    $conn = mysqli_connect("localhost", "root", "", "leadsystem_db");

    if (isset($_POST["import"])) {

        $fileName = $_FILES["file"]["tmp_name"];
        $data = date("Y-m-d");

        if ($_FILES["file"]["size"] > 0) {

            $file = fopen($fileName, "r");

            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                $sqlInsert = "INSERT INTO pesquisas (nome_usuario, email_usuario, telefone_usuario, cep, endereco, numero, bairro, cidade, data, viavel)
                        VALUES ('" . $column[0] . "', '" . $column[1] . "', '" . $column[2] . "', '" . $column[3] . "', '" . $column[4] . "',
                        '" . $column[5] . "', '" . $column[6] . "', '" . $column[7] . "', '" . $data . "', '" . $column[8] . "');";
                $result = mysqli_query($conn, $sqlInsert);

                if (!empty($result)) {
                    $type = "success";
                    $_SESSION['sucesso'] = "CSV Data Imported into the Database";
                } else {
                    $type = "error";
                    $_session['erro'] = "Problem in Importing CSV Data";
                }
            }
        }
    }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Leader - Admin</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
        <link href="css/datepicker3.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">

        <!-- Custom Font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Arquivos para o dataTables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

        <!-- JQuery -->
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>

    </head>

    <body>
        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span></button>
                    <a class="navbar-brand" href="#">Leader<span> ADMIN</span></a>
                </div>
            </div>
        </nav>
        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="profile-sidebar">
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"><?php echo $_SESSION['adminNome'] ?></div>
                    <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="divider"></div>
            <ul class="nav menu">
                <li class="active"><a href="index.php"><em class="fa fa-eye">&nbsp;</em> Histórico de acessos</a></li>
                <li><a href="gerenciar-administradores.php"><em class="fa fa-users">&nbsp;</em> Gerenciar administradores</a></li>
                <li><a href="gerenciar-campos.php"><em class="fas fa-tasks">&nbsp;</em> Gerenciar campos obrigatórios</a></li>
                <li><a href="gerenciar-redirecionamento.php"><em class="fas fa-directions">&nbsp;</em> Gerenciar redirecionamento</a></li>
                <li><a href="gerenciar-ceps.php"><em class="fas fa-map-marker-alt">&nbsp;</em> Gerenciar CEP's</a></li>
                <li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
            </ul>
        </div>

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
                                    <thead>
                                        <tr>
                                            <th class="">ID</th>
                                            <th class="col-lg-2">Nome do usuário</th>
                                            <th class="">Email</th>
                                            <th class="">Telefone</th>
                                            <th class="">Endereco</th>
                                            <th class="">Numero</th>
                                            <th class="">Bairro</th>
                                            <th class="">Cidade</th>
                                            <th class="">CEP</th>
                                            <th class="col-lg-2">Data de Acesso</th>
                                            <th class="col-lg-2">Lead Viável</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $result = $conexao->query("SELECT * FROM pesquisas;");
                                        while ($linha = $result->fetch_assoc()) {
                                            echo '<tr>';
                                            echo '<td class="">' . $linha['id_pesquisa'] . '</td> ';
                                            echo '<td class="col-lg-2">' . $linha['nome_usuario'] . '</td> ';
                                            echo '<td class="">' . $linha['email_usuario'] . '</td> ';
                                            echo '<td class="col-lg-2">' . $linha['telefone_usuario'] . '</td> ';
                                            echo '<td class="col-lg-2">' . $linha['endereco'] . '</td> ';
                                            echo '<td class="">' . $linha['numero'] . '</td>';
                                            echo '<td class="col-lg-2">' . $linha['bairro'] . '</td>';
                                            echo '<td class="col-lg-2">' . $linha['cidade'] . '</td>';
                                            echo '<td class="">' .substr($linha['cep'], 0, 5). '-' .substr($linha['cep'], 5, 8). '</td>';
                                            echo '<td class="col-lg-2">' . $linha['data'] . '</td>';
                                            if ($linha['viavel']) {
                                                echo '<td class="">Sim</td>';
                                            } else {
                                                echo '<td class="">Não</td>';
                                            }
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
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
    </body>

    </html>
<?php
}

?>