<?php
//echo '<pre>'; print_r($type); die;
$code = array(
    'name' => 'MachCode',
    'id' => 'MachCode',
    'value' => isset($machine) ? $machine->MachCode : '',
    'class' => 'form-control mini fl ',
    'required' => 'required'
);
$name = array(
    'name' => 'MachName',
    'id' => 'MachName',
    'value' => isset($machine) ? $machine->MachName : '',
    'class' => 'form-control mini fl ',
    'required' => 'required'
);
$submit = array('name' => 'submit',
    'id' => 'submit',
    'value' => 'Submit',
    'class' => 'btn btn-danger'
);
$activeRadio = array(
    'name' => 'MachStatus',
    'id' => 'MachStatus',
    'value' => '1',
    'class' => 'fancy-radio',
    'checked' => isset($machine) && $machine->MachStatus == 1 ? TRUE : !isset($machine) ? TRUE : '',
);
$deactiveRadio = array(
    'name' => 'EmpStatus',
    'id' => 'EmpStatus',
    'value' => '0',
    'class' => 'fancy-radio',
    'checked' => isset($machine) && $machine->MachStatus == 0 ? TRUE : '',
);
?>

<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="section-body contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($action == 'edit') { ?> 
                        <h2 class="text-primary">Edit Machine</h2>
                    <?php } else {
                        ?>
                        <h2 class="text-primary">Create Machine</h2>
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
                        $hidden = array('MachID' => $machine->MachID);
                        echo form_open_multipart("machine/edit/$machine->MachID", 'id="addadminfrm" class="form"', $hidden);
                    } else {
                        echo form_open_multipart('machine/add', 'id="addadminfrm" class="form"');
                    }
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="refCatID" id="refCatID" class="form-control select2-list" data-placeholder="--Select Category--" required="">
                                            <option value="">--Select Category--</option>
                                            <?php
                                            if (!empty($category)) {
                                                foreach ($category as $key => $value) {
                                                    $sel = '';
                                                    if (isset($machine) && $machine->refCatID == $value->CatID) {
                                                        $sel = 'selected=""';
                                                    }
                                                    echo '<option value="' . $value->CatID . '" ' . $sel . '>' . $value->CatName . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_label('<span style="color: red">*</span>Category : ', 'refCatID'); ?>
                                        <?php echo form_error('refCatID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="refTypeID" id="refTypeID" class="form-control select2-list" data-placeholder="--Select Machine Type--" required="">
                                            <option value="">--Select Machine Type--</option>
                                            <?php
                                            if (!empty($type)) {
                                                foreach ($type as $key => $value) {
                                                    $sel = '';
                                                    if (isset($machine) && $machine->refTypeID == $value->TypeID) {
                                                        $sel = 'selected=""';
                                                    }
                                                    echo '<option value="' . $value->TypeID . '" ' . $sel . '>' . $value->TypeName . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_label('<span style="color: red">*</span>Machine Type : ', 'refTypeID'); ?>
                                        <?php echo form_error('refTypeID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="refMfgID" id="refMfgID" class="form-control select2-list" data-placeholder="--Select Machine Manufacturer--" required="">
                                            <option value="">--Select Machine Manufacturer--</option>
                                            <?php
                                            if (!empty($mfg)) {
                                                foreach ($mfg as $key => $value) {
                                                    $sel = '';
                                                    if (isset($machine) && $machine->refMfgID == $value->MfgID) {
                                                        $sel = 'selected=""';
                                                    }
                                                    echo '<option value="' . $value->MfgID . '" ' . $sel . '>' . $value->MfgName . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_label('<span style="color: red">*</span>Machine Manufacturer : ', 'refMfgID'); ?>
                                        <?php echo form_error('refMfgID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="refLocID" id="refLocID" class="form-control select2-list" data-placeholder="--Select Location--" required="">
                                            <option value="">--Select Location--</option>
                                            <?php
                                            if (!empty($location)) {
                                                foreach ($location as $key => $value) {
                                                    $sel = '';
                                                    if (isset($machine) && $machine->refLocID == $value->LocID) {
                                                        $sel = 'selected=""';
                                                    }
                                                    echo '<option value="' . $value->LocID . '" ' . $sel . '>' . $value->Code . ' - ' . $value->Name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_label('<span style="color: red">*</span>Location : ', 'refLocID'); ?>
                                        <?php echo form_error('refLocID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($code); ?>
                                        <?php echo form_label('<span style="color: red">*</span> Code : ', 'MachCode'); ?>
                                        <?php echo form_error('MachCode', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($name); ?>
                                        <?php echo form_label('<span style="color: red">*</span> Name : ', 'MachName'); ?>
                                        <?php echo form_error('MachName', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'MachDesc',
                                            'id' => 'MachDesc',
                                            'class' => 'form-control',
                                            'value' => (isset($machine) && $machine->MachDesc ? ($machine->MachDesc) : ''),
                                            'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> Description', 'MachDesc'); ?>
                                        <?php echo form_error('MachDesc', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'MachBillNo',
                                            'id' => 'MachBillNo',
                                            'class' => 'form-control',
                                            'value' => (isset($machine) && $machine->MachBillNo ? ($machine->MachBillNo) : ''),
                                            'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> Bill No', 'MachBillNo'); ?>
                                        <?php echo form_error('MachBillNo', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group control-width-normal">
                                        <div class="input-group date" id="demo-date-format">
                                            <div class="input-group-content">
                                                <?php
                                                echo form_input(array('name' => 'MachPurDate',
                                                    'id' => 'MachPurDate',
                                                    'class' => 'form-control',
                                                    'value' => (isset($machine) && $machine->MachPurDate ? (date('d/m/Y', strtotime($machine->MachPurDate))) : ''),
                                                    'required' => 'required'
                                                ));
                                                ?>
                                                <?php echo form_label('<span style="color: red">*</span> Purchase Date', 'MachPurDate'); ?>
                                                <?php
                                                echo form_error('MachPurDate', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                                ?>
                                            </div>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'MachPurAmt',
                                            'id' => 'MachPurAmt',
                                            'class' => 'form-control',
                                            'value' => (isset($machine) && $machine->MachPurAmt ? ($machine->MachPurAmt) : ''),
                                                //'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('Purchase Amount', 'MachPurAmt'); ?>
                                        <?php
                                        echo form_error('MachPurAmt', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'MachCurrAmt',
                                            'id' => 'MachCurrAmt',
                                            'class' => 'form-control',
                                            'value' => (isset($machine) && $machine->MachCurrAmt ? ($machine->MachCurrAmt) : ''),
                                                //'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('Actual Amount', 'MachCurrAmt'); ?>
                                        <?php
                                        echo form_error('MachCurrAmt', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!--                            <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <div>
                                                                        <label class="radio-inline radio-styled">
                            <?php //echo form_radio($activeRadio); ?><span>Active</span>
                                                                        </label>
                                                                        <label class="radio-inline radio-styled">
                            <?php //echo form_radio($deactiveRadio); ?><span>Deactivate</span>
                                                                        </label>
                                                                    </div>
                            <?php //echo form_label('Status : ', 'MachStatus'); ?>
                            <?php //echo form_error('MachStatus', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                                                </div>
                                                            </div>
                                                        </div>-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'MachSerialNo',
                                            'id' => 'MachSerialNo',
                                            'class' => 'form-control',
                                            'value' => (isset($machine) && $machine->MachSerialNo ? ($machine->MachSerialNo) : ''),
                                            'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> Machine Serial Number', 'MachSerialNo'); ?>
                                        <?php
                                        echo form_error('MachSerialNo', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'MachRemarks',
                                            'id' => 'MachRemarks',
                                            'class' => 'form-control',
                                            'value' => (isset($machine) && $machine->MachRemarks ? ($machine->MachRemarks) : ''),
                                        ));
                                        ?>
                                        <?php echo form_label('Remarks', 'MachRemarks'); ?>
                                        <?php
                                        echo form_error('MachRemarks', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group control-width-normal">
                                        <div class="input-group date date-format">
                                            <div class="input-group-content">
                                                <?php
                                                echo form_input(array('name' => 'MachWarrantyFrom',
                                                    'id' => 'MachWarrantyFrom',
                                                    'class' => 'form-control',
                                                    'value' => (isset($machine) && $machine->MachWarrantyFrom != '0000-00-00' ? (date('d/m/Y', strtotime($machine->MachWarrantyFrom))) : ''),
                                                    'required' => 'required'
                                                ));
                                                ?>
                                                <?php echo form_label('Warranty From', 'MachWarrantyFrom'); ?>
                                                <?php
                                                echo form_error('MachWarrantyFrom', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                                ?>
                                            </div>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group control-width-normal">
                                        <div class="input-group date date-format">
                                            <div class="input-group-content">
                                                <?php
                                                echo form_input(array('name' => 'MachWarrantyTo',
                                                    'id' => 'MachWarrantyTo',
                                                    'class' => 'form-control',
                                                    'value' => (isset($machine) && $machine->MachWarrantyTo != '0000-00-00' ? (date('d/m/Y', strtotime($machine->MachWarrantyTo))) : ''),
                                                    'required' => 'required'
                                                ));
                                                ?>
                                                <?php echo form_label('Warranty To', 'MachWarrantyTo'); ?>
                                                <?php
                                                echo form_error('MachWarrantyTo', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                                ?>
                                            </div>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
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
    $(document).on('change', '#refCatID', function () {
        var _id = $(this).val();
        var _url = '<?= base_url() ?>frontend/machine/gettype';
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
                    $('select#refTypeID').html(_response.msg).select2('destroy').select2();
                    $('select#refMfgID').html('<option value="">--Select Machine Manufacturer--</option>').select2('destroy').select2();
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

    $(document).on('change', '#refTypeID', function () {
        var _id = $(this).val();
        var _url = '<?= base_url() ?>frontend/machine/getmfg';
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
        return false;
    });
</script>
<?php if ($action == 'edit') { ?>
    <script>
        $(document).ready(function () {
            $('.date-format').datepicker({autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"});
            $("#addadminfrm").validate({
                // Rules for form validation
                rules: {
                    MachCode: {
                        required: true,
                        remote: "<?= base_url('machine/check/' . $machine->MachID); ?>"
                    },
                    refCatID: {required: true},
                    refTypeID: {required: true},
                    refMfgID: {required: true},
                    refLocID: {required: true},
                    MachName: {required: true},
                    MachDesc: {required: true},
                    MachBillNo: {required: true},
                    MachPurDate: {required: true},
                    MachSerialNo: {
                        required: true,
                        remote: "<?= base_url('machine/checkserial/' . $machine->MachID); ?>"
                    },
                    MachWarrantyTo:{
                        greaterThan : '#MachWarrantyFrom'
                    }
                },
                // Messages for form validation
                messages: {
                    MachCode: {
                        required: 'Please Enter Machine Code',
                        remote: 'Machine Code Already Available, Try Another'
                    },
                    refCatID: {required: 'Machine Category Required'},
                    refTypeID: {required: 'Machine Type Required'},
                    refMfgID: {required: 'Machine Manufacturer Required'},
                    refLocID: {required: 'Machine Location Required'},
                    MachName: {required: 'Machine Name Required'},
                    MachDesc: {required: 'Machine Description Required'},
                    MachBillNo: {required: 'Machine Bill Number Required'},
                    MachPurDate: {required: 'Machine Purchase Date Required'},
                    MachSerialNo: {
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
            $('.date-format').datepicker({autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"});
            $("#addadminfrm").validate({
                // Rules for form validation
                rules: {
                    MachCode: {
                        required: true,
                        remote: "<?= base_url('machine/check/'); ?>"
                    },
                    refCatID: {required: true},
                    refTypeID: {required: true},
                    refMfgID: {required: true},
                    refLocID: {required: true},
                    MachName: {required: true},
                    MachDesc: {required: true},
                    MachBillNo: {required: true},
                    MachPurDate: {required: true},
                    MachSerialNo: {
                        required: true,
                        remote: "<?= base_url('machine/checkserial/'); ?>"
                    },
                    MachWarrantyTo:{
                        greaterThan : '#MachWarrantyFrom'
                    }
                },
                // Messages for form validation
                messages: {
                    MachCode: {
                        required: 'Please Enter Machine Code',
                        remote: 'Machine Code Already Available, Try Another'
                    },
                    refCatID: {required: 'Machine Category Required'},
                    refTypeID: {required: 'Machine Type Required'},
                    refMfgID: {required: 'Machine Manufacturer Required'},
                    refLocID: {required: 'Machine Location Required'},
                    MachName: {required: 'Machine Name Required'},
                    MachDesc: {required: 'Machine Description Required'},
                    MachBillNo: {required: 'Machine Bill Number Required'},
                    MachPurDate: {required: 'Machine Purchase Date Required'},
                    MachSerialNo: {
                        required: 'Please Enter Serial Number',
                        remote: 'Serial Number Already Available, Try Another'
                    }
                }
            });
        });
    </script>
<?php } ?>