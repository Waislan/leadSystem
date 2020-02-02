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

	<script src="../js/bootstrapValidator.min.js"></script>

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
				<a class="navbar-brand" href="#"><!--<img src="../img/Logo.png">-->Constanzo <span> ADMIN</span></a>
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
			<li class="active" ><a href="index.php"><em class="fa fa-eye">&nbsp;</em> Formulários</a></li>
			<li><a href="gerenciar-clientes.php"><em class="fa fa-users">&nbsp;</em> Gerenciar clientes</a></li>
			<li ><a href="gerenciar-usuarios.php"><em class="fa fa-users-cog">&nbsp;</em> Gerenciar usuários</a></li>
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->

	<?php
		$cnpj = $_GET['cnpj'];
		$nomeEmpresa = "";
		$query = "SELECT nome_clientes FROM clientes WHERE cnpj_clientes='" . $cnpj . "'";
		if ($result = $conexao->query($query)) {
			$resultado = $result->fetch_assoc();
			$nomeEmpresa = $resultado["nome_clientes"];
		}
	?>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php"><em class="fa fa-home"></em></a></li>
				<li class="active"><a href="index.php" style="color: inherit;">Formulários</a></li>
				<li class="active"><?php echo $nomeEmpresa;?></li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Formulários</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading" style="min-height: 60px; height: auto;">
						<div class="col-sm-12 col-md-6">
							<?php echo $nomeEmpresa;?>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Procurar por nome...">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button" style="margin-top: 0;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
								</span>
						    </div>
						</div>
					</div>
					<div class="panel-body">
						<div class="row">

							<?php
								$query = "SELECT id_fichaAdmissao, nomeCompleto, cpf, dataInicio FROM ficha_admissao WHERE cnpj='" . $cnpj . "'";

	                            if ($result = $conexao->query($query)) {
	                            	echo '<table class="table table-striped table-hover">
			                        		<thead class="thead-dark">
			                                    <tr>
			                                        <th scope="col">Nome</th>
			                                        <th scope="col">CPF</th>
			                                        <th scope="col">Data de início</th>
			                                        <th scope="col" style="text-align: center !important;">Ações</th>
			                                    </tr>
			                                </thead>
			                            	<tbody class="labeltexto">';
			                        while ($linha = $result->fetch_assoc()) {
										echo '<tr>';
	                                    echo '<td>'.$linha['nomeCompleto'].'</td> ';
	                                    echo '<td>'.$linha['cpf'].'</td>';
	                                    echo '<td>'.$linha['dataInicio'].'</td>';
	                                    echo '<td style="text-align: center !important;">
                                                <a href="visualizar.php?id='.$linha['id_fichaAdmissao'].'&cnpj='.$cnpj.'"><i class="fas fa-eye"></i></a>
	                                    		<a href="editar.php?id='.$linha['id_fichaAdmissao'].'&cnpj='.$cnpj.'"><i class="fas fa-edit"></i></a>
	                                    		<i class="fas fa-trash"></i>
	                                    	 </td>';
	                                    echo '</tr>';
	                                }
	                                echo '
	                                </tbody>
	                                </table>';
			                   	}
			                ?>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->

	</div>	<!--/.main-->

	<!-- MDB core JavaScript -->
    <script type="text/javascript" src="../js/mdb.js"></script>
	<!-- JQUERY SCRIPTS -->
    <script src="js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="js/bootstrap.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="js/custom.js"></script>

</body>
</html>
<?php
        }

?>
