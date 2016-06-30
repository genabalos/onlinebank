
		
	 
		  <div class="container" style="width:50%; margin: auto; overflow-y: auto; top: 200px">
			<div class="row" style="background-color: #f7f8f3; border-radius: 25px;">
				<div class="col-sm-6 col-md-4 col-md-offset-4">
					<h1 class="text-center login-title">Withdrawal Form</h1>
					<div class="account-wall">
						<?php echo validation_errors("Invalid Amount."); ?>
						<?php echo form_open('home/withdraw'); ?>
							<label for="deposit_amount" class="sr-only">Withdraw Amount</label>
							<input type="input" name="withdraw_amount" class="form-control" placeholder="Enter amount to withdraw" required autofocus>
							<br>
							<button class="btn btn-lg btn-primary btn-block" value="Withdraw" name="withdraw" type="submit" style=" background-color: #303030;">Withdraw</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		
