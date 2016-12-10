<?php
//if($jobmst->IsWarranty == 1){
//    $providerStatus = FALSE;
//}else{
$providerStatus = true;
if (count($quotationlist) > 0) {
    $providerStatus = FALSE;
    if ($jobmst->Status == 'Quotation Applied') {
        $providerStatus = true;
    }
}
//}

$BarcodeNo = array(
    'name' => 'BarcodeNo',
    'id' => 'BarcodeNo',
    'value' => isset($jobmst) ? $jobmst->BarcodeNo : '',
    'class' => 'form-control ',
    'readonly' => true
);

$QuotAmt = array(
    'name' => 'QuotAmt',
    'id' => 'QuotAmt',
    'value' => isset($jobmst) ? $jobmst->QuotAmt : '',
    'class' => 'form-control numbersonly',
);
if ($jobmst->IsWarranty == 1 || $providerStatus) {
    $dis = $QuotAmt['readonly'] = true;
} else {
    $QuotAmt['required'] = true;
    $dis = $readonly = false;
}
$Remarks = array(
    'name' => 'Remarks',
    'id' => 'Remarks',
    'value' => isset($jobmst) ? $jobmst->Remarks : '',
    'class' => 'form-control '
);
$Issue = array(
    'name' => 'Issue',
    'id' => 'Issue',
    'value' => isset($jobmst) ? $jobmst->Issue : '',
    'class' => 'form-control ',
    'required' => TRUE
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
        <div class="contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($action == 'edit') { ?> 
                        <h2 class="text-primary">Edit Job</h2>
                    <?php } else {
                        ?>
                        <h2 class="text-primary">Create Job</h2>
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
                        $hidden = array('JobID' => $jobmst->JobID);
                        echo form_open_multipart("operator/jobmst/edit/$jobmst->JobID", 'id="addadminfrm" class="form"', $hidden);
                    } else {
                        echo form_open_multipart('operator/jobmst/add', 'id="addadminfrm" class="form"');
                    }
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($BarcodeNo); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Barcode : ', 'BarcodeNo', array('class' => 'required')); ?>
                                        <?php echo form_error('BarcodeNo', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array(
                                            'name' => 'refMachID',
                                            'id' => 'refMachID',
                                            'value' => isset($jobmst) ? $jobmst->refMachID : '',
                                            'class' => 'form-control ',
                                            'type' => 'hidden'
                                        ));
                                        ?>
                                        <?php
                                        echo form_input(array(
                                            'name' => 'MachName',
                                            'id' => 'MachName',
                                            'value' => isset($jobmst) ? $jobmst->MachName : '',
                                            'class' => 'form-control ',
                                            'readonly' => true
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span>Machine : ', 'MachName'); ?>
                                        <?php echo form_error('MachName', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php
                                        if ($jobmst->SubPartName == NULL) {
                                            $jobmst->Product = $jobmst->PartName;
                                        } else {
                                            $jobmst->Product = $jobmst->SubPartName;
                                        }
                                        echo form_input(array(
                                            'name' => 'Product',
                                            'id' => 'Product',
                                            'value' => isset($jobmst) ? $jobmst->Product : '',
                                            'class' => 'form-control ',
                                            'readonly' => true
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span>Part : ', 'Product'); ?>
                                        <?php echo form_error('Product', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array(
                                            'name' => 'MfgName',
                                            'id' => 'MfgName',
                                            'value' => isset($jobmst) ? $jobmst->MfgName : '',
                                            'class' => 'form-control ',
                                            'readonly' => true
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span>Mfg Company : ', 'MfgName'); ?>
                                        <?php echo form_error('MfgName', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="refProviderID" id="refProviderID" class="form-control select2-list" data-placeholder="--Select Service Provider--" >
                                            <?php
                                            if (!empty($provider)) {

                                                foreach ($provider as $key => $value) {
                                                    $sel = '';
                                                    $disable = '';
                                                    if ($providerStatus) {
                                                        $disable = 'disabled=""';
                                                    }
                                                    if (isset($jobmst) && $jobmst->refProviderID == $value->SerProvID) {
                                                        $sel = 'selected=""';
                                                        $disable = '';
                                                    }
                                                    echo '<option value="' . $value->SerProvID . '" ' . $sel . ' ' . $disable . '>' . $value->Name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_label('<span style="color: red">*</span>Service Provider : ', 'refProviderID'); ?>
                                        <?php echo form_error('refProviderID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="refEmpID" id="refEmpID" class="form-control select2-list" data-placeholder="--Select Employee--" required="" title="This field Required">
                                            <?php
                                            if (!empty($employee)) {
                                                foreach ($employee as $key => $value) {
                                                    $sel = '';
                                                    if (isset($jobmst) && $jobmst->refEmpID == $value->EmpID) {
                                                        $sel = 'selected=""';
                                                    }
                                                    echo '<option value="' . $value->EmpID . '" ' . $sel . '>' . $value->EmpCode . ' | ' . $value->EmpName . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_label('<span style="color: red">*</span>Request By: ', 'refEmpID'); ?>
                                        <?php echo form_error('refEmpID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <?php echo form_textarea($Issue); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Issue : ', 'Issue', array('class' => 'required')); ?>
                                        <?php echo form_error('Issue', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($QuotAmt); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Quotation : ', 'QuotAmt', array('class' => 'required')); ?>
                                        <?php echo form_error('QuotAmt', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($Remarks); ?>
                                        <?php echo form_label('Remarks : ', 'Remarks'); ?>
                                        <?php echo form_error('Remarks', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-actionbar">
                                <div class="card-actionbar-row">
                                    <!--<a href="javascript:void(0);" class="btn btn-info">Cancel</a>-->
                                    <a href="javascript:void(0);" class="btn btn-warning del" >Delete</a>
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
<div id="myDelModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <?php echo form_open_multipart('operator/jobmst/delete', 'id="del-form" class="form"'); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Enter Remarks For Delete ::</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="JobID" id="JobID" value="<?= $jobmst->JobID ?>" />
                <div class="form-group">
                    <?php
                    echo form_input(array(
                        'name' => 'Remarks',
                        'id' => 'Remarks',
                        'value' => isset($jobmst) ? $jobmst->Remarks : '',
                        'class' => 'form-control '
                    ));
                    ?>
                    <?php echo form_label('Remarks : ', 'Remarks'); ?>
                    <?php echo form_error('Remarks', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    Delete
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script src="<?= base_url(); ?>assets/js/bootbox.min.js"></script>
<script>
    $(document).ready(function () {
        $("#addadminfrm").validate({ignore:''});
    });
    $(document).on('click', '.del', function () {
        $('#myDelModal').modal('show');
    });
    $('#del-form').validate({
        submitHandler: function (form) {
            bootbox.confirm("Are you sure to delete Job?", function (result) {
                if (result)
                {
                    form.submit();
                }else{
                    $('#myDelModal').modal('hide');
                    $('.bootbox-confirm').modal('hide');
                }
                $(".gradeX").removeClass("selected");
                return false;
            });
        }
    });
</script>

