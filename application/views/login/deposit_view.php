
		
		  <div class="container" style="width:50%">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-md-offset-4">
					<h1 class="text-center login-title">Deposit Form</h1>
					<div class="account-wall">
						<?php echo validation_errors(); ?>
						<?php echo form_open('home/deposit'); ?>
							<label for="deposit_amount" class="sr-only">Deposit Amount</label>
							<input type="input" name="deposit_amount" class="form-control" placeholder="Enter amount to deposit" required autofocus>
							<br>
							<button class="btn btn-lg btn-primary btn-block" value="Deposit" name="deposit" type="submit" style=" background-color: #303030;">Deposit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		
