<html>
 <head>
   <title>Internet Banking</title>
   <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
	<script src="<?php echo base_url('jquery-3.0.0.min');?>"></script>
	<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
	<script language="JavaScript" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="<? echo base_url('styles.css');?>">
 </head>
 
 <body background="<?php echo base_url('images/body_background.jpg'); ?>" style="background-size:cover; padding:10px; padding-bottom:60px;">
	<div id="wrapper" style="min-height: 100%; position:relative">
		<br>
		<div class="container">
		  <div class="jumbotron img-rounded" style = "text-align: center; background-image: url(<?php echo base_url('images/header_background.jpg'); ?>); background-size: 130%;">
			<h1>Internet Banking</h1>
		  </div>
		</div>
		
		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
		<div>
			 <nav class="navbar navbar-inverse col-xs-8 col-sm-8 col-md-8 col-lg-8">
					  <div class="container-fluid">
						<div class="navbar-header">
						  <a class="navbar-brand" href="<?php echo site_url('home') ?>">Internet Banking</a>
						</div>
						<ul class="nav navbar-nav">
							<li><a href="<?php echo site_url('home/index') ?>">Home</a></li>
							<?php if ($this->session->userdata('logged_in')) { ?>
							<li><a href="<?php echo site_url('home/deposit') ?>">Deposit</a></li>
							<li><a href="<?php echo site_url('home/withdraw') ?>">Withdraw</a></li>
							<li><a href="<?php echo site_url('home/transfer') ?>">Transfer</a></li>
							<?php } ?>
						</ul>
						 <ul class="nav navbar-nav navbar-right">
							<?php if ($this->session->userdata('logged_in')) { ?>
								<li><a href="<?php echo site_url('home/logout') ?>" class="btn btn-link" role="button">Logout</a></li>
							<?php } else { ?>
								<li><a href="<?php echo site_url('login') ?>" class="btn btn-link" role="button">Login</a></li>
							<?php } ?>
						 </ul>
					  </div>
			 </nav>
		</div>
		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
		
		