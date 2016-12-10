<?php

$code = array(
    'name' => 'Code',
    'id' => 'Code',
    'value' => isset($location) ? $location->Code : '',
    'class' => 'form-control '
);
$name = array(
    'name' => 'Name',
    'id' => 'Name',
    'value' => isset($location) ? $location->Name : '',
    'class' => 'form-control '
);
$submit = array('name' => 'submit',
    'id' => 'submit',
    'value' => 'Submit',
    'class' => 'btn btn-danger'
);
$activeRadio = array(
    'name' => 'Status',
    'id' => 'Status1',
    'value' => '1',
    'class' => 'fancy-radio',
    'checked' => isset($location) && $location->Status == 1 ? TRUE : !isset($location) ? TRUE : '',
);
$deactiveRadio = array(
    'name' => 'Status',
    'id' => 'Status2',
    'value' => '0',
    'class' => 'fancy-radio',
    'checked' => isset($location) && $location->Status == 0 ? TRUE : '',
);
?>

<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="section-body contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($action == 'edit') { ?> 
                        <h2 class="text-primary">Edit Location</h2>
                        <?php } else {
                        ?>
                        <h2 class="text-primary">Create Location</h2>
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
                        $hidden = array('LocID' => $location->LocID);
                        echo form_open_multipart("location/edit/$location->LocID", 'id="addadminfrm" class="form"', $hidden);
                    } else {
                        echo form_open_multipart('location/add', 'id="addadminfrm" class="form"');
                    }
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <?php echo form_input($code); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Code : ', 'Code', array('class' => 'required')); ?>
                                        <?php echo form_error('Code', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <?php echo form_input($name); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Name : ', 'Name', array('class' => 'required')); ?>
                                        <?php echo form_error('Name', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
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

<?php	if ($action == 'edit') { ?>
	<script>
$(document).ready(function() {
	$("#addadminfrm").validate({
		// Rules for form validation
		rules : {
			Code : {
				required : true,
				remote: "<?=base_url('location/check/'.$location->LocID);?>",
			},
			Name : {required : true}
		},

		// Messages for form validation
		messages : {
			Code : {
				required : 'Please Enter Location Code',
				remote: 'Location Code Already Available, Try Another'
			},
			Name : {required : 'Location Name Required'}
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
			Code : {
				required : true,
				remote: "<?=base_url('location/check');?>",
			},
			Name : {required : true}
		},

		// Messages for form validation
		messages : {
			Code : {
				required : 'Please Enter Location Code',
				remote: 'Location Code Already Available, Try Another'
			},
			Name : {required : 'Location Name Required'}
		},

		// Do not change code below
		//errorPlacement : function(error, element) {
		//	error.insertAfter(element.parent());
		//}
	});
});
</script>
<?php }  ?>

