<?php
    session_start();
    include_once("../conexao.php");

    if (($_SESSION['usuarioId'] == "") ||
        ($_SESSION['usuarioNome'] == "") ||
        ($_SESSION['usuarioLogin'] == "") ||
        ($_SESSION['usuarioSenha'] == "")) {
            header("Location: login.html");
    } else {
        
        $cnpj = $_POST['cnpj'];
        $query = "SELECT * FROM clientes WHERE cnpj_clientes='" . $cnpj . "'";
        
        if ($result = $conexao->query($query)) {
        $resultado = $result->fetch_assoc();
        
        if (!empty($resultado)) {
            $apelido = $resultado["apelido"];
            $nome = $resultado["nome_clientes"];
        }
    }
    /* close connection */
    $conexao->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="../css/mdb.min.css" rel="stylesheet">

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    
    <title>Constanzo - Admin</title>
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
                    <!--<img src="../img/Logo.png">-->Constanzo <span> ADMIN</span></a>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-usertitle">
                <div class="profile-usertitle-name"><?php echo $_SESSION['usuarioNome'] ?></div>
                <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>
        <ul class="nav menu">
            <li><a href="index.php"><em class="fa fa-eye">&nbsp;</em> Formulários</a></li>
            <li class="active"><a href="gerenciar-clientes.php"><em class="fa fa-users">&nbsp;</em> Gerenciar clientes</a></li>
            <li><a href="gerenciar-usuarios.php"><em class="fa fa-users-cog">&nbsp;</em> Gerenciar usuários</a></li>
            <li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul>
    </div>
    <!--/.sidebar-->

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="index.php"><em class="fa fa-home"></em></a></li>
                <li class="active"><a href="gerenciar-clientes.php" style="color: inherit;">Empresas clientes</a></li>
                <li class="active"><?php echo $nome; ?></li>
                <li class="active">Editar</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Editar empresa cliente</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-6">
                                <form method="POST" action="actions/action-editar-cliente.php">
                                    <div class="form-group">
                                        <label for="inputApelido">Apelido</label>
                                        <input type="text" class="form-control" name="inputApelido" id="inputApelido" value="<?php echo $apelido; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputNome">Nome</label>
                                        <input type="text" class="form-control" name="inputNome" id="inputNome" value="<?php echo $nome; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputCnpj">CNPJ</label>
                                        <input type="text" class="form-control" name="inputCnpj" id="inputCnpj" value="<?php echo $cnpj; ?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-light" onclick="location.href = 'gerenciar-clientes.php';">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Confirmar</button>
                                    </div>
                                </form>
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
    <!-- JQUERY SCRIPTS -->
    <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script type="text/javascript" src="js/custom.js"></script>

</body>

</html>
<?php
        }

?>
