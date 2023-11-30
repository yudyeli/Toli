<?php
// Se importa el archivo de conexión a la base de datos
require_once("../../../db/conexion.php");
// Se instancia la clase Database para la conexión a la base de datos
$db = new Database();
$con = $db->conectar();

// Validación de sesión (código comentado)
// require_once "../../auth/validationSession.php";

// Cierre de sesión al presionar 'btncerrar'
if (isset($_POST['btncerrar'])) {
	session_destroy();
	header("Location:../../../../index.html");
}

// Obtiene el documento de la sesión del usuario
$document = $_SESSION['document'];

// Consulta SQL para obtener las últimas 6 entradas de usuarios
$userEntry = $con->prepare("SELECT * FROM ingreso INNER JOIN usuarios INNER JOIN roles ON ingreso.documento = usuarios.documento AND usuarios.id_rol = roles.id_rol WHERE roles.id_rol >= 1 ORDER BY ingreso.id_ingreso DESC LIMIT 10");
$userEntry->execute();
$entry = $userEntry->fetchAll(PDO::FETCH_ASSOC);

// Consulta SQL para obtener la información del usuario logueado
$user = $con->prepare("SELECT * FROM usuarios WHERE documento = '$document'");
$user->execute();
$respuesta = $user->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="robots" content="">
	<meta name="format-detection" content="telephone=no">

	<!-- PAGE TITLE HERE -->
	<title>Admin <?php echo $_SESSION['name'] ?></title>

	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="../../../assets/img/logo.png">

	<link href="../../../../vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
	<link href="../../../../vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link rel="stylesheet" href="../../../../vendor/nouislider/nouislider.min.css">

	<!-- Datatable -->
	<link href="../../../../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
	<!-- Style css -->
	<link href="../../../../css/style.css" rel="stylesheet">
	<!-- FUNCIONES DE JAVASCRIPT PARA REALIZAR LA VALIDACION DE LOS CAMPOS EN CADA UNO DE LOS FORMULARIOS -->
	<script src="../../../assets/js/funciones.js"></script>

</head>

