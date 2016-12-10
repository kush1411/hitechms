<?php
$email = array(
    'name' => 'remail',
    'type' => 'email',
    'id' => 'remail',
//    'placeholder' => 'Enter email',
    'value' => isset($postdata['remail']) ? $postdata['remail'] : '',
    'class' => 'form-control',
    'required' => 'required'
);
$password = array(
    'name' => 'rpassword',
    'id' => 'rpassword',
//    'placeholder' => 'Password',
    'value' => '',
    'class' => 'form-control',
    'required' => 'required'
);
$cpassword = array(
    'name' => 'cpassword',
    'id' => 'cpassword',
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
                    <?php echo form_open('frontend/auth/register', array('name' => 'register', 'class' => 'form', 'accept-charset' => 'utf-8', 'method' => 'post')); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                echo form_input(
                                        array(
                                            'name' => 'code',
                                            'class' => 'form-control',
                                            'id' => 'code',
//                                            'placeholder' => 'First Name',
                                            'value' => isset($postdata['code']) ? $postdata['code'] : (isset($user->code) ? $user->code : ''),
                                            'required' => 'required',
                                            'maxlength' => 6
                                ));
                                ?>
                                <?php echo form_label('<span style="color: red">*</span> Company Code', 'code'); ?>
                                <?php echo form_error('code'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                echo form_input(
                                        array(
                                            'name' => 'firstname',
                                            'class' => 'form-control',
                                            'id' => 'firstname',
//                                            'placeholder' => 'First Name',
                                            'value' => isset($postdata['firstname']) ? $postdata['firstname'] : (isset($user->firstname) ? $user->firstname : ''),
                                            'required' => 'required'
                                ));
                                ?>
                                <?php echo form_label('<span style="color: red">*</span> First Name', 'firstname'); ?>
                                <?php echo form_error('firstname'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <?php
                                echo form_input(
                                        array(
                                            'name' => 'lastname',
                                            'class' => 'form-control',
                                            'id' => 'lastname',
//                                            'placeholder' => 'Last Name',
                                            'value' => isset($postdata['lastname']) ? $postdata['lastname'] : (isset($user->lastname) ? $user->lastname : ''),
                                            'required' => 'required'
                                ));
                                ?>
                                <?php echo form_label('<span style="color: red">*</span> Last Name', 'lastname'); ?>
                                <?php
                                echo form_error('lastname');
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class = "form-group">
                                <?php echo form_input($email); ?>
                                <?php echo form_label('<span style="color: red">*</span> Email address', 'email'); ?>
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo form_password($password); ?>
                                <?php echo form_label('<span style="color: red">*</span> Password', 'password'); ?>
                                <?php echo form_error('password'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo form_password($cpassword); ?>
                                <?php echo form_label('<span style="color: red">*</span> Confirm Password', 'cpassword'); ?>

                                <?php echo form_error('cpassword'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                echo form_textarea(array('name' => 'address',
                                    'id' => 'address',
//                                    'palceholder' => 'address',
                                    'class' => 'form-control',
                                    'value' => isset($postdata['address']) ? $postdata['address'] : (isset($user) && $user->address ? ($user->userprofile->address) : ''),
                                    'required' => 'required'
                                ));
                                ?>
                                <?php echo form_label('<span style="color: red">*</span> Address', 'address'); ?>
                                <?php echo form_error('address'); ?>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                echo form_input(array('name' => 'city',
                                    'id' => 'city',
//                                    'palceholder' => 'city',
                                    'class' => 'form-control',
                                    'value' => isset($postdata['city']) ? $postdata['city'] : (isset($user) && $user->userprofile->city ? ($user->userprofile->city) : ''),
                                    'required' => 'required'
                                ));
                                ?>
                                <?php echo form_label('<span style="color: red">*</span> City', 'city'); ?>
                                <?php echo form_error('city'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                echo form_input(array('name' => 'state',
                                    'id' => 'state',
//                                    'palceholder' => 'state',
                                    'class' => 'form-control',
                                    'value' => isset($postdata['state']) ? $postdata['state'] : (isset($user) && $user->state ? ($user->userprofile->state) : ''),
                                    'required' => 'required'
                                ));
                                ?>
                                <?php echo form_label('<span style="color: red">*</span> State/Province', 'state'); ?>
                                <?php
                                echo form_error('state');
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                echo form_input(array('name' => 'country',
                                    'id' => 'country',
//                                    'palceholder' => 'country',
                                    'class' => 'form-control',
                                    'value' => isset($postdata['country']) ? $postdata['country'] : (isset($user) && $user->country ? ($user->userprofile->country) : ''),
                                    'required' => 'required'
                                ));
                                ?>
                                <?php echo form_label('<span style="color: red">*</span> Country', 'country'); ?>
                                <?php
                                echo form_error('country');
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                echo form_input(array('name' => 'zip',
                                    'id' => 'zip',
//                                    'palceholder' => 'zip',
                                    'class' => 'form-control',
                                    'value' => isset($postdata['zip']) ? $postdata['zip'] : (isset($user) && $user->zip ? ($user->userprofile->zip) : ''),
                                    'pattern' => "\d+",
                                    'required' => 'required'
                                ));
                                ?>
                                <?php echo form_label('<span style="color: red">*</span> Postal/Zip Code', 'zip'); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                echo form_input(array('name' => 'company',
                                    'id' => 'company',
//                                    'palceholder' => 'Company',
                                    'class' => 'form-control',
                                    'value' => isset($postdata['company']) ? $postdata['company'] : (isset($user) && $user->company ? ($user->userprofile->company) : ''),
                                ));
                                ?>
                                <?php echo form_label('Company', 'company'); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                echo form_input(array('name' => 'telephone',
                                    'id' => 'telephone',
//                                    'palceholder' => 'telephone',
                                    'class' => 'form-control',
                                    'value' => isset($postdata['telephone']) ? $postdata['telephone'] : (isset($user) && $user->telephone ? ($user->userprofile->telephone) : ''),
                                    'required' => 'required'
                                ));
                                ?>
                                <?php echo form_label('<span style="color: red">*</span> Telephone', 'telephone'); ?>
                                <?php
                                echo form_error('telephone');
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                echo form_input(array('name' => 'fax',
                                    'id' => 'fax',
//                                    'palceholder' => 'fax',
                                    'class' => 'form-control', 'pattern' => "\d+",
                                    'value' => isset($postdata['fax']) ? $postdata['fax'] : (isset($user) && $user->fax ? ($user->userprofile->fax) : ''),
                                ));
                                ?>
                                <?php echo form_label('Fax', 'fax'); ?>
                                <?php echo form_error('fax'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 text-left">
                        </div><!--end .col -->
                        <div class="col-xs-6 text-right">
                            <button class="btn btn-primary btn-raised submit-login" type="submit" value="Register">Register</button>
                        </div><!--end .col -->
                    </div><!--end .row -->
                    <?php echo form_close(); ?>
                </div><!--end .col -->
                <div class="col-sm-5 col-sm-offset-1 text-center">
                    <h3 class="text-light">
                        Already Registered?
                    </h3>
                    <a class="btn btn-block btn-raised btn-primary" href="<?= base_url('login') ?>">Login</a>
                </div><!--end .col -->
            </div><!--end .row -->
        </div><!--end .card-body -->
    </div><!--end .card -->
</section>