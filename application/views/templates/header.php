<html>
 <head>
   <title>Internet Banking</title>
   <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body background="https://wallpaperscraft.com/image/hand_card_money_online_purchase_laptop_80035_1920x1080.jpg" style="background-size:cover">
 
	<br>
	<div class="container">
	  <div class="jumbotron" style = "text-align: center; background-image: url(http://cdn-pays.bnpparibas.com/wp-content/blogs.dir/177/files/2015/10/Key-page-header-950x230.jpg); background-size: 130%;">
		<h1 >Internet Banking</h1>
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
						<li><a href="<?php echo site_url('home') ?>">Home</a></li>
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