<body class="con" style="font-family: 'Times New Roman', Times, serif;">

	<!--***** Main wrapper start ******-->
	<div id="main-wrapper">

		<!--**** Nav header start *****-->
		<div class="nav-header">
			<a href="./index.php" class="brand-logo">
				<img src="../../../assets/img/logo.png" style="border-radius: 20px; width: 500px;" alt="" class="logo-abbr">
				<div class="brand-title">
					<h2 class="">Bienvenid@</h2>
				</div>
			</a>
			<div class="nav-control">
				<div class="hamburger">
					<span class="line"></span><span class="line"></span><span class="line"></span>
				</div>
			</div>
		</div>
		<!--****** Nav header end *****-->

		<!--********* Header start ********-->
		<div class="header border-bottom">
			<div class="header-content">
				<nav class="navbar navbar-expand">
					<div class="collapse navbar-collapse justify-content-between">
						<div class="header-left">
							<div class="dashboard_bar" style="color:#4E3F6B">
								<a aria-expanded="false">
									<i class="fas fa-user-check"></i>
								</a>
								Administrador <?php echo $respuesta['nombre'] ?>
							</div>
						</div>
						<ul class="navbar-nav header-right">
							<li class="nav-item dropdown notification_dropdown">
								<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
									<svg width="28" height="28" viewbox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M23.3333 19.8333H23.1187C23.2568 19.4597 23.3295 19.065 23.3333 18.6666V12.8333C23.3294 10.7663 22.6402 8.75902 21.3735 7.12565C20.1068 5.49228 18.3343 4.32508 16.3333 3.80679V3.49996C16.3333 2.88112 16.0875 2.28763 15.6499 1.85004C15.2123 1.41246 14.6188 1.16663 14 1.16663C13.3812 1.16663 12.7877 1.41246 12.3501 1.85004C11.9125 2.28763 11.6667 2.88112 11.6667 3.49996V3.80679C9.66574 4.32508 7.89317 5.49228 6.6265 7.12565C5.35983 8.75902 4.67058 10.7663 4.66667 12.8333V18.6666C4.67053 19.065 4.74316 19.4597 4.88133 19.8333H4.66667C4.35725 19.8333 4.0605 19.9562 3.84171 20.175C3.62292 20.3938 3.5 20.6905 3.5 21C3.5 21.3094 3.62292 21.6061 3.84171 21.8249C4.0605 22.0437 4.35725 22.1666 4.66667 22.1666H23.3333C23.6428 22.1666 23.9395 22.0437 24.1583 21.8249C24.3771 21.6061 24.5 21.3094 24.5 21C24.5 20.6905 24.3771 20.3938 24.1583 20.175C23.9395 19.9562 23.6428 19.8333 23.3333 19.8333Z" fill="#717579"></path>
										<path d="M9.9819 24.5C10.3863 25.2088 10.971 25.7981 11.6766 26.2079C12.3823 26.6178 13.1838 26.8337 13.9999 26.8337C14.816 26.8337 15.6175 26.6178 16.3232 26.2079C17.0288 25.7981 17.6135 25.2088 18.0179 24.5H9.9819Z" fill="#717579"></path>
									</svg>

									<?php
									$conteoEntrada = "SELECT COUNT(*) AS conteo FROM ingreso INNER JOIN usuarios ON ingreso.documento = usuarios.documento WHERE usuarios.id_rol >= 1";

									try {
										$conteos = $con->query($conteoEntrada);
										$conteo = $conteos->fetch(PDO::FETCH_ASSOC)['conteo'];

										if ($conteo) {

									?>
											<span class="badge light text-white bg-warning rounded-circle"><?php echo $conteo ?></span>


										<?php
										} else {
										?>
											<span class="badge light text-white bg-warning rounded-circle">0</span>

									<?php

										}
									} catch (PDOException $e) {
										echo '<span class="badge light text-white bg-warning rounded-circle"> ' . $e->getMessage();
									}

									?>


								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<div id="DZ_W_Notification1" class="widget-media dlab-scroll p-3" style="height:380px;">
										<ul class="timeline">


											<?php if (!empty($entry)) {
												foreach ($entry as $entrada) { ?>
													<li>
														<div class="timeline-panel">
															<div class="media me-2">
																<img alt="image" width="50" src="../../../assets/img/img_user/<?= $entrada["foto"] ?>">
															</div>
															<div class="media-body">
																<h6 class="mb-1"><?= $entrada['nombre'] ?></h6>
																<small class="d-block"><?= $entrada['fecha_ingre'] ?></small>
															</div>
														</div>
													</li>

												<?php

												}
											} else {

												?>
												<li>
													<div class="timeline-panel">

														<div class="media-body">
															<h6 class="mb-1">No hay ingreso de usuarios</h6>

														</div>
													</div>
												</li>

											<?php
											}
											?>


										</ul>
									</div>
									<a class="all-notification" href="./index-admin.php">Ver todas<i class="ti-arrow-end"></i></a>
								</div>
							</li>

							<li class="nav-item dropdown  header-profile">
								<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
									<img src="../../../assets/img/img_user/profile-img.jpg" width="100" alt="">
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<div class="dropdown-item ai-icon row">
										<svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
											<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
											<polyline points="16 17 21 12 16 7"></polyline>
											<line x1="21" y1="12" x2="9" y2="12"></line>
										</svg>

										<form method="POST" action="">
											<span class="ms-2">
												<input type="submit" value="Cerrar sesion" id="btn_quote" name="btncerrar" class="ms-2 btn-logout" />
											</span>
										</form>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
		<!--**********************************
            Header end ti-comment-alt
        ***********************************-->

		<!--**********************************
            Sidebar start
        ***********************************-->
		<div class="dlabnav">
			<div class="dlabnav-scroll">
				<ul class="metismenu" id="menu">
					<li>
						<a class="has-arrow " href="./index-admin.php" aria-expanded="false">
							<i class="fas fa-home"></i>
							<span class="nav-text">HOME</span>
						</a>

					</li>

					<!-- MODULO USUARIOS -->
					<li>
						<a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-user-check"></i>
							<span class="nav-text">USUARIOS</span>
						</a>
						<ul aria-expanded="false">
							<!-- MODULO PARA ENLISTAR O CREAR UN ADMINISTRADOR -->
							<li><a href="./usuarios/index.php">Listar Usuarios</a></li>
							<li><a href="./usuarios/crear.php">Crear Usuarios</a></li>
						</ul>
					</li>

					<!-- MODULO DE CATEGORIAS -->
					<li>
						<a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-folder"></i>
							<span class="nav-text">CATEGORIAS</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="./categoria/index.php">Lista Categorias</a></li>
							<li><a href="./categoria/crear.php">crear Categorias</a></li>
						</ul>
					</li>

					<!-- MODULO DE DOCUMENTOS -->
					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-file"></i>
							<span class="nav-text">DOCUMENTOS</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="./documentos/index.php">Lista Documentos</a></li>
							<li><a href="./documentos/crear.php">crear Documentos</a></li>
						</ul>
					</li>

					<!-- MODULO DE EMBALAJE -->
					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-box"></i>
							<span class="nav-text">EMBALAJE</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="./embalaje/index.php">Listar Embalaje</a></li>
							<li><a href="./embalaje/crear.php">crear Embalaje</a></li>
						</ul>
					</li>

					<!-- MODULO DE GENEROS -->
					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-venus-mars"></i>
							<span class="nav-text">GENEROS</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="./genero/index.php">Listar Generos</a></li>
							<li><a href="./genero/crear.php">crear Generos</a></li>
						</ul>
					</li>

					<!-- MODULO DE PRODUCTOS -->
					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-shopping-bag"></i>
							<span class="nav-text">PRODUCTOS</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="./producto/producto.php">Listar Productos</a></li>
							<li><a href="./producto/crear.php">crear Productos</a></li>
						</ul>
					</li>

					<!-- MODULO DE ROLES -->
					<li>
						<a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-users-cog"></i>
							<span class="nav-text">ROLES</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="./roles/index.php">Listar Roles</a></li>
							<li><a href="./roles/crear.php">crear Roles</a></li>
						</ul>
					</li>

					<!-- MODULO DE ESTADISTICAS -->
					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-chart-line"></i>
							<span class="nav-text">ESTADISTICAS</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="index.html">Partidas</a></li>
							<li><a href="index.html">Usuarios Bloqueados</a></li>
						</ul>

					</li>
				</ul>

				<!-- FOOTER -->
				<div class="copyright">
					<p><strong>Toli-Camp © 2023 Todos los derechos reservados</p>
					<p class="fs-12">Hecho por<span class="heart"></span> Aprendices SENA</p>
				</div>
				<!-- FOOTER END -->
			</div>
		</div>
		<!--**********************************
            Sidebar end
        ***********************************-->


	</div>
	<!--**********************************
        Main wrapper end
    ***********************************-->

	<!--**********************************
        Scripts
    ***********************************-->
	<!-- Required vendors -->
	<script src="../../../../vendor/global/global.min.js"></script>
	<script src="../../../../vendor/chart.js/Chart.bundle.min.js"></script>
	<script src="../../../../vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

	<!-- Apex Chart -->
	<script src="../../../../vendor/apexchart/apexchart.js"></script>

	<script src="../../../../vendor/chart.js/Chart.bundle.min.js"></script>

	<!-- Chart piety plugin files -->
	<script src="../../../../vendor/peity/jquery.peity.min.js"></script>
	<!-- Dashboard 1 -->
	<script src="../../../../js/dashboard/dashboard-1.js"></script>

	<script src="../../../../vendor/owl-carousel/owl.carousel.js"></script>

	<script src="../../../../js/custom.min.js"></script>
	<script src="../../../../js/dlabnav-init.js"></script>
	<script src="../../../../js/demo.js"></script>
	<script src="../../../../js/styleSwitcher.js"></script>
	<script>
		function cardsCenter() {

			/*  testimonial one function by = owl.carousel.js */
			jQuery('.card-slider').owlCarousel({
				loop: true,
				margin: 0,
				nav: true,
				//center:true,
				slideSpeed: 3000,
				paginationSpeed: 3000,
				dots: true,
				navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
				responsive: {
					0: {
						items: 1
					},
					576: {
						items: 1
					},
					800: {
						items: 1
					},
					991: {
						items: 1
					},
					1200: {
						items: 1
					},
					1600: {
						items: 1
					}
				}
			})
		}

		jQuery(window).on('load', function() {
			setTimeout(function() {
				cardsCenter();
			}, 1000);
		});

		// se cambia el color de la interfaz
		jQuery(document).ready(function() {
			setTimeout(function() {
				dlabSettingsOptions.version = 'white';
				new dlabSettings(dlabSettingsOptions);
			}, 1500)
		});
	</script>

</body>

</html>