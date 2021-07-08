<?php

	include 'connect.php';
	// Routes

	$tpl 	= 'includes/templates/'; // Template Directory
	 $func	= 'includes/functions/'; // Functions Directory
	
	$js 	= 'layout/js/'; // Js Directory
$css 	= 'layout/css/'; // Css Directory
	// Include The Important Files

	 include $func . 'functions.php';
	include $tpl . 'header.php';

	 
	// Include Navbar On All Pages Expect The One With $noNavbar Vairable

	if (isset($Navbar)) { include $tpl . 'navbar.php'; }else if (isset($NoNavbar)) { include $tpl . 'navbar1.php'; }
	if (isset($main)) { include $tpl . 'main.php'; }else if (isset($NoMain)) { include $tpl . 'main1.php'; }
	
	 
	