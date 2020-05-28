<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Leader Admin</title>

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

        <!-- Funções -->
        <script type="text/javascript" src="js/header.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Leader<span> ADMIN</span></a>
                </div>
            </div>
        </nav>
        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="profile-sidebar">
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"><?php echo $_SESSION['nomeColaborador'] ?></div>
                    <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="divider"></div>
            <ul class="nav menu">
                <li id="sidebar_index" class="active"><a href="index.php"><em class="fa fa-eye">&nbsp;</em> Histórico de acessos</a></li>
                <li id="sidebar_colaboradores"><a href="gerenciar-colaboradores.php"><em class="fa fa-users">&nbsp;</em> Gerenciar colaboradores</a></li>
                <li id="sidebar_campos"><a href="gerenciar-campos.php"><em class="fas fa-tasks">&nbsp;</em> Gerenciar campos obrigatórios</a></li>
                <li id="sidebar_redirecionamento"><a href="gerenciar-redirecionamento.php"><em class="fas fa-directions">&nbsp;</em> Gerenciar redirecionamento</a></li>
                <li id="sidebar_ceps"><a href="gerenciar-ceps.php"><em class="fas fa-map-marker-alt">&nbsp;</em> Gerenciar CEP's</a></li>
                <li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
            </ul>
        </div>