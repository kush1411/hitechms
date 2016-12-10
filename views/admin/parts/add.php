<?php
$name = array(
    'name' => 'PartName',
    'id' => 'PartName',
    'value' => isset($parts) ? $parts->PartName : '',
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
    'checked' => isset($parts) && $parts->Status == 1 ? TRUE : (!isset($parts) ? TRUE : ''),
);
$deactiveRadio = array(
    'name' => 'Status',
    'id' => 'Status',
    'value' => '0',
    'class' => 'fancy-radio',
    'checked' => isset($parts) && $parts->Status == 0 ? TRUE : '',
);
?>

<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="section-body contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($action == 'edit') { ?> 
                        <h2 class="text-primary">Edit Parts</h2>
                    <?php } else {
                        ?>
                        <h2 class="text-primary">Create Parts</h2>
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
                        $hidden = array('MachPartID' => $parts->MachPartID);
                        echo form_open_multipart("admin/parts/edit/$parts->MachPartID", 'id="addadminfrm" class="form"', $hidden);
                    } else {
                        echo form_open_multipart('admin/parts/add', 'id="addadminfrm" class="form"');
                    }
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <select name="refCatID" id="refCatID" class="form-control select2-list" data-placeholder="--Select Category--" >
                                            <option value="">--Select Category--</option>
                                            <?php
                                            if (!empty($category)) {
                                                foreach ($category as $key => $value) {
                                                    $sel = '';
                                                    if (isset($parts) && $parts->refCatID == $value->CatID) {
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
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <select name="refTypeID" id="refTypeID" class="form-control select2-list" data-placeholder="--Select Type--" >
                                            <option value="">--Select Type--</option>
                                            <?php
                                            if (!empty($type)) {
                                                foreach ($type as $key => $value) {
                                                    $sel = '';
                                                    if (isset($parts) && $parts->refTypeID == $value->TypeID) {
                                                        $sel = 'selected=""';
                                                    }
                                                    echo '<option value="' . $value->TypeID . '" ' . $sel . '>' . $value->TypeName . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_label('<span style="color: red">*</span>Type : ', 'refTypeID'); ?>
                                        <?php echo form_error('refTypeID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <?php echo form_input($name); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Name : ', 'PartName'); ?>
                                        <?php echo form_error('PartName', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <select name="refMfgID[]" id="refMfgID" class="form-control select2-list" data-placeholder="--Select Mfg Company--" multiple="">

                                            <?php
                                            if (!empty($mfg)) {
                                                foreach ($mfg as $key => $value) {
                                                    $sel = '';
                                                    if (isset($parts) && in_array($value->MfgID, $parts->refMfgID)) {
                                                        $sel = 'selected=""';
                                                    }
                                                    echo '<option value="' . $value->MfgID . '" ' . $sel . '>' . $value->MfgName . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_label('<span style="color: red">*</span>Mfg Company : ', 'refMfgID'); ?>
                                        <?php echo form_error('refMfgID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                                        <?php echo form_error('Status', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
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
        var _url = '<?= base_url() ?>admin/parts/gettype';
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
                    return false;
                } else {
                    alert(_response.msg);
                    return false;
                }
            },
            data: _data,
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('Connection Error, Try Again');
                    setTimeout(function(){
                        location = ''
                    },10);
              }
        });
        return false;
    });
</script>
<?php if ($action == 'edit') { ?>
    <script>
        var v = null;
        $(document).ready(function () {
             v = $("#addadminfrm").validate({
                // Rules for form validation
                ignore: [],
                rules: {
                    PartName: {
                        required: true,
                        remote: {
                            url : "<?= base_url('admin/parts/check/' . $type->MachPartID); ?>",
                            data: {
                                refTypeID: function() {
                                    return $('#refTypeID').val();
                                }
                            }
                        }
                    },
                    refCatID: {required: true},
                    refMfgID: {required: true},
                    refTypeID: {required: true}
                },
                // Messages for form validation
                messages: {
                    PartName: {
                        required: 'Please Enter Part Name',
                        remote: 'Part Name Already Available, Try Another'
                    },
                    refCatID: {required: 'Category Name Required'},
                    refMfgID: {required: 'Mfg Name Required'},
                    refTypeID: {required: 'Type Required'}
                },
                // Do not change code below
                //errorPlacement : function(error, element) {
                //	error.insertAfter(element.parent());
                //}
            });
        });
        $(document).on('change','#refTypeID',function(){
            if($("#PartName").val() != ''){
                $("#PartName").removeData("previousValue"); //clear cache when changing group
                v.element('#PartName'); 
            }
        });
    </script>
<?php } else { ?>
    <script>
        var v = null;
        $(document).ready(function () {
            v = $("#addadminfrm").validate({
                // Rules for form validation
                ignore: [],
                rules: {
                    PartName: {
                        required: true,
                        remote:{
                            url : "<?= base_url('admin/parts/check'); ?>",
                            data: {
                                refTypeID: function() {
                                    return $('#refTypeID').val();
                                }
                            }
                        }
                    },
                    refCatID: {required: true},
                    refMfgID: {required: true},
                    refTypeID: {required: true}
                },
                // Messages for form validation
                messages: {
                    PartName: {
                        required: 'Please Enter Part Name',
                        remote: 'Part Name Already Available, Try Another'
                    },
                    refCatID: {required: 'Category Name Required'},
                    refMfgID: {required: 'Mfg Name Required'},
                    refTypeID: {required: 'Type Required'}
                },
                // Do not change code below
                //errorPlacement : function(error, element) {
                //	error.insertAfter(element.parent());
                //}
            });
        });
        $(document).on('change','#refTypeID',function(){
            if($("#PartName").val() != ''){
                $("#PartName").removeData("previousValue"); //clear cache when changing group
                v.element('#PartName'); 
            }
        });
    </script>
<?php } ?>

