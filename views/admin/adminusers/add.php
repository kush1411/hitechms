<?php
$password = array(
    'name' => 'password',
    'id' => 'password',
    'class' => form_error('password') ? 'form-control mini fl' : 'mini form-control'
);
$Cpassword = array(
    'name' => 'Cpassword',
    'id' => 'Cpassword',
    'class' => form_error('Cpassword') ? 'form-control mini fl' : 'form-control mini'
);
$contact_num = array(
    'name' => 'contact_number',
    'id' => 'contact_number',
    'value' => isset($postdata->contact_number) ? $postdata->contact_number : (isset($adminusers->contact_number) ? $adminusers->contact_number : ''),
    'class' => form_error('contact_number') ? 'form-control mini fl' : 'form-control mini'
);
$userName = array(
    'name' => 'username',
    'id' => 'username',
    'value' => isset($postdata->username) ? $postdata->username : (isset($adminusers->username) ? $adminusers->username : ''),
    'class' => form_error('username') ? 'form-control mini fl' : 'form-control mini'
);
$emailAd = array(
    'name' => 'email',
    'id' => 'email',
    'value' => isset($postdata->email) ? $postdata->email : (isset($adminusers->email) ? $adminusers->email : ''),
    'class' => form_error('email') ? 'form-control mini fl' : 'form-control mini',
);
$image = array(
    'name' => 'photo',
    'id' => 'photo',
    'class' => 'form-control fl',
);
$activated = (isset($postdata->activated) && ($postdata->activated == '1')) ? TRUE : $adminusers->activated && ($adminusers->activated == '1') ? TRUE : FALSE;
$deactivated = $adminusers->activated && ($adminusers->activated == '0') ? TRUE : (isset($postdata->activated) && ($postdata->activated == '0')) ? TRUE : TRUE;
$activeRadio = array(
    'name' => 'activated',
    'id' => 'status',
    'value' => '1',
    'checked' => $activated,
//    'checked' => isset($postdata) && isset($postdata->acivated) && ($postdata->acivated == '1') ? TRUE : $adminusers->activated ? TRUE : '',
    'class' => 'fancy-radio'
);
$deactiveRadio = array(
    'name' => 'activated',
    'id' => 'status',
    'value' => '0',
    'checked' => $deactivated,
//    'checked' => isset($postdata) && isset($postdata->acivated) && ($postdata->activated == '0') ? true : !$adminusers->activated ? TRUE : '',
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
    'class' => 'btn btn-danger ink-reaction'
);
$reset = array(
    'name' => 'reset',
    'id' => 'reset',
    'value' => 'Reset',
    'class' => 'btn btn-info'
);
?>


