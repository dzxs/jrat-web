<?php

?>

<html>
<head>
<script src="layout/jquery-1.11.2.js"></script>
<script src="layout/bootstrap.min.js"></script>
<script src="layout/modernizr.js"></script>
<script src="layout/proton.js"></script>

<link rel="stylesheet" href="layout/animate.css">
<link rel="stylesheet" href="layout/bootstrap.css">
<link rel="stylesheet" href="layout/jquery.pnotify.default.css">
<link rel="stylesheet" href="layout/proton.css">
<link rel="stylesheet" href="layout/select2.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<link rel="stylesheet" href="layout/font-titillium.css">

</head>

<body class="dashboard-page">
	<script>
	        var theme = 'theme-light';//var theme = $.cookie('protonTheme') || 'theme-light';
	        $('body').removeClass (function (index, css) {
	            return (css.match (/\btheme-\S+/g) || []).join(' ');
	        });
	        if (theme !== 'default') $('body').addClass(theme);
    </script>
	<!--[if lt IE 8]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

	<nav class="main-menu">
		<ul>
			<li><a href="index.php"> <i class="fa fa-home nav-icon"></i> <span
					class="nav-text"> Index </span>
			</a></li>
			
			<li><a href="bots.php"> <i class="fa fa-table nav-icon"></i> <span
					class="nav-text"> Connections </span>
			</a></li>
		</ul>

		<ul class="logout">
			<li><a href="logout.php"> <i class="fa fa-off nav-icon"></i> <span
					class="nav-text"> Logout </span>
			</a></li>
		</ul>
	</nav>
	
	