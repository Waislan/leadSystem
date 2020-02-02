<?php
    session_start();

    if (($_SESSION['adminId'] == "") ||
        ($_SESSION['adminNome'] == "") ||
        ($_SESSION['adminEmail'] == "") ||
        ($_SESSION['adminSenha'] == "")) {
            header("Location: login.php"); 
    } else {
        include_once("../conexao.php");

        $query = "SELECT * FROM redirecionamento;";

        if ($result = $conexao->query($query)) {
            $resultado = $result->fetch_assoc();

            if (!empty($resultado)) {
                $_SESSION['urlRedirecionamento'] = $resultado["url"];
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
    <link href="css/styles.css" rel="stylesheet">
    <link href="../css/mdb.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    
    <!-- JQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    
    <!-- Funções -->
    <script type="text/javascript" src="js/gerenciar-redirecionamento.js"></script>

    <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                <a class="navbar-brand" href="#">
                    <!--<img src="../img/Logo.png">-->Leader <span> ADMIN</span></a>
            </div>
        </div><!-- /.container-fluid -->
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
            <li><a href="gerenciar-campos.php"><em class="fa fa-users">&nbsp;</em> Gerenciar campos obrigatórios</a></li>
            <li class="active"><a href="gerenciar-redirecionamento.php"><em class="fa fa-users-cog">&nbsp;</em> Gerenciar redirecionamento</a></li>
            <li><a href="gerenciar-ceps.php"><em class="fa fa-users-cog">&nbsp;</em> Gerenciar CEP's</a></li>
            <li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul>
    </div>
    <!--/.sidebar-->

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="index.php">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Gerenciar redirecionamento</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Redirecionamento</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="min-height: 60px; height: auto;">
                        <div>Atualize o link</div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="input-group">
                                <div class="form-row">
                                    <span class="input-group-btn">
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="inputRedirecionamento" id="inputRedirecionamento" value="<?php if(isset($_SESSION["urlRedirecionamento"])){echo $_SESSION["urlRedirecionamento"];}?>">
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
        <!--/.row-->

    </div>
    <!--/.main-->

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../js/mdb.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="js/bootstrap.min.js"></script>
    
    

</body>

</html>
<?php
        }

?>
