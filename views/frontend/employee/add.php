<?php
$email = array(
    'name' => 'EmpEmail',
    'type' => 'email',
    'id' => 'EmpEmail',
    'value' => isset($employee) ? $employee->EmpEmail : '',
    'class' => 'form-control',
    'required' => 'required'
);
$code = array(
    'name' => 'EmpCode',
    'id' => 'EmpCode',
    'value' => isset($employee) ? $employee->EmpCode : '',
    'class' => 'form-control mini fl ',
    'required' => 'required'
);
$name = array(
    'name' => 'EmpName',
    'id' => 'EmpName',
    'value' => isset($employee) ? $employee->EmpName : '',
    'class' => 'form-control mini fl ',
    'required' => 'required'
);
$submit = array('name' => 'submit',
    'id' => 'submit',
    'value' => 'Submit',
    'class' => 'btn btn-danger'
);
$activeRadio = array(
    'name' => 'EmpStatus',
    'id' => 'EmpStatus',
    'value' => '1',
    'class' => 'fancy-radio',
    'checked' => isset($employee) && $employee->EmpStatus == 1 ? TRUE : !isset($employee) ? TRUE : '',
);
$deactiveRadio = array(
    'name' => 'EmpStatus',
    'id' => 'EmpStatus',
    'value' => '0',
    'class' => 'fancy-radio',
    'checked' => isset($employee) && $employee->EmpStatus == 0 ? TRUE : '',
);
$DayRadio = array(
    'name' => 'EmpShift',
    'id' => 'EmpShift',
    'value' => 'Day',
    'class' => 'fancy-radio',
    'checked' => isset($employee) && $employee->EmpShift == 'Day' ? TRUE : !isset($employee) ? TRUE : '',
);
$NightRadio = array(
    'name' => 'EmpShift',
    'id' => 'EmpShift',
    'value' => 'Night',
    'class' => 'fancy-radio',
    'checked' => isset($employee) && $employee->EmpShift == 'Night' ? TRUE : '',
);
?>

