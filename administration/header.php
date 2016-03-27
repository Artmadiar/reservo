<? include_once "entry.php"; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Reservo.me</title>
	<meta name="description" content="Reservo.me - система онлайн-бронирования в ресторанах и кафе">
	<meta name="author" content="Sketch studio">
	<meta name="keyword" content="Reservo, reservation, reserve, restaurant, cafe">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="<? echo $rel_path; ?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<? echo $rel_path; ?>css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="<? echo $rel_path; ?>css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="<? echo $rel_path; ?>css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>

	<link id="style_admin" href="<? echo $rel_path; ?>css/style_admin.css" rel="stylesheet">

	<!-- MY CSS -->
	<link id="form" href="<? echo $rel_path; ?>css/form.css" rel="stylesheet">
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="<? echo $host;?>/css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="<? echo $host;?>/css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="../img/favicon.ico">
	<!-- end: Favicon -->
	
		
		
		
</head>

<body>
		<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="brand" href=""><span>Reservo</span></a>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
						<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="white icon-question-sign"></i>
							</a>
						</li>	
						<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="white icon-comments"></i>
							</a>
						</li>	
						<li>
							<a class="btn" href="#">
								<i class="halflings-icon white wrench"></i>
							</a>
						</li>
						<!-- start: User Dropdown -->
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> Dennis Ji
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" style="border-bottom:none;">
								<li><a href="#"><i class="halflings-icon user"></i> Profile</a></li>
								<li><a href="login.html"><i class="halflings-icon off"></i> Logout</a></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li><a href="<? echo $rel_path."administration/" ?>"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Монитор</span></a></li>
						<li><a href="messages.html"><i class="icon-envelope"></i><span class="hidden-tablet"> Брони</span></a></li>
						<li><a href="tasks.html"><i class="icon-tasks"></i><span class="hidden-tablet"> Клиенты</span></a></li>
						<li><a href="ui.html"><i class="icon-eye-open"></i><span class="hidden-tablet"> Аналитика</span></a></li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Настройки</span></a>
							<ul>
								<li><a class="submenu" href="<? echo $rel_path."administration/points" ?>"><i class="icon-file-alt"></i><span class="hidden-tablet"> Заведения</span></a></li>
								<li><a class="submenu" href="submenu2.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Пользователи</span></a></li>
								<li><a class="submenu" href="submenu3.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Журнал действий</span></a></li>
							</ul>	
						</li>
					</ul>
				</div>
			</div>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Внимание!</h4>
					<p>Вам необходимо разрешить использование <a href="http://ru.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript-скриптов</a> на этом сайте!</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="<? echo $rel_path."administration/" ?>">Главная</a>
					<i class="icon-angle-right"></i>
				</li>
				<?
					//$location = explode('/',$_SERVER['SCRIPT_NAME']);
					$location = $_SERVER['SCRIPT_NAME'];
				?>
				<li><a href="#"><? echo $location; ?></a></li>
			</ul>