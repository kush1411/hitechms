<?php
//if($purchasemst->IsWarranty == 1){
//    $providerStatus = FALSE;
//}else{
$providerStatus = true;
if (count($quotationlist) > 0) {
    $providerStatus = FALSE;
    if ($purchasemst->Status == 'Quotation Applied') {
        $providerStatus = true;
    }
}
//}

$PurAmt = array(
    'name' => 'PurAmt',
    'id' => 'PurAmt',
    'value' => isset($purchasemst) ? $purchasemst->PurAmt : '',
    'class' => 'form-control numbersonly',
);
if ($providerStatus) {
    $dis = $PurAmt['readonly'] = true;
} else {
    $PurAmt['required'] = true;
    $dis = $readonly = false;
}
$Remarks = array(
    'name' => 'Remarks',
    'id' => 'Remarks',
    'value' => isset($purchasemst) ? $purchasemst->Remarks : '',
    'class' => 'form-control '
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
                    <h2 class="text-primary">Edit Purchase</h2>
                </div>
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <div class="col-lg-12">
                    <?php
                        $hidden = array('POID' => $purchasemst->POID);
                        echo form_open_multipart("operator/purchasejob/edit/$purchasemst->POID", 'id="addadminfrm" class="form"', $hidden);
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $BarcodeNo = array(
                                'name' => 'BarcodeNo',
                                'id' => 'BarcodeNo',
                                'value' => isset($BarcodeNo) ? $BarcodeNo : '',
                                'class' => 'form-control ',
                                'required' => true,
                                'readonly' => true
                            );
                            $submit = array('name' => 'submit',
                                'id' => 'submit',
                                'value' => 'Submit',
                                'class' => 'btn btn-danger'
                            );
                            ?>
                            <h4 class="subh4">Old Part Details :</h4>
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
                                            'value' => isset($machineparts) ? $machineparts->refMachID : '',
                                            'class' => 'form-control ',
                                            'type' => 'hidden'
                                        ));
                                        echo form_input(array(
                                            'name' => 'refJobID',
                                            'id' => 'refJobID',
                                            'value' => isset($JobID) ? $JobID : '',
                                            'class' => 'form-control ',
                                            'type' => 'hidden'
                                        ));
                                        ?>
                                        <?php
                                        echo form_input(array(
                                            'name' => 'refMachName',
                                            'id' => 'refMachName',
                                            'value' => isset($machineparts) ? $machineparts->MachName : '',
                                            'class' => 'form-control ',
                                            'readonly' => true
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span>Machine : ', 'refMachID'); ?>
                                        <?php echo form_error('refMachID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array(
                                            'name' => 'Product',
                                            'id' => 'Product',
                                            'value' => isset($machineparts) ? $machineparts->ProductName : '',
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
                                            'value' => isset($machineparts) ? $machineparts->MfgName : '',
                                            'class' => 'form-control ',
                                            'readonly' => true
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span>Mfg Company : ', 'MfgName'); ?>
                                        <?php echo form_error('MfgName', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <h4 class="subh4">New Purchase Details :</h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php
                                        if (!empty($part)) {
                                            foreach ($part as $key => $value) {
                                                if (isset($machineparts) && $machineparts->refMachPartID == $value->MachPartID) {
                                                    ?>
                                                    <input type="text" value="<?= $value->PartName ?>" readonly="" class="form-control">
                                                    <input type="hidden" name="refMachPartID" id="refMachPartID" class="form-control" value="<?= $value->MachPartID ?>">
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span>Machine Part : ', 'refMachPartID'); ?>
                                        <?php echo form_error('refMachPartID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php
                                        if (!empty($subpart)) {
                                            foreach ($subpart as $key => $value) {
                                                if (isset($machineparts) && $machineparts->refMachSubPartID == $value->MachSubPartID) {
                                                    ?>
                                                    <input type="text" value="<?= $value->SubPartName ?>" readonly="" class="form-control">
                                                    <input type="hidden" name="refMachSubPartID" id="refMachSubPartID" class="form-control" value="<?= $value->MachSubPartID ?>">
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                        <?php echo form_label('Machine SubPart : ', 'refMachSubPartID'); ?>
                                        <?php echo form_error('refMachSubPartID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="refMfgID" id="refMfgID" class="form-control select2-list" data-placeholder="--Select Machine Mfg--">
                                            <option value="">--Select Machine Mfg--</option>
                                            <?php
                                            if (!empty($mfg)) {
                                                foreach ($mfg as $key => $value) {
                                                    $sel = '';
                                                    if (isset($purchasemst) && $purchasemst->refMfgID == $value->MfgID) {
                                                        $sel = 'selected=""';
                                                    }
                                                    echo '<option value="' . $value->MfgID . '" ' . $sel . '>' . $value->MfgName . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_label('<span style="color: red">*</span> Machine Manufacturer : ', 'refMfgID'); ?>
                                        <?php echo form_error('refMfgID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="refProviderID" id="refProviderID" class="form-control select2-list" data-placeholder="--Select Machine Mfg--">
                                            <option value="">--Select Provider--</option>
                                            <?php
                                            if (!empty($provider)) {
                                                foreach ($provider as $key => $value) {
                                                    $sel = '';
                                                    $disable = '';
                                                    if ($providerStatus) {
                                                        $disable = 'disabled=""';
                                                    }
                                                    if (isset($purchasemst) && $purchasemst->refProviderID == $value->SerProvID) {
                                                        $sel = 'selected=""';
                                                        $disable = '';
                                                    }
                                                    echo '<option value="' . $value->SerProvID . '" ' . $sel . ' ' . $disable . ' >' . $value->Name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_label('<span style="color: red">*</span> Purchase From : ', 'refProviderID'); ?>
                                        <?php echo form_error('refProviderID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($PurAmt); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Quotation : ', 'PurAmt', array('class' => 'required')); ?>
                                        <?php echo form_error('PurAmt', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
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
<script src="<?= base_url(); ?>assets/js/bootbox.min.js"></script>
<script>
    $(document).ready(function () {
        $("#addadminfrm").validate();
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
                } else {
                    $('#myDelModal').modal('hide');
                    $('.bootbox-confirm').modal('hide');
                }
                $(".gradeX").removeClass("selected");
                return false;
            });
        }
    });
</script>