<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="section-body contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($action == 'edit') { ?>
                        <h2 class="text-primary">Edit Admin</h2>
                        <?php } else {
                        ?>
                        <h2 class="text-primary">Create Admin</h2>
                    <?php } ?>
                </div>
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <div class="col-lg-12">
                    <?php
                    if ($action == 'edit') {
                        $hidden = array(
                            'name' => 'id',
                            'value' => $adminusers->id,
                        );
                        echo form_open_multipart("admin/edit/$adminusers->id", 'id="addadminfrm" class="form"', $hidden);
                    } else {
                        echo form_open_multipart('admin/admin/add', 'id="addadminfrm" class="form"');
                    }
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php
                                        $select = isset($postdata->admingroup_id) ? $postdata->admingroup_id : (isset($adminusers->admingroup_id) ? $adminusers->admingroup_id : '');

                                        echo form_dropdown('admingroup_id', $admingp, $select, 'class ="form-control" id="admingroup"');
                                        ?>
                                        <?php echo form_label('Group : ', 'admingroup', array('class' => 'required')); ?>
                                        <?php echo form_error('admingroup_id', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
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
                                <?php if ($action == 'edit' && $adminusers->image_name) { ?>
                                    <div class="col-sm-12">
                                        <img width="200" height="180" src="<?php echo base_url($adminusers->image_path . '/' . $adminusers->image_name); ?>" title="" />
                                    </div>
                                <?php } ?>
                                <?php if ($action == 'edit' && $this->session->userdata[SITE_NAME . '_admin_user_data']['user_id'] == $adminusers->id) { ?>
                                <?php } else { ?>
                                    <div class="col-sm-12">
                                        <?php echo form_input(array('type' => 'button', 'name' => 'check', 'class' => 'btn btn-info ', 'value' => 'Check All', 'id' => 'check')); ?>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th><?php echo form_label('Module/Rights', 'headers', array('class' => 'lefpad10')); ?> </th>
                                                    <th><?php echo form_label('Read', 'Read', array('class' => 'lefpad10')); ?> </th>
                                                    <th><?php echo form_label('Add', 'Add', array('class' => 'lefpad10')); ?> </th>
                                                    <th><?php echo form_label('Edit', 'Edit', array('class' => 'lefpad10')); ?> </th>
                                                    <th><?php echo form_label('Delete', 'Delete', array('class' => 'lefpad10')); ?> </th>
                                                    <th><?php echo form_label('Other', 'Other', array('class' => 'lefpad10')); ?> </th>
                                                    <!--<th><?php echo form_label('Landing Page', 'Landing Page', array('class' => 'lefpad10')); ?> </th>-->
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <!--<td>&nbsp;</td>-->
                                                </tr>
                                                <?php
                                                foreach ($allmodules as $k => $v) {
                                                    $read = $add = $edit = $delete = $sendemail = $copyproduct = $download = $other = '';
                                                    if ($action == 'edit') {
                                                        $userRights = $adminusers->getRights($k);
                                                        if ($userRights & READ_MODULE) {
                                                            $read = "checked";
                                                        }
                                                        if ($userRights & ADD_MODULE) {
                                                            $add = "checked";
                                                        }
                                                        if ($userRights & EDIT_MODULE) {
                                                            $edit = "checked";
                                                        }
                                                        if ($userRights & DELETE_MODULE) {
                                                            $delete = "checked";
                                                        }
                                                        if ($userRights & SEND_EMAIL_MODULE || $userRights & COPY_PRODUCT_MODULE || $userRights & DOWNLOAD_MODULE) {
                                                            $other = "checked";
                                                        }
                                                    }
                                                    if (isset($postdata->rights) && !empty($postdata->rights)) {
                                                        if (isset($postdata->rights[$k]) && isset($postdata->rights[$k]['read'])) {
                                                            $read = "checked";
                                                        }
                                                        if (isset($postdata->rights[$k]) && isset($postdata->rights[$k]['add'])) {
                                                            $add = "checked";
                                                        }
                                                        if (isset($postdata->rights[$k]) && isset($postdata->rights[$k]['edit'])) {
                                                            $edit = "checked";
                                                        }
                                                        if (isset($postdata->rights[$k]) && isset($postdata->rights[$k]['delete'])) {
                                                            $delete = "checked";
                                                        }
                                                        if (isset($postdata->rights[$k]) && isset($postdata->rights[$k]['other'])) {
                                                            $other = "checked";
                                                        }
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?php echo form_label($v, $v, array('class' => 'lefpad10')); ?></td>
                                                        <td><?php echo $k != MYACCOUNT ? form_checkbox("rights[$k][read]", '', $read, 'class="case"') : ''; ?></td>
                                                        <td><?php echo $k != MYACCOUNT ? ($k != BULKUPLOAD ? form_checkbox("rights[$k][add]", '', $add, 'class="case"') : '' ) : ''; ?></td>
                                                        <td><?php echo $k != MYACCOUNT ? ($k != BULKUPLOAD ? form_checkbox("rights[$k][edit]", '', $edit, 'class="case"') : '') : ''; ?></td>
                                                        <td><?php echo $k != MYACCOUNT ? form_checkbox("rights[$k][delete]", '', $delete, 'class="case"') : ''; ?></td>
                                                        <td><?php echo $k != MYACCOUNT && $v == 'Admin' || $v == 'Reports' || $v == 'Dbbackups' || $v == 'Newsletters' ? form_checkbox("rights[$k][other]", '', $other, 'class="case"') : ''; ?></td>
                                                        <?php
                                                        $radioCheck = FALSE;
                                                        if (isset($landingPage) && !empty($landingPage) && $landingPage == $k) {
                                                            $radioCheck = true;
                                                        } else if ($k == MYACCOUNT) {
                                                            $radioCheck = true;
                                                        }
                                                        ?>
                                                        <!--<td><?php echo $k != BULKUPLOAD ? form_radio("landing", $k, $radioCheck, 'class="case"') : ''; ?></td>-->
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                <?php } ?>
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
