<?php
$email = array(
    'name' => 'MfgEmail',
    'id' => 'MfgEmail',
    'type' => 'email',
    'value' => isset($mfg) ? $mfg->MfgEmail : '',
    'class' => 'form-control'
);
$name = array(
    'name' => 'MfgName',
    'id' => 'MfgName',
    'value' => isset($mfg) ? $mfg->MfgName : '',
    'class' => 'form-control'
);
$MfgAddr1 = array(
    'name' => 'MfgAddr1',
    'id' => 'MfgAddr1',
    'value' => isset($mfg) ? $mfg->MfgAddr1 : '',
    'class' => 'form-control'
);
$MfgAddr2 = array(
    'name' => 'MfgAddr2',
    'id' => 'MfgAddr2',
    'value' => isset($mfg) ? $mfg->MfgAddr2 : '',
    'class' => 'form-control'
);
$MfgCity = array(
    'name' => 'MfgCity',
    'id' => 'MfgCity',
    'value' => isset($mfg) ? $mfg->MfgCity : '',
    'class' => 'form-control'
);
$MfgState = array(
    'name' => 'MfgState',
    'id' => 'MfgState',
    'value' => isset($mfg) ? $mfg->MfgState : '',
    'class' => 'form-control'
);
$MfgCountry = array(
    'name' => 'MfgCountry',
    'id' => 'MfgCountry',
    'value' => isset($mfg) ? $mfg->MfgCountry : '',
    'class' => 'form-control'
);
$MfgPincode = array(
    'name' => 'MfgPincode',
    'id' => 'MfgPincode',
    'value' => isset($mfg) ? $mfg->MfgPincode : '',
    'class' => 'form-control'
);
$MfgContactPerson1 = array(
    'name' => 'MfgContactPerson1',
    'id' => 'MfgContactPerson1',
    'value' => isset($mfg) ? $mfg->MfgContactPerson1 : '',
    'class' => 'form-control'
);
$MfgContactNumber1 = array(
    'name' => 'MfgContactNumber1',
    'id' => 'MfgContactNumber1',
    'value' => isset($mfg) ? $mfg->MfgContactNumber1 : '',
    'class' => 'form-control'
);
$MfgContactPerson2 = array(
    'name' => 'MfgContactPerson2',
    'id' => 'MfgContactPerson2',
    'value' => isset($mfg) ? $mfg->MfgContactPerson2 : '',
    'class' => 'form-control'
);
$MfgContactNumber2 = array(
    'name' => 'MfgContactNumber2',
    'id' => 'MfgContactNumber2',
    'value' => isset($mfg) ? $mfg->MfgContactNumber2 : '',
    'class' => 'form-control'
);


$submit = array('name' => 'submit',
    'id' => 'submit',
    'value' => 'Submit',
    'class' => 'btn btn-danger'
);
$activeRadio = array(
    'name' => 'Status',
    'id' => 'Status',
    'value' => '1',
    'class' => 'fancy-radio',
    'checked' => isset($mfg) && $mfg->Status == 1 ? TRUE : (!isset($mfg) ? TRUE : ''),
);
$deactiveRadio = array(
    'name' => 'Status',
    'id' => 'Status',
    'value' => '0',
    'class' => 'fancy-radio',
    'checked' => isset($mfg) && $mfg->Status == 0 ? TRUE : '',
);
?>

