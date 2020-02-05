<?php
    session_start();
    include_once("../conexao.php");

    if (!isset($_SESSION['adminId']) ||
        !isset($_SESSION['adminNome']) ||
        !isset($_SESSION['adminEmail']) ||
        !isset($_SESSION['adminSenha']) ||
        !isset($_SESSION['adminLogin']) ||
        !isset($_SESSION['adminMaster'])) {
            header("Location: login.php"); 
    } else {
        
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
            <li><a href="index.php"><em class="fa fa-eye">&nbsp;</em> Histórico de acessos</a></li>
            <li class="active"><a href="gerenciar-administradores.php"><em class="fa fa-users">&nbsp;</em> Gerenciar administradores</a></li>
            <li><a href="gerenciar-campos.php"><em class="fa fa-users">&nbsp;</em> Gerenciar campos obrigatórios</a></li>
            <li><a href="gerenciar-redirecionamento.php"><em class="fa fa-users-cog">&nbsp;</em> Gerenciar redirecionamento</a></li>
            <li><a href="gerenciar-ceps.php"><em class="fa fa-users-cog">&nbsp;</em> Gerenciar CEP's</a></li>
            <li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul>
    </div>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="index.php">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Gerenciar usuários</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Usuários cadastrados</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="min-height: 60px; height: auto;">
                        <div class="col-12 col-sm-12 col-md-6">
                            Lista de usuários
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive col-md-12">
                            <table id="example" name="example" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-lg-1">ID</th>
                                        <th class="col-lg-2">Nome</th>
                                        <th class="col-lg-2">Login</th>
                                        <th class="col-lg-4">Email</th>
                                        <th class="col-lg-3">Tipo de usuário</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $result = $conexao->query("SELECT * FROM admin;");
                                        while ($linha = $result->fetch_assoc()) {
                                            echo '<tr>';
                                            echo '<td class="col-lg-1">'.$linha['id_admin'].'</td> ';
                                            echo '<td class="col-lg-2">'.$linha['nome_admin'].'</td> ';
                                            echo '<td class="col-lg-2">'.$linha['login_admin'].'</td>';
                                            echo '<td class="col-lg-4">'.$linha['email_admin'].'</td>';
                                            if ($linha['master_admin'] == 'true'){
                                                echo '<td class="col-lg-3">Master</td>';
                                            } else {
                                                echo '<td class="col-lg-3">Comum</td>';
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
    <script type="text/javascript" src="js/index.js"></script>

</body>

</html>
<?php
        }

?>
