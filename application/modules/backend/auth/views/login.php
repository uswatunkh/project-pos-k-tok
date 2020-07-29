<p class="login-box-msg">Sign in to start your session</p>
<form action="<?php echo backend_url() . 'auth/login'; ?>" method="post">
	<div class="form-group has-feedback">
		<input id="identity" type="email" value="" name="identity" class="form-control" placeholder="Email">
		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	</div>
	<div class="form-group has-feedback">
		<input id="password" type="password" value="" name="password" class="form-control" placeholder="Password">
		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	</div>
	<?php if ($message != "") {
		if ($message == "<li>Password Reset Email Sent</li>" || $message == "<li>Password Successfully Changed</li>") {
			echo "<div class='callout callout-success'><ul class='ul-callout'>" . $message . "</ul></div>";
		} else {
			echo "<div class='callout callout-danger'><ul class='ul-callout'>" . $message . "</ul></div>";
		}
	}
	?>
	<div class="row">
		<div class="col-xs-8">
			<div class="checkbox icheck">
				<label>
					<input id="remember" value="1" name="remember" type="checkbox"> Remember Me
				</label>
			</div>
		</div><!-- /.col -->
		<div class="col-xs-4">
			<button type="submit" class="btn btn-default btn-block btn-flat">Sign In</button>
		</div><!-- /.col -->
	</div>
</form>

<a href="<?php echo backend_url() . 'auth/forgot_password'; ?>">I forgot my password</a>