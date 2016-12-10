<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo SITE_NAME; ?> | <?php echo $add_title; ?></title>
		<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
        <?php
        echo $add_css;
        echo $add_js;
        ?>
    </head>
	<body class="menubar-hoverable header-fixed ">
	<?php
        $uservalue = (isset($postdata['username']) && $postdata['username'] != '') ? $postdata['username'] : '';
        $userName = array(
            'name' => 'username',
            'class' => 'login-inp form-control',
            'id' => 'username',
            'value' => $uservalue
        );
        $password = array(
            'name' => 'password',
            'class' => 'login-inp form-control',
            'id' => 'password'
        );
    ?>
		<!-- BEGIN LOGIN SECTION -->
		<section class="section-account">
			<div class="spacer"></div>
			<div class="card contain-sm">
				<div class="card-body">
					<div class="row">
					<div class="col-sm-12">
					<?php echo $add_error; ?>
                        <?php echo $add_warning; ?>
                        <?php echo $add_info; ?>
                        <?php echo $add_success; ?>
					</div>
						<div class="col-sm-12">
							<span class="text-lg text-bold text-primary logo_text"><img src="http://hitechms.in/assets/frontend/img/logoadmin.png"  /></span>
							<br/>
							<?php
							echo form_open('admin', array('name' => 'login','class' => 'form', 'accept-charset' => 'utf-8','method' => 'post')); ?>
								<div class="form-group">
									<?php echo form_input($userName); ?>  
									<label for="username">Username</label>
									<div class="login-error"><?php echo form_error('username'); ?></div>
								</div>
								<div class="form-group">
									<?php echo form_password($password); ?>
									<label for="password">Password</label>
									<div class="login-error"><?php echo form_error('password'); ?></div>
								</div>
								<br/>
								<div class="row">
									<div class="col-xs-6 text-left">
										<!--<div class="checkbox checkbox-inline checkbox-styled">
											<label>
												<input type="checkbox"> <span>Remember me</span>
											</label>
										</div>-->
									</div><!--end .col -->
									<div class="col-xs-6 text-right">
										<button class="btn btn-primary btn-raised submit-login" type="submit" value="Login">Login</button>
									</div><!--end .col -->
								</div><!--end .row -->
							<?php echo form_close(); ?>
						</div><!--end .col -->
							</div><!--end .row -->
						</div><!--end .card-body -->
					</div><!--end .card -->
				</section>
			</body>
</html>