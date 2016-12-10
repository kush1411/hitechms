<?php
$name = array(
    'name' => 'SerialNo',
    'id' => 'SerialNo',
    'value' => '',
    'class' => 'form-control',
    'required' => 'required'
);
$BarcodeNo = array(
    'name' => 'BarcodeNo',
    'id' => 'BarcodeNo',
    'value' => isset($BarcodeNo) ? $BarcodeNo : '',
    'class' => 'form-control ',
    'required' => true,
    'readonly' => true
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
                        if (isset($machineparts) && $machineparts->refMfgID == $value->MfgID) {
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
<!--    <div class="col-sm-6">
        <div class="form-group">
            <select name="refProviderID" id="refProviderID" class="form-control select2-list" data-placeholder="--Select Machine Mfg--">
                <option value="">--Select Provider--</option>
                <?php
//                if (!empty($provider)) {
//                    foreach ($provider as $key => $value) {
//                        echo '<option value="' . $value->SerProvID . '" >' . $value->Name . '</option>';
//                    }
//                }
                ?>
            </select>
            <?php //echo form_label('<span style="color: red">*</span> Purchase From : ', 'refProviderID'); ?>
            <?php //echo form_error('refProviderID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
        </div>
    </div>-->
</div>
<!--<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <?php //echo form_input($name); ?>
            <?php //echo form_label('<span style="color: red">*</span> Serial No : ', 'SerialNo'); ?>
            <?php //echo form_error('SerialNo', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
        </div>
    </div>
</div>-->
<!--<div class="row">
    <div class="col-md-3">
        <div class="form-group control-width-normal">
            <div class="input-group date date-format2">
                <div class="input-group-content">
                    <?php
//                    echo form_input(array('name' => 'WarrantyFrom',
//                        'id' => 'WarrantyFrom',
//                        'class' => 'form-control',
//                        'value' => date('d/m/Y'),
//                        'required' => 'required'
//                    ));
                    ?>
                    <?php //echo form_label('<span style="color: red">*</span>Warranty From', 'WarrantyFrom'); ?>
                    <?php
                    //echo form_error('WarrantyFrom', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                    ?>
                </div>
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group control-width-normal">
            <div class="input-group date date-format3">
                <div class="input-group-content">
                    <?php
//                    echo form_input(array('name' => 'WarrantyTo',
//                        'id' => 'WarrantyTo',
//                        'class' => 'form-control',
//                        'value' => '',
//                        'required' => 'required'
//                    ));
                    ?>
                    <?php //echo form_label('<span style="color: red">*</span>Warranty To', 'WarrantyTo'); ?>
                    <?php
                    //echo form_error('WarrantyTo', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                    ?>
                </div>
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?php
//            echo form_input(array('name' => 'Remarks',
//                'id' => 'Remarks',
//                'class' => 'form-control',
//                'value' => (isset($machineparts) && $machineparts->Remarks ? ($machineparts->Remarks) : ''),
//            ));
            ?>
            <?php //echo form_label('Remarks', 'Remarks'); ?>
            <?php
            //echo form_error('Remarks', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
            ?>
        </div>
    </div>
</div>-->


<script>
    $('.date-format2').datepicker({autoclose: true, todayHighlight: true, format: "dd/mm/yyyy", endDate: "<?= date('d/m/Y') ?>"});
    $('.date-format3').datepicker({autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"});
    $('#refMfgID, #refProviderID').select2();
    $(function () {
        $("#addadminfrm").validate({
            // Rules for form validation
            rules: {
                refMachPartID: {required: true},
                refMachSubPartID: {required: true},
                refMfgID: {required: true},
                SerialNo: {
                    required: true,
                    remote: "<?= base_url('machine/checkserialparts/'); ?>"
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