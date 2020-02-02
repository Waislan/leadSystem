<?php
    session_start();

    if (($_SESSION['adminId'] == "") ||
        ($_SESSION['adminNome'] == "") ||
        ($_SESSION['adminEmail'] == "") ||
        ($_SESSION['adminSenha'] == "")) {
            header("Location: login.php"); 
    } else {
        include_once("../conexao.php");

        $query = "SELECT * FROM campos_obrigatorios WHERE id_registro=1;";

        if ($result = $conexao->query($query)) {
            $resultado = $result->fetch_assoc();

            if (empty($resultado)) {
                $_SESSION['erro'] = "Ocorreu um erro inesperado! Favor contatar o administrador.(1)";

            } else {
                $_SESSION['selectNome'] = $resultado["campo_nome"];
                $_SESSION['selectEmail'] = $resultado["campo_email"];
                $_SESSION['selectTelefone'] = $resultado["campo_telefone"];
                $_SESSION['selectCep'] = $resultado["campo_cep"];
                $_SESSION['selectEndereco'] = $resultado["campo_endereco"];
                $_SESSION['selectNumero'] = $resultado["campo_numero"];
                $_SESSION['selectBairro'] = $resultado["campo_bairro"];
                $_SESSION['selectCidade'] = $resultado["campo_cidade"];            
            }
        }
        $conexao->close();
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

    <!-- Arquivos para o dataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

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
            <li class="active"><a href="gerenciar-campos.php"><em class="fa fa-users">&nbsp;</em> Gerenciar campos obrigatórios</a></li>
            <li><a href="gerenciar-redirecionamento.php"><em class="fa fa-users-cog">&nbsp;</em> Gerenciar redirecionamento</a></li>
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
                <li class="active">Gerenciar campos</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Campos</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <form name="formCampos" method="POST" class="form-signin" action="php/atualizar-campos.php">
                        <div class="panel-heading" style="min-height: 60px; height: auto;">
                            <div class="col-sm-12 col-md-6">
                                Obrigatoriedade de preenchimento dos campos
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive col-md-12">
                                <table id="dataTable" name="dataTable" class="display table table-striped table-hover" >
                                    <thead style="display: flex;">
                                        <tr>
                                            <th class="col-lg-6">Campo / Obrigatoriedade</th>
                                        </tr>
                                    </thead>
                                    <tbody style="display: flex;">
                                        <tr>
                                            <td>Nome</td>
                                            <td>
                                                <select class="custom-select" name="selectNome" id="selectNome">
                                                    <option value="1">Obrigatório</option>
                                                    <option value="0">Opcional</option>
                                                </select>
                                                <?php if(isset($_SESSION['selectNome'])) {
                                                echo '<script type="text/javascript">
                                                        $("[name=selectNome]").val("'.$_SESSION["selectNome"].'");
                                                      </script>';
                                            } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>
                                                <select class="custom-select" name="selectEmail" id="selectEmail">
                                                    <option value="1">Obrigatório</option>
                                                    <option value="0">Opcional</option>
                                                </select>
                                                <?php if(isset($_SESSION['selectEmail'])) {
                                                echo '<script type="text/javascript">
                                                        $("[name=selectEmail]").val("'.$_SESSION["selectEmail"].'");
                                                      </script>';
                                            } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Telefone</td>
                                            <td>
                                                <select class="custom-select" name="selectTelefone" id="selectTelefone">
                                                    <option value="1">Obrigatório</option>
                                                    <option value="0">Opcional</option>
                                                </select>
                                                <?php if(isset($_SESSION['selectTelefone'])) {
                                                echo '<script type="text/javascript">
                                                        $("[name=selectTelefone]").val("'.$_SESSION["selectTelefone"].'");
                                                      </script>';
                                            } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>CEP</td>
                                            <td>
                                                <select class="custom-select" name="selectCep" id="selectCep">
                                                    <option value="1">Obrigatório</option>
                                                    <option value="0">Opcional</option>
                                                </select>
                                                <?php if(isset($_SESSION['selectCep'])) {
                                                echo '<script type="text/javascript">
                                                        $("[name=selectCep]").val("'.$_SESSION["selectCep"].'");
                                                      </script>';
                                            } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Endereço</td>
                                            <td>
                                                <select class="custom-select" name="selectEndereco" id="selectEndereco">
                                                    <option value="1">Obrigatório</option>
                                                    <option value="0">Opcional</option>
                                                </select>
                                                <?php if(isset($_SESSION['selectEndereco'])) {
                                                echo '<script type="text/javascript">
                                                        $("[name=selectEndereco]").val("'.$_SESSION["selectEndereco"].'");
                                                      </script>';
                                            } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Número</td>
                                            <td>
                                                <select class="custom-select" name="selectNumero" id="selectNumero">
                                                    <option value="1">Obrigatório</option>
                                                    <option value="0">Opcional</option>
                                                </select>
                                                <?php if(isset($_SESSION['selectNumero'])) {
                                                echo '<script type="text/javascript">
                                                        $("[name=selectNumero]").val("'.$_SESSION["selectNumero"].'");
                                                      </script>';
                                            } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bairro</td>
                                            <td>
                                                <select class="custom-select" name="selectBairro" id="selectBairro">
                                                    <option value="1">Obrigatório</option>
                                                    <option value="0">Opcional</option>
                                                </select>
                                                <?php if(isset($_SESSION['selectBairro'])) {
                                                echo '<script type="text/javascript">
                                                        $("[name=selectBairro]").val("'.$_SESSION["selectBairro"].'");
                                                      </script>';
                                            } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cidade</td>
                                            <td>
                                                <select class="custom-select" name="selectCidade" id="selectCidade">
                                                    <option value="1">Obrigatório</option>
                                                    <option value="0">Opcional</option>
                                                </select>
                                                <?php if(isset($_SESSION['selectCidade'])) {
                                                echo '<script type="text/javascript">
                                                        $("[name=selectCidade]").val("'.$_SESSION["selectCidade"].'");
                                                      </script>';
                                            } ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="panel-footer" style="min-height: 60px; height: auto;">
                                <div class="col-md-12" style="display: flex; justify-content: center;">
                                    <button id="submit" class="btn btn-deafult" type="submit">Atualizar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!--/.row-->

    </div>
    <!--/.main-->

    <!-- JQUERY SCRIPTS -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../js/mdb.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Arquivos para o dataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

</body>

</html>
<?php
        }

?>
