<?php
$name = array(
    'name' => 'SubPartName',
    'id' => 'SubPartName',
    'value' => isset($subparts) ? $subparts->SubPartName : '',
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
    'checked' => isset($subparts) && $subparts->Status == 1 ? TRUE : (!isset($subparts) ? TRUE : ''),
);
$deactiveRadio = array(
    'name' => 'Status',
    'id' => 'Status',
    'value' => '0',
    'class' => 'fancy-radio',
    'checked' => isset($subparts) && $subparts->Status == 0 ? TRUE : '',
);
?>

<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="section-body contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-primary">Copy SubPart</h2>
                </div>
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <div class="col-lg-12">
                    <?php
                    $hidden = array('MachSubPartID' => $subparts->MachSubPartID);
                    echo form_open_multipart("admin/subparts/copy/$subparts->MachSubPartID", 'id="addadminfrm" class="form"', $hidden);
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <select name="refMachPartID" id="refMachPartID" class="form-control select2-list" data-placeholder="--Select Machine Part--" >

                                            <?php
                                            if (!empty($parts)) {
                                                foreach ($parts as $key => $value) {
                                                    $sel = '';
                                                    if (isset($subparts) && $subparts->refMachPartID == $value->MachPartID) {
                                                        $sel = 'selected=""';
                                                    }
                                                    echo '<option value="' . $value->MachPartID . '" ' . $sel . '>' . $value->PartName . ' [' . $value->TypeName . ']</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_label('<span style="color: red">*</span>Part Name : ', 'refMachPartID', array('class' => 'required')); ?>
                                        <?php echo form_error('refMachPartID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <?php echo form_input($name); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Name : ', 'SubPartName', array('class' => 'required')); ?>
                                        <?php echo form_error('SubPartName', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <select name="refMfgID[]" id="refMfgID" class="form-control select2-list" data-placeholder="--Select Mfg Company--" multiple="">
                                            <option value="" >--Select Mfg Company--</option>
                                            <?php
                                            if (!empty($mfg)) {
                                                foreach ($mfg as $key => $value) {
                                                    $sel = '';
                                                    if (isset($mfg) && in_array($value->MfgID, $subparts->refMfgID)) {
                                                        $sel = 'selected=""';
                                                    }
                                                    echo '<option value="' . $value->MfgID . '" ' . $sel . '>' . $value->MfgName . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_label('<span style="color: red">*</span>Mfg Company : ', 'refMfgID', array('class' => 'required')); ?>
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
    var v = null;
    $(document).ready(function () {
        v = $("#addadminfrm").validate({
            // Rules for form validation
            ignore: [],
            rules: {
                SubPartName: {
                    required: true,
                    remote: {
                        url: "<?= base_url('admin/subparts/check'); ?>",
                        data: {
                            refMachPartID: function () {
                                return $('#refMachPartID').val();
                            }
                        }
                    }
                },
                refMachPartID: {required: true},
                refMfgID: {required: true},
            },
            // Messages for form validation
            messages: {
                SubPartName: {
                    required: 'Please Enter Sub Part Name',
                    remote: 'Sub Part Name Already Available, Try Another'
                },
                refMachPartID: {required: 'Machine Part Name Required'},
                refMfgID: {required: 'Mfg Name Required'}
            }
            // Do not change code below
            //errorPlacement : function(error, element) {
            //	error.insertAfter(element.parent());
            //}
        });
    });
    $(document).on('change', '#refMachPartID', function () {
        if ($("#SubPartName").val() != '') {
            $("#SubPartName").removeData("previousValue"); //clear cache when changing group
            v.element('#SubPartName');
        }
    });
</script>


