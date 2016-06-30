			<br><br>
			<footer id="footer" style="text-align: center; margin-top: -180px; color: white; clear: both; position:absolute; bottom:0; width:100%; height: 60px;">
				<br><br>
				<p>© Copyright 2016, ITDC Midyear Internship &nbsp;&nbsp;&nbsp;&nbsp;
				
					<a href="<?php echo site_url('home') ?>">Home</a> |
					<?php if ($this->session->userdata('logged_in')) { ?>
						<a href="<?php echo site_url('home/deposit') ?>">Deposit</a> |
						<a href="<?php echo site_url('home/withdraw') ?>">Withdraw</a> |
						<a href="<?php echo site_url('home/transfer') ?>">Transfer</a>   &nbsp;&nbsp;&nbsp;&nbsp; |  &nbsp;&nbsp;&nbsp;&nbsp;
					<?php } ?>
					
					<?php if ($this->session->userdata('logged_in')) { ?>
						<a href="<?php echo site_url('home/logout') ?>">Logout</a> 
					<?php } else { ?>
						<a href="<?php echo site_url('login') ?>">Login</a> 
					<?php } ?>
				</p>
			</footer>
		
		</div>
	</body>
</html>