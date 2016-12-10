<?php
$name = array(
    'name' => 'name',
    'id' => 'name',
    'value' => $admingroup->name,
    'class' => 'form-control'
);
$submit = array('name' => 'submit',
    'id' => 'submit',
    'value' => 'Submit',
    'class' => 'btn btn-danger'
);
$activeRadio = array(
    'name' => 'status',
    'id' => 'status',
    'value' => '1',
    'class' => 'fancy-radio',
    'checked' => $admingroup->status ? TRUE : '',
);
$deactiveRadio = array(
    'name' => 'status',
    'id' => 'status',
    'value' => '0',
    'class' => 'fancy-radio',
    'checked' => !$admingroup->status ? TRUE : '',
);
?>

<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="section-body contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($action == 'edit') { ?> 
                        <h2 class="text-primary">Edit Group</h2>
                        <?php } else {
                        ?>
                        <h2 class="text-primary">Create Group</h2>
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
                        $hidden = array('id' => $admingroup->id);
                        echo form_open_multipart("admin/groups/edit/$admingroup->id", 'id="addadminfrm" class="form"', $hidden);
                    } else {
                        echo form_open_multipart('admin/groups/add', 'id="addadminfrm" class="form"');
                    }
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <?php echo form_input($name); ?>
                                        <?php echo form_label('Name : ', 'Name', array('class' => 'required')); ?>
                                        <?php echo form_error('name', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
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
                                        <?php echo form_error('status', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
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
<?php
    if ($action == 'edit') { ?>
	<script>
$(document).ready(function() {
	$("#addadminfrm").validate({
		// Rules for form validation
		rules : {
			name : {
				required : true,
				remote: "<?=base_url('admin/groups/check/'.$admingroup->id);?>",
			}
		},

		// Messages for form validation
		messages : {
			name : {
				required : 'Please Enter Group Name',
				remote: 'Group Name Already Available, Try Another'
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
			name : {
				required : true,
				remote: "<?=base_url('admin/groups/check');?>",
			}
		},

		// Messages for form validation
		messages : {
			name : {
				required : 'Please Enter Group Name',
				remote: 'Group Name Already Available, Try Another'
			}
		},

		// Do not change code below
		//errorPlacement : function(error, element) {
		//	error.insertAfter(element.parent());
		//}
	});
});
</script>
<?php }
                    ?>


