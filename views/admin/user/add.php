<?php
$submit = array('name' => 'submit',
    'id' => 'submit',
    'value' => 'Submit',
    'class' => 'btn btn-danger',
);
$reset = array(
    'name' => 'reset',
    'id' => 'reset',
    'value' => 'Reset',
    'class' => 'btn btn-blue'
);
$activate = isset($postdata->status) && ($postdata->status == '1') ? $postdata->status : "checked";
$deactivate = isset($postdata->status) && ($postdata->status == '0') ? $postdata->status : "";
$activeRadio = array(
    'name' => 'status',
    'id' => 'status',
    'value' => '1',
    'class' => 'form-control',
    'checked' => $activate,
);
$deactiveRadio = array(
    'name' => 'status',
    'id' => 'status',
    'value' => '0',
    'class' => 'form-control',
    'checked' => $deactivate,
);
$firstname = array(
    'name' => 'firstname',
    'id' => 'firstname',
    'class' => form_error('firstname') ? 'form-control mini fl' : 'form-control mini',
    'value' => isset($postdata) && isset($postdata->firstname) ? $postdata->firstname : '',
);
$email = array(
    'name' => 'email',
    'id' => 'email',
    'class' => form_error('email') ? 'form-control mini fl' : 'form-control mini',
    'value' => isset($postdata->email) ? $postdata->email : "",
);
$lastname = array(
    'name' => 'lastname',
    'id' => 'lastname',
    'class' => form_error('lastname') ? 'form-control mini fl' : 'form-control mini',
    'value' => isset($postdata->lastname) ? $postdata->lastname : "",
);
$password = array(
    'name' => 'password',
    'id' => 'password',
    'class' => form_error('password') ? 'form-control mini f1' : 'form-control mini'
);
$confirmpassword = array(
    'name' => 'confirmpassword',
    'id' => 'confirmpassword',
    'class' => form_error('confirmpassword') ? 'form-control mini f1' : 'form-control mini'
);
$aboutme = array(
    'name' => 'aboutme',
    'id' => 'aboutme',
    'class' => form_error('aboutme') ? 'form-control mini fl' : 'form-control mini',
    'value' => isset($postdata->aboutme) ? $postdata->aboutme : "",
);
$code = array(
    'name' => 'code',
    'id' => 'code',
    'class' => form_error('code') ? 'form-control mini fl' : 'form-control mini',
    'value' => isset($postdata->code) ? $postdata->code : "",
    'maxlength'=> 6
);
$telephone = array(
    'name' => 'telephone',
    'id' => 'telephone',
    'class' => form_error('telephone') ? 'form-control mini fl' : 'form-control mini',
    'value' => isset($postdata->telephone) ? $postdata->telephone : "",
);
$mobiles = array(
    'name' => 'mobiles',
    'id' => 'mobiles',
    'class' => form_error('mobiles') ? 'form-control mini fl' : 'form-control mini',
    'value' => isset($postdata->mobiles) ? $postdata->mobiles : "",
);
?>
<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="section-body contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-primary">Add User (Company)</h2>
                </div>
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <div class="col-lg-12">
                    <?php
                    echo form_open_multipart('admin/members/add', 'id="adduserfrm" class="form"');
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($code); ?>
                                        <?php echo form_error('code', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        <?php echo form_label('Company Short Code : ', 'code', array('class' => 'required')); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($email); ?>
                                        <?php echo form_error('email', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        <?php echo form_label('Email : ', 'email', array('class' => 'required')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($firstname); ?>
                                        <?php echo form_error('firstname', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        <?php echo form_label('First Name : ', 'firstname', array('class' => 'required')); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($lastname); ?>
                                        <?php echo form_error('lastname', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        <?php echo form_label('Last Name : ', 'lastname', array('class' => 'required')); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_password($password); ?>
                                        <?php echo form_error('password', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        <?php echo form_label('Password : ', 'password', array('class' => 'required')); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_password($confirmpassword); ?>
                                        <?php echo form_error('confirmpassword', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        <?php echo form_label('Confirm Password : ', 'confirmpassword', array('class' => 'required')); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div>
                                            <label class="radio-inline radio-styled">
                                                <?php echo form_radio($activeRadio); ?><span>Active</span>
                                            </label>
                                            <label class="radio-inline radio-styled">
                                                <?php echo form_radio($deactiveRadio); ?><span>Deactivate</span>
                                            </label>
                                        </div>
                                        <?php echo form_error('Status', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        <?php echo form_label('Status : ', 'Status', array('class' => 'required')); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($telephone); ?>
                                        <?php echo form_error('telephone', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        <?php echo form_label('Telephone : ', 'telephone', array('class' => 'required')); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($mobiles); ?>
                                        <?php echo form_error('mobiles', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        <?php echo form_label('Mobile : ', 'mobiles'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <?php echo form_textarea($aboutme); ?>
                                        <?php echo form_error('aboutme', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        <?php echo form_label('About Me : ', 'aboutme'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-actionbar">
                                <div class="card-actionbar-row">
                                    <?php echo form_reset($reset); ?>
                                    <?php echo form_submit($submit); ?>
                                    
                                </div>
                            </div>
                        </div><!--end .card -->
                        <?php echo form_close(); ?>
                    </div><!--end .col -->
                </div><!--end .row -->
            </div><!--end .section-body -->
    </section>
</div><!--end #content-->

<?php //echo form_label('Profile Picture : ', 'userfile'); ?>
<?php //echo form_upload($photo); ?>
<?php //echo form_error('userfile', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>

