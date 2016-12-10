<?php
$name = array(
    'name' => 'SerialNo',
    'id' => 'SerialNo',
    'value' => isset($machineparts) ? $machineparts->SerialNo : '',
    'class' => 'form-control mini fl ',
    'required' => 'required'
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
    'checked' => isset($machineparts) && $machineparts->Status == 1 ? TRUE : !isset($machineparts) ? TRUE : '',
);
$deactiveRadio = array(
    'name' => 'Status',
    'id' => 'Status',
    'value' => '0',
    'class' => 'fancy-radio',
    'checked' => isset($machineparts) && $machineparts->Status == 0 ? TRUE : '',
);
?>

<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="section-body contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($action == 'editparts') { ?> 
                        <h1 class="text-primary">Edit Machine Part</h1>
                    <?php } else {
                        ?>
                        <h1 class="text-primary">Create Machine Part</h1>
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
                    if ($action == 'editparts') {
                        $hidden = array('CmpMachPartID' => $machineparts->CmpMachPartID);
                        echo form_open_multipart("operator/machine/editparts/" . $MachID . "/" . $machineparts->CmpMachPartID, 'id="addadminfrm" class="form"', $hidden);
                    } else {
                        echo form_open_multipart('operator/machine/addparts/' . $MachID, 'id="addadminfrm" class="form"');
                    }
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <!--                            <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <select name="refMachID" id="refMachID" class="form-control select2-list" data-placeholder="--Select Machine--" required="">
                                                                        <option value="">--Select Machine--</option>
                            <?php
//                                            if (!empty($machine)) {
//                                                foreach ($machine as $key => $value) {
//                                                    $sel = '';
//                                                    if (isset($machineparts) && $machineparts->refMachID == $value->MachID) {
//                                                        $sel = 'selected=""';
//                                                    }
//                                                    echo '<option value="' . $value->MachID . '" ' . $sel . '>' . $value->MachName . ' [' . $value->MachCode.']</option>';
//                                                }
//                                            }
                            ?>
                                                                    </select>
                            <?php //echo form_label('<span style="color: red">*</span>Machine : ', 'refMachID');  ?>
                            <?php //echo form_error('refMachID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                                                </div>
                                                            </div>
                                                        </div>-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <select name="refMachPartID" id="refMachPartID" class="form-control select2-list" data-placeholder="--Select Machine Part--" required="">
                                            <option value="">--Select Machine Part--</option>
                                            <?php
                                            if (!empty($part)) {
                                                foreach ($part as $key => $value) {
                                                    $sel = '';
                                                    if (isset($machineparts) && $machineparts->refMachPartID == $value->MachPartID) {
                                                        $sel = 'selected=""';
                                                    }
                                                    echo '<option value="' . $value->MachPartID . '" ' . $sel . '>' . $value->PartName . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_label('<span style="color: red">*</span>Machine Part : ', 'refMachPartID'); ?>
                                        <?php echo form_error('refMachPartID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <select name="refMachSubPartID" id="refMachSubPartID" class="form-control select2-list" data-placeholder="--Select Machine SubPart--">
                                            <option value="">--Select Machine SubPart--</option>
                                            <?php
                                            if (!empty($subpart)) {
                                                foreach ($subpart as $key => $value) {
                                                    $sel = '';
                                                    if (isset($machineparts) && $machineparts->refMachSubPartID == $value->MachSubPartID) {
                                                        $sel = 'selected=""';
                                                    }
                                                    echo '<option value="' . $value->MachSubPartID . '" ' . $sel . '>' . $value->SubPartName . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_label('Machine SubPart : ', 'refMachSubPartID'); ?>
                                        <?php echo form_error('refMachSubPartID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
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
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <?php echo form_input($name); ?>
                                        <?php echo form_label('<span style="color: red">*</span> Serial No : ', 'SerialNo'); ?>
                                        <?php echo form_error('SerialNo', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
<!--                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div>
                                            <label class="radio-inline radio-styled">
                                                <?php //echo form_radio($activeRadio); ?><span>Active</span>
                                            </label>
                                            <label class="radio-inline radio-styled">
                                                <?php //echo form_radio($deactiveRadio); ?><span>Deactivate</span>
                                            </label>
                                        </div>
                                        <?php //echo form_label('Status : ', 'Status'); ?>
                                        <?php //echo form_error('Status', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'Remarks',
                                            'id' => 'Remarks',
                                            'class' => 'form-control',
                                            'value' => (isset($machineparts) && $machineparts->Remarks ? ($machineparts->Remarks) : ''),
                                        ));
                                        ?>
                                        <?php echo form_label('Remarks', 'Remarks'); ?>
                                        <?php
                                        echo form_error('Remarks', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                        ?>
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
    $(document).on('change', '#refMachSubPartID', function () {
        var _id = $(this).val();

        if (_id == '') {
            var _id = $('#refMachPartID').val();
            var _url = '<?= base_url() ?>operator/machine/getSubPart';
            var _type = 'get';
            var _datatype = 'json';
            var _data = {};
            _data['id'] = _id;
            $.ajax({
                url: _url,
                type: _type,
                dataType: _datatype,
                success: function (_response) {
                    console.log(_response);
                    if (_response.res == 'success') {
                        $('select#refMachSubPartID').html(_response.msg).select2('destroy').select2();
                        $('select#refMfgID').html(_response.msg1).select2('destroy').select2();
                        return false;
                    } else {
                        alert(_response.msg);
                        return false;
                    }
                },
                data: _data,
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('Connection Error, Try Again');
              }
            });
        } else {
            var _url = '<?= base_url() ?>operator/machine/getmfgbysubpartid';
            var _type = 'get';
            var _datatype = 'json';
            var _data = {};
            _data['id'] = _id;
            $.ajax({
                url: _url,
                type: _type,
                dataType: _datatype,
                success: function (_response) {
                    console.log(_response);
                    if (_response.res == 'success') {
                        $('select#refMfgID').html(_response.msg).select2('destroy').select2();
                        return false;
                    } else {
                        alert(_response.msg);
                        return false;
                    }
                },
                data: _data,
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('Connection Error, Try Again');
              }
            });
        }
        return false;
    });

    $(document).on('change', '#refMachPartID', function () {
        var _id = $(this).val();
        var _url = '<?= base_url() ?>operator/machine/getSubPart';
        var _type = 'get';
        var _datatype = 'json';
        var _data = {};
        _data['id'] = _id;
        $.ajax({
            url: _url,
            type: _type,
            dataType: _datatype,
            success: function (_response) {
                console.log(_response);
                if (_response.res == 'success') {
                    $('select#refMachSubPartID').html(_response.msg).select2('destroy').select2();
                    $('select#refMfgID').html(_response.msg1).select2('destroy').select2();
                    return false;
                } else {
                    alert(_response.msg);
                    return false;
                }
            },
            data: _data,
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('Connection Error, Try Again');
              }
        });
        return false;
    });

</script>
<?php if ($action == 'edit') { ?>
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
                        remote: "<?= base_url('operator/machine/checkserialparts/' . $machineparts->CmpMachPartID); ?>"
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
<?php } else { ?>
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
                        remote: "<?= base_url('operator/machine/checkserialparts/'); ?>"
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
<?php } ?>