<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="section-body contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($action == 'edit') { ?> 
                        <h2 class="text-primary">Edit Employee</h2>
                    <?php } else {
                        ?>
                        <h2 class="text-primary">Create Employee</h2>
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
                        $hidden = array('EmpID' => $employee->EmpID);
                        echo form_open_multipart("employee/edit/$employee->EmpID", 'id="addadminfrm" class="form"', $hidden);
                    } else {
                        echo form_open_multipart('employee/add', 'id="addadminfrm" class="form"');
                    }
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="refDesgnID" id="refDesgnID" class="form-control select2-list" data-placeholder="--Select Designation--" required="">
                                            <option value="">--Select Designation--</option>
                                            <?php
                                            if (!empty($designation)) {
                                                foreach ($designation as $key => $value) {
                                                    $sel = '';
                                                    if (isset($employee) && $employee->refDesgnID == $value->DesignID) {
                                                        $sel = 'selected=""';
                                                    }
                                                    echo '<option value="' . $value->DesignID . '" ' . $sel . '>' . $value->Name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_label('<span style="color: red">*</span>Designation : ', 'refDesgnID'); ?>
                                        <?php echo form_error('refDesgnID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="refLocID" id="refLocID" class="form-control select2-list" data-placeholder="--Select Location--" required="" >
                                            <option value="">--Select Location--</option>
                                            <?php
                                            if (!empty($location)) {
                                                foreach ($location as $key => $value) {
                                                    $sel = '';
                                                    if (isset($employee) && $employee->refLocID == $value->LocID) {
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
                                        <?php echo form_label('<span style="color: red">*</span> Code : ', 'EmpCode'); ?>
                                        <?php echo form_error('EmpCode', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($name); ?>
                                        <?php echo form_label('<span style="color: red">*</span> Name : ', 'EmpName'); ?>
                                        <?php echo form_error('EmpName', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class = "form-group">
                                        <?php echo form_input($email); ?>
                                        <?php echo form_label('<span style="color: red">*</span> Email address', 'EmpEmail'); ?>
                                        <?php echo form_error('EmpEmail', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'EmpAddr1',
                                            'id' => 'EmpAddr1',
                                            'class' => 'form-control',
                                            'value' => (isset($employee) && $employee->EmpAddr1 ? ($employee->EmpAddr1) : ''),
                                            'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> Address1', 'EmpAddr1'); ?>
                                        <?php echo form_error('EmpAddr1', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'EmpAddr2',
                                            'id' => 'EmpAddr2',
                                            'class' => 'form-control',
                                            'value' => (isset($employee) && $employee->EmpAddr2 ? ($employee->EmpAddr2) : ''),
                                        ));
                                        ?>
                                        <?php echo form_label('Address2', 'EmpAddr2'); ?>
                                        <?php echo form_error('EmpAddr2', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'EmpCity',
                                            'id' => 'EmpCity',
                                            'class' => 'form-control',
                                            'value' => (isset($employee) && $employee->EmpCity ? ($employee->EmpCity) : ''),
                                            'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> City', 'EmpCity'); ?>
                                        <?php echo form_error('EmpCity', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'EmpState',
                                            'id' => 'EmpState',
                                            'class' => 'form-control',
                                            'value' => (isset($employee) && $employee->EmpState ? ($employee->EmpState) : ''),
                                            'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> State/Province', 'EmpState'); ?>
                                        <?php
                                        echo form_error('EmpState', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'EmpCountry',
                                            'id' => 'EmpCountry',
                                            'class' => 'form-control',
                                            'value' => (isset($employee) && $employee->EmpCountry ? ($employee->EmpCountry) : ''),
                                            'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> Country', 'Country'); ?>
                                        <?php
                                        echo form_error('EmpCountry', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'EmpPincode',
                                            'id' => 'EmpPincode',
                                            'class' => 'form-control',
                                            'value' => (isset($employee) && $employee->EmpPincode ? ($employee->EmpPincode) : ''),
                                            'pattern' => "\d+",
                                            'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> Postal/Zip Code', 'EmpPincode'); ?>
                                        <?php
                                        echo form_error('EmpPincode', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'EmpContact1',
                                            'id' => 'EmpContact1',
                                            'class' => 'form-control',
                                            'value' => (isset($employee) && $employee->EmpContact1 ? ($employee->EmpContact1) : ''),
                                            'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> Contact1', 'EmpContact1'); ?>
                                        <?php
                                        echo form_error('EmpContact1', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'EmpContact2',
                                            'id' => 'EmpContact2',
                                            'class' => 'form-control',
                                            'value' => (isset($employee) && $employee->EmpContact2 ? ($employee->EmpContact2) : ''),
                                        ));
                                        ?>
                                        <?php echo form_label(' Contact2', 'EmpContact2'); ?>
                                        <?php
                                        echo form_error('EmpContact2', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div>
                                            <label class="radio-inline radio-styled">
                                                <?php echo form_radio($DayRadio); ?><span>Day</span>
                                            </label>
                                            <label class="radio-inline radio-styled">
                                                <?php echo form_radio($NightRadio); ?><span>Night</span>
                                            </label>
                                        </div>
                                        <?php echo form_label('Shift : ', 'EmpShift'); ?>
                                        <?php echo form_error('EmpShift', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group control-width-normal">
										<div class="input-group date" id="demo-date-format">
											<div class="input-group-content">
                                        <?php
                                        echo form_input(array('name' => 'EmpJoinDat',
                                            'id' => 'EmpJoinDat',
                                            'class' => 'form-control datepicker',
                                            'value' => (isset($employee) && $employee->EmpJoinDat ? (date('d/m/Y',strtotime($employee->EmpJoinDat))) : ''),
                                            'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> Joining Date', 'EmpJoinDat'); ?>
                                        <?php
                                        echo form_error('EmpJoinDat', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                        ?>
											</div>
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										</div>
									</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group control-width-normal">
										<div class="input-group date" id="demo-date-format1">
											<div class="input-group-content">
                                        <?php
                                        echo form_input(array('name' => 'EmpLeftOn',
                                            'id' => 'EmpLeftOn',
                                            'class' => 'form-control datepicker',
                                            'value' => (isset($employee) && $employee->EmpLeftOn ? (date('d/m/Y',strtotime($employee->EmpLeftOn))) : ''),
                                        ));
                                        ?>
                                        <?php echo form_label('Left Date', 'EmpLeftOn'); ?>
                                        <?php
                                        echo form_error('EmpLeftOn', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                        ?>
                                    </div>
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										</div>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'EmpSalary',
                                            'id' => 'EmpSalary',
                                            'class' => 'form-control',
                                            'value' => (isset($employee) && $employee->EmpSalary ? ($employee->EmpSalary) : ''),
                                        ));
                                        ?>
                                        <?php echo form_label('Salary', 'EmpSalary'); ?>
                                        <?php
                                        echo form_error('EmpSalary', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'EmpRemarks',
                                            'id' => 'EmpRemarks',
                                            'class' => 'form-control',
                                            'value' => (isset($employee) && $employee->EmpRemarks ? ($employee->EmpRemarks) : ''),
                                        ));
                                        ?>
                                        <?php echo form_label('Remarks', 'EmpRemarks'); ?>
                                        <?php
                                        echo form_error('EmpRemarks', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
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
<?php	if ($action == 'edit') { ?>
	<script>
$(document).ready(function() {
	$("#addadminfrm").validate({
		// Rules for form validation
		rules : {
			EmpCode : {
				required : true,
				remote: "<?=base_url('employee/check/'.$employee->EmpID);?>",
			},
			refDesgnID : { required : true },
			refLocID : { required : true },
			EmpName :{ required : true },
			EmpAddr1 :{ required : true },
			EmpCity :{ required :  true },
			EmpState :{ required :  true },
			EmpCountry :{ required :  true },
			EmpPincode :{ required :  true, number : true},
			EmpContact1 :{ required :  true },
			EmpEmail :{
				email : true,
				required :  true,
				remote: "<?=base_url('employee/checkemail/'.$employee->EmpID);?>",
			},
		},

		// Messages for form validation
		messages : {
			EmpCode : {
				required : 'Please Enter Employee Code',
				remote: 'Employee Code Already Available, Try Another'
			},
			refDesgnID : { required : 'Employee Designation Required' },
			refLocID : { required : 'Employee Location Required' },
			EmpName : { required :'Employee Name Required' },
			EmpAddr1 : { required :'Address Required' },
			EmpCity : { required :'City Required' },
			EmpState : { required :'State Required' },
			EmpCountry : { required :'Country Required' },
			EmpPincode : { required :'Pincode Required', number : 'Numeric value required' },
			EmpContact1 : { required :'Contact number Required' },
			EmpEmail : {
				email : 'Enter valid email address',
				required : 'Please Enter Email',
				remote: 'Email Already Available, Try Another'
			},
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
			EmpCode : {
				required : true,
				remote: "<?=base_url('employee/check/');?>",
			},
			refDesgnID : { required : true },
			refLocID : { required : true },
			EmpName :{ required : true },
			EmpAddr1 :{ required : true },
			EmpCity :{ required :  true },
			EmpState :{ required :  true },
			EmpCountry :{ required :  true },
			EmpPincode :{ required :  true, number : true },
			EmpContact1 :{ required :  true },
			EmpEmail : {
				email : true,
				required : true,
				remote: "<?=base_url('employee/checkemail/');?>",
			},
		},

		// Messages for form validation
		messages : {
			EmpCode : {
				required : 'Please Enter Employee Code',
				remote: 'Employee Code Already Available, Try Another'
			},
			refDesgnID : { required : 'Employee Designation Required' },
			refLocID : { required : 'Employee Location Required' },
			EmpName : { required :'Employee Name Required' },
			EmpAddr1 : { required :'Address Required' },
			EmpCity : { required :'City Required' },
			EmpState : { required :'State Required' },
			EmpCountry : { required :'Country Required' },
			EmpPincode : { required :'Pincode Required', number : 'Numeric value required' },
			EmpContact1 : { required :'Contact number Required' },
			EmpEmail : {
				email : 'Enter valid email address',
				required : 'Please Enter Email',
				remote: 'Email Already Available, Try Another'
			},
		},

		// Do not change code below
		//errorPlacement : function(error, element) {
		//	error.insertAfter(element.parent());
		//}
	});
});
</script>
<?php }  ?>