<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="section-body contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($action == 'edit') { ?> 
                        <h2 class="text-primary">Edit Mfg Company</h2>
                    <?php } else {
                        ?>
                        <h2 class="text-primary">Create Mfg Company</h2>
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
                        $hidden = array('MfgID' => $mfg->MfgID);
                        echo form_open_multipart("admin/mfg/edit/$mfg->MfgID", 'id="addadminfrm" class="form"', $hidden);
                    } else {
                        echo form_open_multipart('admin/mfg/add', 'id="addadminfrm" class="form"');
                    }
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($name); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Name : ', 'MfgName', array('class' => 'required')); ?>
                                        <?php echo form_error('MfgName', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($email); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Email : ', 'MfgEmail', array('class' => 'required')); ?>
                                        <?php echo form_error('MfgEmail', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($MfgAddr1); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Addr1 : ', 'MfgAddr1', array('class' => 'required')); ?>
                                        <?php echo form_error('MfgAddr1', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($MfgAddr2); ?>
                                        <?php echo form_label('Addr2 : ', 'MfgAddr2', array()); ?>
                                        <?php echo form_error('MfgAddr2', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php echo form_input($MfgCity); ?>
                                        <?php echo form_label('<span style="color: red">*</span>City : ', 'MfgCity', array('class' => 'required')); ?>
                                        <?php echo form_error('MfgCity', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php echo form_input($MfgState); ?>
                                        <?php echo form_label('<span style="color: red">*</span>State : ', 'MfgState', array('class' => 'required')); ?>
                                        <?php echo form_error('MfgState', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php echo form_input($MfgCountry); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Country : ', 'MfgCountry', array('class' => 'required')); ?>
                                        <?php echo form_error('MfgCountry', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php echo form_input($MfgPincode); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Pincode : ', 'MfgPincode', array('class' => 'required')); ?>
                                        <?php echo form_error('MfgPincode', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php echo form_input($MfgContactPerson1); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Contact Person 1 : ', 'MfgContactPerson1', array('class' => 'required')); ?>
                                        <?php echo form_error('MfgContactPerson1', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php echo form_input($MfgContactNumber1); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Contact Number 1 : ', 'MfgContactNumber1', array('class' => 'required')); ?>
                                        <?php echo form_error('MfgContactNumber1', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php echo form_input($MfgContactPerson2); ?>
                                        <?php echo form_label('Contact Person 2 : ', 'MfgContactPerson2', array()); ?>
                                        <?php echo form_error('MfgContactPerson2', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php echo form_input($MfgContactNumber2); ?>
                                        <?php echo form_label('Contact Number 2 : ', 'MfgContactNumber2', array()); ?>
                                        <?php echo form_error('MfgContactNumber2', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
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
                                        <?php echo form_error('Status', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="checkbox checkbox-styled">
                                        <label>
                                            <input type="checkbox" value="1" name="IsPartsMfg" id="IsPartsMfg" <?= isset($mfg) && $mfg->IsPartsMfg == '1' ? 'checked=""' : '' ?>>
                                            <span>Is Parts Or Subparts Manufacturer?</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-actionbar">
                            <div class="card-actionbar-row">
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

<?php if ($action == 'edit') { ?>
    <script>
        $(document).ready(function () {
            $("#addadminfrm").validate({
                // Rules for form validation
                rules: {
                    MfgName: {
                        required: true,
                        remote: "<?= base_url('admin/mfg/check/' . $mfg->MfgID); ?>",
                    },
                    MfgAddr1: {required: true},
                    MfgCity: {required: true},
                    MfgState: {required: true},
                    MfgCountry: {required: true},
                    MfgPincode: {required: true},
                    MfgContactPerson1: {required: true},
                    MfgContactNumber1: {required: true},
                    MfgEmail: {required: true}
                },
                // Messages for form validation
                messages: {
                    MfgName: {
                        required: 'Please Enter Mfg Name',
                        remote: 'Mfg Name Already Available, Try Another'
                    },
                    MfgAddr1: {required: 'Address Required'},
                    MfgCity: {required: 'City Required'},
                    MfgState: {required: 'State Required'},
                    MfgCountry: {required: 'Country Required'},
                    MfgPincode: {required: 'Pincode Required'},
                    MfgContactPerson1: {required: 'Contact Person Name Required'},
                    MfgContactNumber1: {required: 'Contact Number Required'},
                    MfgEmail: {required: 'Email Required'}
                },
                // Do not change code below
                //errorPlacement : function(error, element) {
                //	error.insertAfter(element.parent());
                //}
            });
        });
    </script>
<?php } else { ?>
    <script>
        $(document).ready(function () {
            $("#addadminfrm").validate({
                // Rules for form validation
                rules: {
                    MfgName: {
                        required: true,
                        remote: "<?= base_url('admin/mfg/check'); ?>",
                    },
                    MfgAddr1: {required: true},
                    MfgCity: {required: true},
                    MfgState: {required: true},
                    MfgCountry: {required: true},
                    MfgPincode: {required: true},
                    MfgContactPerson1: {required: true},
                    MfgContactNumber1: {required: true},
                    MfgEmail: {required: true}
                },
                // Messages for form validation
                messages: {
                    MfgName: {
                        required: 'Please Enter Mfg Name',
                        remote: 'Mfg Name Already Available, Try Another'
                    },
                    MfgAddr1: {required: 'Address Required'},
                    MfgCity: {required: 'City Required'},
                    MfgState: {required: 'State Required'},
                    MfgCountry: {required: 'Country Required'},
                    MfgPincode: {required: 'Pincode Required'},
                    MfgContactPerson1: {required: 'Contact Person Name Required'},
                    MfgContactNumber1: {required: 'Contact Number Required'},
                    MfgEmail: {required: 'Email Required'}
                },
                // Do not change code below
                //errorPlacement : function(error, element) {
                //	error.insertAfter(element.parent());
                //}
            });
        });
    </script>
<?php } ?>

