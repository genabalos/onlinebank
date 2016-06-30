
		<div class="container" style="width:50%; margin: auto; overflow-y: auto; top: 200px">
			<div class="row" style="background-color: #f7f8f3; border-radius: 25px;">
				<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-md-offset-4">
					<h1 class="text-center login-title">Sign in Form</h1>
					<div class="account-wall">
						<?php echo validation_errors(); ?>
						<?php echo form_open('login/verifylogin'); ?>
							<label for="account_no" class="sr-only">Account No.</label>
							<input type="text" name="account_no" maxlength="10" class="form-control" placeholder="Account No." required autofocus>
							
							<label for="pin" class="sr-only">PIN</label>
							<input type="password" name="pin" maxlength="4" class="form-control" placeholder="PIN" required>
							<br>
							<button class="btn btn-lg btn-primary btn-block" value="Login" name="submit" type="submit" style="background-color: #303030;">Log in</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		   
	