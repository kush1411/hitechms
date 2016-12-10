<?php
$email = array(
    'name' => 'EmpEmail',
    'type' => 'email',
    'id' => 'EmpEmail',
    'value' => isset($employee) ? $employee->EmpEmail : '',
    'class' => 'form-control',
    'readonly' => 'readonly'
);
$password = array(
    'type' => 'password',
    'name' => 'EmpPassword',
    'id' => 'EmpPassword',
    'value' => '',
    'class' => 'form-control',
);
$cpassword = array(
    'type' => 'password',
    'name' => 'EmpCPassword',
    'id' => 'EmpCPassword',
    'value' => '',
    'class' => 'form-control',
);
$submit = array('name' => 'submit',
    'id' => 'submit',
    'value' => 'Submit',
    'class' => 'btn btn-danger'
);
?>

<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="section-body contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-primary">Create Or Reset Employee Password</h2>
                </div>
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <div class="col-lg-12">
                    <?php
                    $hidden = array('EmpID' => $employee->EmpID);
                    echo form_open_multipart("employee/login/$employee->EmpID", 'id="addadminfrm" class="form"', $hidden);
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <?php echo form_input($email); ?>
                                        <?php echo form_label('<span style="color: red">*</span> Email : ', 'EmpEmail'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class = "form-group">
                                        <?php echo form_input($password); ?>
                                        <?php echo form_label('<span style="color: red">*</span> Password', 'EmpPassword'); ?>
                                        <?php echo form_error('EmpPassword', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <a href="javascript:void(0);" class="btn btn-info btn-xs btn-raised generatepwd"><i class="md md-refresh"></i> Generate</a>
                                    <a href="javascript:void(0);" class="btn btn-danger btn-xs btn-raised clearpwd "><i class="md md-close"></i> Clear</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class = "form-group">
                                        <?php echo form_input($cpassword); ?>
                                        <?php echo form_label('<span style="color: red">*</span> Confirm Password', 'EmpCPassword'); ?>
                                        <?php echo form_error('EmpCPassword', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <div>
                                            <label class="checkbox-inline checkbox-styled">
                                                <input name="IsQuot" value="1" id="IsQuot" class="fancy-radio" type="checkbox" <?= isset($employee) && $employee->IsQuot == 1 ? 'checked=""' : '' ?> ><span>Yes</span>
                                            </label>
                                        </div>
                                        <label for="EmpShift">Rights for Manual Quotation? </label>
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
<script>
    $(document).on('click', '.generatepwd', function () {
        var _url = "<?= base_url('getrandom') ?>";
        var _post = 'GET';
        var _postType = 'json';
        $.ajax({type: _post, url: _url, dataType: _postType,
            success: function (_returnData) {
                if (_returnData.result == 'success') {
                    $('#EmpPassword').val(_returnData.rand);
                    $('#EmpCPassword').val(_returnData.rand);
                } else {
                    alert('Try again');
                }
                return false;
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Connection Error, Try Again');
                setTimeout(function () {
                    location = ''
                }, 10);
            }
        });
    });
    $(document).on('click', '.clearpwd', function () {
        $('#EmpPassword').val('');
        $('#EmpCPassword').val('');
    });
    $(document).ready(function () {
        $("#addadminfrm").validate({
            // Rules for form validation
            rules: {
                EmpPassword: {
                    minlength: 3,
                    maxlength: 20
                },
                EmpCPassword: {
                    minlength: 3,
                    maxlength: 20,
                    equalTo: '#EmpPassword'
                },
            },
            // Messages for form validation
            messages: {
                EmpPassword: {
                    required: 'New Password Required',
                },
                ConNewUserPass: {
                    equalTo: 'Write Same Password As Password'
                },
            },
            // Do not change code below
            //errorPlacement : function(error, element) {
            //	error.insertAfter(element.parent());
            //}
        });
    });
</script>