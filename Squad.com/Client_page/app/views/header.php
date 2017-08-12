<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="/squad.com/client_page/public/">
    <title>Login | E-Shopper</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/font-awesome.min.css" rel="stylesheet">
    <link href="./css/prettyPhoto.css" rel="stylesheet">
    <link href="./css/price-range.css" rel="stylesheet">
    <link href="./css/animate.css" rel="stylesheet">
	<link href="./css/main.css" rel="stylesheet">
	<link href="./css/responsive.css" rel="stylesheet">
	<script src="./js/jquery.js"></script>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="./images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="./images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="./images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="./images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="./images/ico/apple-touch-icon-57-precomposed.png">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head><!--/head-->

<body >
	
	<header id="header"><!--header-->

		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
				</div>
			</div>
		</div><!--/header_top-->	
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="./index"><img src="./images/home/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right" id="userIn" value="<?php echo $_SESSION['user'];?>">
							<ul class="nav navbar-nav">
								<?php
									if (isset($_SESSION['user']))
									{
										echo '<li><a href="account"><i class="fa fa-user"></i> Account</a></li>';
										echo '<li><a href="wishlistPage"><i class="fa fa-star"></i> Wishlist</a></li>';
										echo '<li><a href="orderHistory"><i class="fa fa-history"></i>Order History</a></li>';
									}
									
								?>
								<?php
								 	if (isset($_SESSION['user']))
									{
										echo "<script type=\"text/javascript\">logged_in=true;</script>";
								?>
								<li>
									<a href="contactUs/sendMessage">
										<div class="btn-circle" id = "nmbMessages" style = top:-9px;left:-8px;text-align:center;position:absolute;z-index:50;color:white;font-weight:bold;border-radius:50%;background:red;width:17px;height:17px;" ></div >

										<i class="fa fa-envelope"></i> Inbox
									</a>
								</li>
								<li><a href="cart"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<li><a href="login/logout" class="active"><i class="fa fa-lock"></i>Logout</a></li>
								<?php
									echo '<li>Welcome! <br/>' . $_SESSION['user'] . '</li>';
								}
								else{
									echo "<script type=\"text/javascript\">logged_in=false;</script>";
								?>
								<li><a href="login" class="active"><i class="fa fa-lock"></i> Login/Register</a></li>

								<?php

							}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
		<script>
		console.log($("#nmbMessage").is(":visible"));
		if(logged_in)
		{
			$(document).ready(function(){
				email = $("#userIn").attr('value');
				setInterval(function(){
					$.get('contactUs/getCount/'+email,function (data) {

						$("#nmbMessages").html(data);

					})
				},1000);
			})
		}

		</script>
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="./index">Home</a></li>
								<li><a href="contactUs">Contact</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->