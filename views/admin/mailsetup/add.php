<?php
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
                    <?php if ($action == 'edit') { ?> 
                        <h2 class="text-primary">Edit Mailsetup</h2>
                        <?php } else {
                        ?>
                        <h2 class="text-primary">Create Mailsetup</h2>
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
                        $hidden = array('refMfgID' => $mailsetup->refMfgID1);
                        echo form_open_multipart("admin/mailsetup/edit/$mailsetup->refMfgID1", 'id="addadminfrm" class="form"', $hidden);
                    } else {
                        echo form_open_multipart('admin/mailsetup/add', 'id="addadminfrm" class="form"');
                    }
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select name="refMfgID1" id="refMfgID1" class="form-control select2-list EngCountry" data-placeholder="--Select Manufacturer--" >
                                                <option value="" >--Select Manufacturer--</option>
                                                <?php
                                                if (!empty($mfg)) {
                                                    $op = '';
                                                    if (isset($mailsetup) && $mailsetup->refMfgID1 > 0){
                                                        $op = 'disabled=""';
                                                    }
                                                    foreach ($mfg as $key => $value) {
                                                        $sel = '';
                                                        if (isset($mailsetup) && $mailsetup->refMfgID1 == $value->MfgID) {
                                                            $sel = 'selected=""';
                                                            $op = '';
                                                        }
                                                        echo '<option value="' . $value->MfgID . '" ' . $sel . ' ' . $op . '>' . $value->MfgName . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <?php echo form_label('Manufacturer Name : ', 'refMfgID1'); ?>
                                            <?php echo form_error('refMfgID1', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select name="refMfgID2[]" id="refMfgID2" multiple="" class="form-control select2-list EngCity" data-placeholder="--Select Manufacturer For Mail--" >
                                                <?php
                                                if (!empty($mfg)) {
                                                    $refMfgID2 = array();
                                                    if (isset($mailsetup) && $mailsetup->refMfgID2 != ''){
                                                        if(strpos($mailsetup->refMfgID2, ',') !== FALSE){
                                                            $refMfgID2 = explode(',', $mailsetup->refMfgID2);
                                                        }else{
                                                            $refMfgID2[] = $mailsetup->refMfgID2;
                                                        }
                                                    }
                                                    foreach ($mfg as $key => $value) {
                                                        $sel = '';
                                                        if (in_array($value->MfgID, $refMfgID2)) {
                                                            $sel = 'selected=""';
                                                        }
                                                        echo '<option value="' . $value->MfgID . '" ' . $sel . '>' . $value->MfgName . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <label for="refMfgID2">Mail Send To :</label>
                                            <input type="checkbox" class="checkbox selall" style="float: left">Select All Mfg
                                            <?php echo form_error('refMfgID2', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
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
    $(document).on('click', '.selall', function () {
        if ($(this).is(':checked')) {
            $(this).prev().prev().find('option').prop("selected", "selected");
            $(this).prev().prev().trigger("change");
        } else {
            $(this).prev().prev().find('option').removeAttr("selected");
            $(this).prev().prev().trigger("change");
        }
    });
    </script>
<?php	if ($action == 'edit') { ?>
	<script>
$(document).ready(function() {
	$("#addadminfrm").validate({
		// Rules for form validation
		rules : {
			refMfgID1 : {
				required : true,
				remote: "<?=base_url('admin/mailsetup/check/'.$mailsetup->refMfgID1);?>",
			},
                        refMfgID2 : {
				required : true
                        }
		},

		// Messages for form validation
		messages : {
			refMfgID1 : {
				required : 'Please Select Manufacturer',
				remote: 'Mailsetup Already Set For This Manufacturer'
			},
                        refMfgID2 : {
				required : 'Please Select Manufacturer For Mail'
			}
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
$(document).ready(function() {
	$("#addadminfrm").validate({
		// Rules for form validation
		rules : {
			refMfgID1 : {
				required : true,
				remote: "<?=base_url('admin/mailsetup/check');?>",
			},
                        refMfgID2 : {
				required : true
                        }
		},

		// Messages for form validation
		messages : {
			refMfgID1 : {
				required : 'Please Select Manufacturer',
				remote: 'Mailsetup Already Set For This Manufacturer'
			},
                        refMfgID2 : {
				required : 'Please Select Manufacturer For Mail'
			}
		},

		// Do not change code below
		//errorPlacement : function(error, element) {
		//	error.insertAfter(element.parent());
		//}
	});
});
</script>
<?php }  ?>