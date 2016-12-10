<?php
$name = array(
    'name' => 'TypeName',
    'id' => 'TypeName',
    'value' => isset($type) ? $type->TypeName : '',
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
    'checked' => isset($type) && $type->Status == 1 ? TRUE : (!isset($type) ? TRUE : ''),
);
$deactiveRadio = array(
    'name' => 'Status',
    'id' => 'Status',
    'value' => '0',
    'class' => 'fancy-radio',
    'checked' => isset($type) && $type->Status == 0 ? TRUE : '',
);
?>

<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="section-body contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($action == 'edit') { ?> 
                        <h2 class="text-primary">Edit Type</h2>
                    <?php } else {
                        ?>
                        <h2 class="text-primary">Create Type</h2>
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
                        $hidden = array('TypeID' => $type->TypeID);
                        echo form_open_multipart("admin/type/edit/$type->TypeID", 'id="addadminfrm" class="form"', $hidden);
                    } else {
                        echo form_open_multipart('admin/type/add', 'id="addadminfrm" class="form"');
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
                                                    if (isset($type) && $type->refCatID == $value->CatID) {
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
                                        <?php echo form_input($name); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Name : ', 'TypeName'); ?>
                                        <?php echo form_error('TypeName', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <select name="refMfgID[]" id="refMfgID" multiple="" class="form-control select2-list" data-placeholder="--Select Mfg Company--">
                                            <?php
                                            if (!empty($mfg)) {
                                                foreach ($mfg as $key => $value) {
                                                    $sel = '';
                                                    if (isset($type) && in_array($value->MfgID, $type->refMfgID)) {
                                                        $sel = 'selected=""';
                                                    }
                                                    echo '<option value="' . $value->MfgID . '" ' . $sel . '>' . $value->MfgName . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_label('<span style="color: red">*</span>Mfg Company : ', 'refMfgID'); ?>
                                        <?php echo form_error('refMfgID[]', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
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

<?php if ($action == 'edit') { ?>
    <script>
        $(document).ready(function () {
            $("#addadminfrm").validate({
                // Rules for form validation
                ignore: [],
                rules: {
                    TypeName: {
                        required: true,
                        remote: {
                            url: "<?= base_url('admin/type/check/' . $type->TypeID); ?>",
                            type: "get",
                            data: {
                                refCatID: function () {
                                    return $('#refCatID').val();
                                }
                            }
                        }
                    },
                    refCatID: {required: true},
                    'refMfgID[]': {required: true},
                },
                // Messages for form validation
                messages: {
                    TypeName: {
                        required: 'Please Enter Type Name',
                        remote: 'Type Name Already Available, Try Another Category OR Name'
                    },
                    refCatID: {required: 'Category Name Required'},
                    'refMfgID[]': {required: 'Mfg Name Required'}
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
                ignore: [],
                rules: {
                    TypeName: {
                        required: true,
                        remote: {
                            url: "<?= base_url('admin/type/check'); ?>",
                            type: "get",
                            data: {
                                refCatID: function () {
                                    return $('#refCatID').val();
                                }
                            }
                        }
                    },
                    refCatID: {required: true},
                    'refMfgID[]': {required: true},
                },
                // Messages for form validation
                messages: {
                    TypeName: {
                        required: 'Please Enter Type Name',
                        remote: 'Type Name Already Available, Try Another Category OR Name'
                    },
                    refCatID: {required: 'Category Name Required'},
                    'refMfgID[]': {required: 'Mfg Name Required'}
                },
                // Do not change code below
                //errorPlacement : function(error, element) {
                //	error.insertAfter(element.parent());
                //}
            });
        });
    </script>
<?php } ?>
<script>
    $(document).on('change', '#refCatID', function () {
        $('#TypeName').val('');
    });
</script>