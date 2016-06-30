	
		  <div class="container" style="width:50%; margin: auto; overflow-y: auto; top: 200px">
			<div class="row" style="background-color: #f7f8f3; border-radius: 25px;">
				<div class="col-sm-6 col-md-4 col-md-offset-4">
					<h1 class="text-center login-title">Transfer Form</h1>
					<div class="account-wall">
						<?php echo validation_errors(); ?>
						<?php echo form_open('home/transfer'); ?>
							<label for="account_no" class="sr-only">Account No.</label>
							<input type="input" name="account_no" class="form-control" maxlength="10" placeholder="Enter account no" required autofocus>
							
							<label for="transfer_amount" class="sr-only">Transfer Amount</label>
							<input type="input" name="transfer_amount" class="form-control" placeholder="Enter amount to transfer" required autofocus>
							<br>
							<button class="btn btn-lg btn-primary btn-block" value="Transfer" name="transfer" type="submit" style=" background-color: #303030;">Transfer</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		
