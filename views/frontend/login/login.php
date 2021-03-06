<?php
$email = array(
    'name' => 'email',
    'id' => 'email',
    'type' => 'email',
//    'placeholder' => 'Enter email',
    'value' => '',
    'class' => 'form-control',
    'required' => 'required'
);
$password = array(
    'name' => 'password',
    'id' => 'password',
//    'placeholder' => 'Password',
    'value' => '',
    'class' => 'form-control',
    'required' => 'required'
);
?>
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
                <div class="col-sm-6">
                    <span class="text-lg text-bold text-primary logo_text"><img src="http://hitechms.in/assets/frontend/img/logoadmin.png"  /></span>
                    <br/>
                    <?php echo form_open('frontend/auth/index', array('name' => 'login', 'class' => 'form', 'accept-charset' => 'utf-8', 'method' => 'post')); ?>
                    <div class="form-group">
                        <?php echo form_input($email); ?>  
                        <label for="username">User Email</label>
                        <div class="login-error"><?php echo form_error('email'); ?></div>
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
                <div class="col-sm-5 col-sm-offset-1 text-center">

                    <h3 class="text-light">
                        No account yet?
                    </h3>
                    <a class="btn btn-block btn-raised btn-primary" href="<?= base_url('register');?>">Sign up here</a>



                </div><!--end .col -->
            </div><!--end .row -->
        </div><!--end .card-body -->
    </div><!--end .card -->
</section>