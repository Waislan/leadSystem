<?php
    session_start();
    include_once("../conexao.php");

    if (($_SESSION['usuarioId'] == "") ||
        ($_SESSION['usuarioNome'] == "") ||
        ($_SESSION['usuarioLogin'] == "") ||
        ($_SESSION['usuarioSenha'] == "")) {
            header("Location: login.html");
    } else {
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Constanzo - Admin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="../css/mdb.min.css" rel="stylesheet">

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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
                    <!--<img src="../img/Logo.png">-->Constanzo <span> ADMIN</span></a>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                    <?php echo $_SESSION['usuarioNome'] ?>
                </div>
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
                <li><a href="index.php">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Empresas clientes</li>
                <li class="active">
                    <?php if(isset($_POST['apelido'])) {echo "Editar";} else {echo "Novo";} ?> cliente</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <?php if(isset($_POST['apelido'])) {echo "Editar";} else {echo "Novo";} ?> cliente</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form role="form" method="POST" action="actions/<?php if(isset($_POST['apelido'])) {echo 'edita';} else {echo 'insere';} ?>-cliente.php">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="inputApelido">Apelido</label>
                                        <input class="form-control" id="inputApelido" name="inputApelido" type="text" maxlength="8" value="<?php if(isset($_POST['apelido'])) {echo $_POST['apelido'];} ?>" autofocus required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="inputNome">Nome</label>
                                        <input class="form-control" id="inputNome" name="inputNome" type="text" value="<?php if(isset($_POST['nome'])) {echo $_POST['nome'];} ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="inputCnpj">CPF/CNPJ/CEI</label>
                                        <input class="form-control" id="inputCnpj" name="inputCnpj" type="text" value="<?php if(isset($_POST['cnpj'])) {echo $_POST['cnpj'];} ?>" <?php if(isset($_POST['apelido'])) {echo "readonly" ;} else {echo "required" ;} ?>>
                                    </div>
                                </div>
                            </div>

                            <!--
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="inputSenha">Senha</label>
                                        <input class="form-control" id="inputSenha" name="inputSenha" type="password" <?php if(isset($_POST['apelido'])) {echo 'placeholder="Caso queira mudar, insira a nova senha"';} else {echo 'required';} ?>>
                                    </div>
                                </div>
                            </div>
                            -->

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="inputProxCodigo">Próximo código de funcionário</label>
                                        <input class="form-control" id="inputProxCodigo" name="inputProxCodigo" type="number" value="<?php if(isset($_POST['proxCod'])) {echo $_POST['proxCod'];} else {echo '9000';} ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <button class="btn btn-primary" id="submit" type="submit">
                                        <?php if(isset($_POST['apelido'])) {echo "Salvar";} else {echo "Cadastrar";} ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/.row-->

    </div>
    <!--/.main-->

    <!-- JQUERY SCRIPTS -->
    <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../js/mdb.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script type="text/javascript" src="js/novo-usuario.js"></script>

</body>

</html>
<?php
        }

?>
