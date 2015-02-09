<?php

?>

<html>
<head>
<link rel="stylesheet" href="styles/bootstrap.css">

<link rel="stylesheet" href="styles/vendor/jquery.pnotify.default.css">
<link rel="stylesheet" href="styles/vendor/select2/select2.css">

<link rel="stylesheet" href="styles/proton.css">
<link rel="stylesheet" href="styles/vendor/animate.css">

<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
	<script src="scripts/vendor/respond.min.js"></script>
<![endif]-->

<link rel="stylesheet" href="styles/font-awesome.css" type="text/css" />
<link rel="stylesheet" href="styles/font-titillium.css" type="text/css" />

<style>
.panel {
  border-radius: 0 !important;
}
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="scripts/vendor/modernizr.js"></script>
<script src="scripts/vendor/jquery.cookie.js"></script>

</head>

<body class="dashboard-page">
	<script>
	        var theme = 'theme-light';//var theme = $.cookie('protonTheme') || 'theme-light';
	        $('body').removeClass (function (index, css) {
	            return (css.match (/\btheme-\S+/g) || []).join(' ');
	        });
	        if (theme !== 'default') $('body').addClass(theme);
    </script>

	<nav class="main-menu">
		<ul>
			<li><a href="index.php"> <i class="icon-home nav-icon"></i> <span
					class="nav-text"> Index </span>
			</a></li>

			<li><a href="clients.php"> <i class="icon-table nav-icon"></i> <span
					class="nav-text"> Connections </span>
			</a></li>

			<li><a href="search.php"> <i class="icon-search nav-icon"></i> <span
					class="nav-text"> Search </span>
			</a></li>
		</ul>

		<ul class="logout">
			<li><a href="logout.php"> <i class="icon-off nav-icon"></i> <span
					class="nav-text"> Logout </span>
			</a></li>
		</ul>
	</nav>