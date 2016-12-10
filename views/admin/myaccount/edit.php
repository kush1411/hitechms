
<?php
$password = array(
    'name' => 'password',
    'id' => 'password',
    'class' => form_error('password') ? 'form-control mini fl' : 'form-control mini'
);
$Cpassword = array(
    'name' => 'Cpassword',
    'id' => 'Cpassword',
    'class' => form_error('Cpassword') ? 'form-control mini fl' : 'form-control mini'
);
$contact_num = array(
    'name' => 'contact_number',
    'id' => 'contact_number',
    'value' => $adminusers->contact_number,
    'class' => form_error('contact_number') ? 'form-control mini fl' : 'form-control mini'
);
$userName = array(
    'name' => 'username',
    'id' => 'username',
    'value' => $adminusers->username,
    'class' => form_error('username') ? 'form-control mini fl' : 'form-control mini'
);
$emailAd = array(
    'name' => 'email',
    'id' => 'email',
    'value' => $adminusers->email,
    'class' => form_error('email') ? 'form-control mini fl' : 'form-control mini',
);
$image = array(
    'name' => 'photo',
    'id' => 'photo',
    'class' => 'form-control mini fl',
);
$activeRadio = array(
    'name' => 'activated',
    'id' => 'status',
    'value' => '1',
    'checked' => $adminusers->activated ? TRUE : '',
    'class' => 'fancy-radio'
);
$deactiveRadio = array(
    'name' => 'activated',
    'id' => 'status',
    'value' => '0',
    'checked' => !$adminusers->activated ? TRUE : '',
    'class' => 'fancy-radio'
);
$banRadioYes = array(
    'name' => 'ban',
    'id' => 'ban',
    'value' => '1',
    'class' => 'fancy-radio'
);
$banRadioNo = array(
    'name' => 'ban',
    'id' => 'ban',
    'value' => '0',
    'class' => 'fancy-radio'
);
$submit = array('name' => 'submit',
    'id' => 'submit',
    'value' => 'Submit',
    'class' => 'btn btn-danger'
);
//$reset = array(
//    'name' => 'reset',
//    'id' => 'reset',
//    'value' => 'Reset',
//    'class' => 'btn btn-blue'
//);
?>
<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="section-body contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-primary">My Account</h2>
                </div>
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <div class="col-lg-12">
                    <?php echo form_open_multipart("admin/myaccount", 'id="addadminfrm" class="form"'); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <?php echo form_input($emailAd); ?>
                                        <?php echo form_label('Email : ', 'email', array('class' => 'required')); ?>
                                        <?php echo form_error('email', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_password($password); ?> 
                                        <?php echo form_label('Password : ', 'password', array('class' => 'required')); ?>
                                        <?php echo form_error('password', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_password($Cpassword); ?>
                                        <?php echo form_label('Confirm Password : ', 'Confirm Password', array('class' => 'required')); ?>
                                        <?php echo form_error('Cpassword', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($userName); ?>
                                        <?php echo form_label('Name : ', 'Name', array('class' => 'required')); ?>
                                        <?php echo form_error('username', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($contact_num); ?>
                                        <?php echo form_label('Contact number : ', 'Contact number', array('class' => 'required')); ?>
                                        <?php echo form_error('contact_number', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
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
                                        <?php echo form_label('Status : ', 'Status', array('class' => 'required')); ?>
                                        <?php echo form_error('activated', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <?php echo form_upload($image); ?>
                                        <?php echo form_label('Profile image : ', 'image', array('class' => 'lefpad10')); ?>
                                        <?php if (isset($uploadError) && !empty($uploadError)) { ?>
                                            <div id="error"><div class="error-left"></div><div class="error-inner">
                                                    <?php echo $uploadError; ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php
                                if ($adminusers->image_name) {
                                    ?>
                                    <div class="col-sm-12">
                                        <img width="200" height="180" src="<?php echo base_url($adminusers->image_path . '/' . $adminusers->image_name); ?>" title="" />
                                    </div>
                                <?php } ?>

                                <div class="col-sm-12" style="display:none">
                                    <table class="table rights-tables">
                                        <tbody>
                                            <tr>
                                                <th><?php echo form_label('Module', 'headers', array('class' => 'lefpad10')); ?> </th>
                                                <th><?php echo form_label('Landing Page', 'Landing Page', array('class' => 'lefpad10')); ?> </th>
                                            </tr>
                                            <?php
                                            foreach ($adminusers->adminright as $k => $v) {
                                                $checked = FALSE;
                                                if ($adminusers->landingpage && $v->module && ($v->module->id == $adminusers->landingpage->module_id)) {
                                                    $checked = True;
                                                }
                                                ?>
                                                <?php if ($v->module) { ?>
                                                    <tr>
                                                        <td><?php echo form_label($v->module->name, $v->module->name, 'class="lefpad10"'); ?></td>
                                                        <td><?php echo form_radio("landing", $v->module->id, $checked, 'class="case"'); ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-actionbar">
                            <div class="card-actionbar-row">
                                <?php echo form_submit($submit); ?>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div><!--end .col -->
            </div><!--end .row -->
        </div><!--end .section-body -->
    </section>
</div><!--end #content-->