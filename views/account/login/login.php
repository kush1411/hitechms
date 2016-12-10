<?php
$code = array(
    'name' => 'code',
    'id' => 'code',
    'type' => 'text',
//    'placeholder' => 'Enter email',
    'value' => '',
    'class' => 'form-control',
    'required' => 'required',
    'maxlength' => 6
);
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
                <div class="col-sm-12">
                    <span class="text-lg text-bold text-primary logo_text"><img src="http://hitechms.in/assets/frontend/img/logoadmin.png"  /></span>
                    <br/>
                    <?php echo form_open('account/auth/index', array('name' => 'login', 'class' => 'form', 'accept-charset' => 'utf-8', 'method' => 'post')); ?>
                    <div class="form-group">
                        <?php echo form_input($code); ?>  
                        <label for="username">Company Code</label>
                        <div class="login-error"><?php echo form_error('code'); ?></div>
                    </div>
                    <div class="form-group">
                        <?php echo form_input($email); ?>  
                        <label for="username">Account Email</label>
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