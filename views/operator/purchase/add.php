<?php
$BarcodeNo = array(
    'name' => 'BarcodeNo',
    'id' => 'BarcodeNo',
    'value' => isset($jobmst) ? $jobmst->BarcodeNo : '',
    'class' => 'form-control ',
    'required' => true
);
$submit = array('name' => 'submit',
    'id' => 'submit',
    'value' => 'Purchase',
    'class' => 'btn btn-danger'
);
?>

<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="contain-lg">
            <div class="row">
                <div class="col-lg-12">
                        <h2 class="text-primary">New Purchase</h2>
                </div>
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <div class="col-lg-12">
                    <?php
                        echo form_open_multipart('operator/purchasemst/add', 'id="addadminfrm" class="form"');
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="ajaxbody">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?php echo form_input($BarcodeNo); ?>
                                            <?php echo form_label('<span style="color: red">*</span>Barcode : ', 'BarcodeNo', array('class' => 'required')); ?>
                                            <?php echo form_error('BarcodeNo', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        </div>
                                    </div>
<!--                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?php
//                                            echo form_input(array(
//                                                'name' => 'refMachID',
//                                                'id' => 'refMachID',
//                                                'value' => isset($jobmst) ? $jobmst->refMachID : '',
//                                                'class' => 'form-control ',
//                                                'type' => 'hidden'
//                                            ));
                                            ?>
                                            <?php
//                                            echo form_input(array(
//                                                'name' => 'refMachName',
//                                                'id' => 'refMachName',
//                                                'value' => isset($jobmst) ? $jobmst->refMachName : '',
//                                                'class' => 'form-control ',
//                                                'readonly' => true
//                                            ));
                                            ?>
                                            <?php //echo form_label('<span style="color: red">*</span>Machine : ', 'refMachID'); ?>
                                            <?php //echo form_error('refMachID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        </div>
                                    </div>-->
                                </div>
<!--                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?php
//                                            echo form_input(array(
//                                                'name' => 'Product',
//                                                'id' => 'Product',
//                                                'value' => isset($jobmst) ? $jobmst->Product : '',
//                                                'class' => 'form-control ',
//                                                'readonly' => true
//                                            ));
                                            ?>
                                            <?php //echo form_label('<span style="color: red">*</span>Part : ', 'Product'); ?>
                                            <?php //echo form_error('Product', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?php
//                                            echo form_input(array(
//                                                'name' => 'MfgName',
//                                                'id' => 'MfgName',
//                                                'value' => isset($jobmst) ? $jobmst->MfgName : '',
//                                                'class' => 'form-control ',
//                                                'readonly' => true
//                                            ));
                                            ?>
                                            <?php //echo form_label('<span style="color: red">*</span>Mfg Company : ', 'MfgName'); ?>
                                            <?php //echo form_error('MfgName', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select name="refProviderID" id="refProviderID" class="form-control select2-list" data-placeholder="--Select Service Provider--" required="">
                                                <option value="">--Select Service Provider--</option>
                                                <?php
//                                                if (!empty($provider)) {
//                                                    foreach ($provider as $key => $value) {
//                                                        $sel = '';
//                                                        if (isset($jobmst) && $jobmst->refProviderID == $value->SerProvID) {
//                                                            $sel = 'selected=""';
//                                                        }
//                                                        echo '<option value="' . $value->SerProvID . '" ' . $sel . '>' . $value->Name . '</option>';
//                                                    }
//                                                }
                                                ?>
                                            </select>
                                            <?php //echo form_label('<span style="color: red">*</span>Service Provider : ', 'refProviderID'); ?>
                                            <?php //echo form_error('refProviderID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select name="refEmpID" id="refEmpID" class="form-control select2-list" data-placeholder="--Select Employee--" required="">
                                                <option value="">--Select Employee--</option>
                                                <?php
//                                                if (!empty($employee)) {
//                                                    foreach ($employee as $key => $value) {
//                                                        $sel = '';
//                                                        if (isset($jobmst) && $jobmst->refEmpID == $value->EmpID) {
//                                                            $sel = 'selected=""';
//                                                        }
//                                                        echo '<option value="' . $value->EmpID . '" ' . $sel . '>' . $value->EmpCode . ' | ' . $value->EmpName . '</option>';
//                                                    }
//                                                }
                                                ?>
                                            </select>
                                            <?php //echo form_label('<span style="color: red">*</span>Request By: ', 'refEmpID'); ?>
                                            <?php //echo form_error('refEmpID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <?php //echo form_textarea($Issue); ?>
                                            <?php //echo form_label('<span style="color: red">*</span>Issue : ', 'Issue', array('class' => 'required')); ?>
                                            <?php //echo form_error('Issue', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?php //echo form_input($QuotAmt); ?>
                                            <?php //echo form_label('<span style="color: red">*</span>Quotation : ', 'QuotAmt', array('class' => 'required')); ?>
                                            <?php //echo form_error('QuotAmt', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?php //echo form_input($Remarks); ?>
                                            <?php //echo form_label('Remarks : ', 'Remarks'); ?>
                                            <?php //echo form_error('Remarks', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                            <div class="card-actionbar">
                                <div class="card-actionbar-row">
                                    <input type="hidden" name="IsWarranty" id="IsWarranty" value="" />
                                    <?php echo form_submit($submit); ?>
                                </div>
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
    $(document).ready(function () {
        $("#addadminfrm").validate({
            // Rules for form validation
            rules: {
                refMachPartID: {required: true},
                refMachSubPartID: {required: true},
                refMfgID: {required: true},
                SerialNo: {
                    required: true,
                    remote: "<?= base_url('operator/purchasemst/checkserialparts/'); ?>"
                }
            },
            // Messages for form validation
            messages: {
                refMachPartID: {required: 'Machine Part Required'},
                refMachSubPartID: {required: 'Machine Subpart Required'},
                refMfgID: {required: 'Manufacturer Required'},
                SerialNo: {
                    required: 'Please Enter Serial Number',
                    remote: 'Serial Number Already Available, Try Another'
                }
            }
        });
    });
</script>
<script>
    var barc = '';
    $(document).on('keyup paste propertychange', '#BarcodeNo', function () {
        if ($(this).val() && barc != $(this).val()) {
            barc = $(this).val();
            console.log($(this).val());
            var _url = '<?= base_url('operator/purchasemst/ajaxform') ?>';
            var _post = 'GET';
            var _postType = 'json';
            var _data = {};
            _data['barc'] = barc;
            $.ajax({type: _post, url: _url, dataType: _postType, data: _data,
                success: function (_returnData) {
                    if (_returnData.res == 'success') {
                        $('.ajaxbody').html(_returnData.msg);
//                        $('#refMachID').val(_returnData.msg.refMachID);
//                        $('#refMachName').val(_returnData.msg.MachCode + ' | ' + _returnData.msg.MachName);
//                        $('#Product').val(_returnData.msg.ProductName);
//                        $('#MfgName').val(_returnData.msg.MfgName);
//                        if (_returnData.msg.Warranty == 1) {
//                            $('#refProviderID').select2('destroy').val(_returnData.msg.ProviderID);
//                            $('#refProviderID').children('option[value=' + _returnData.msg.ProviderID + ']').siblings().prop('disabled', true);
//                            $('#refProviderID').css('width', '100%').select2();
//                            $('#QuotAmt, #Remarks').prop('readonly', true);
//                            $('#QuotAmt').prop('required', false);
//                            $('#IsWarranty').val(1);
//                        } else {
//                            $('#refProviderID').select2('destroy').val('');
//                            $('#refProviderID').children('option').prop('disabled', false);
//                            $('#refProviderID').prop('required', false).prop('disabled', true);
//                            $('#refProviderID').css('width', '100%').select2();
//                            $('#QuotAmt, #Remarks').prop('readonly', true);
//                            $('#IsWarranty').val(0);
//                            $('#QuotAmt').prop('required', false);
//                        }
                        console.log(_returnData.msg);
                    } else {
//                        $('#refMachID').val('');
//                        $('#refMachName').val('');
//                        $('#Product').val('');
//                        $('#MfgName').val('');
//                        $('#refProviderID').select2('destroy').val('');
//                        $('#refProviderID').children('option').prop('disabled', false);
//                        $('#refProviderID').prop('disabled', true);
//                        $('#refProviderID').css('width', '100%').select2();
//                        $('#QuotAmt, #Remarks').prop('readonly', false);
//                        $('#QuotAmt').prop('required', true);
                        if (_returnData.res == 'alert') {
                            alert(_returnData.msg);
                            $('#BarcodeNo').val('');
                        }
						if (_returnData.res == 'error') {
                            alert(_returnData.msg);
                            $('#BarcodeNo').val('');
                        }
                        console.log('Try again');
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('Connection Error, Try Again');
                    setTimeout(function(){
                        location = ''
                    },10);
              }
            });
        }
    });
</script>

