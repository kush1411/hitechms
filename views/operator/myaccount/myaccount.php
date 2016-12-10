<?php
$email = array(
    'name' => 'EmpEmail',
    'type' => 'email',
    'id' => 'EmpEmail',
    'value' => isset($employee) ? $employee->EmpEmail : '',
    'class' => 'form-control',
    'readonly' => 'readonly'
);
$code = array(
    'name' => 'EmpCode',
    'id' => 'EmpCode',
    'value' => isset($employee) ? $employee->EmpCode : '',
    'class' => 'form-control mini fl ',
    'readonly' => 'readonly'
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
        <div class="contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-primary">Personal Info</h1>
                </div>
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <div class="col-lg-12">
                    <?php
                    $id = $this->session->userdata[SITE_NAME . '_operator_data']['operator_id'];
                    echo form_open('operator/myaccount/edit/' . $id, 'class="form"');
                    ?>
                    <div class="card">
                        <div class="card-body">
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
                                <div class="col-md-3">
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
                                <div class="col-md-3">
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
                                                    'value' => (isset($employee) && $employee->EmpJoinDat ? (date('d/m/Y', strtotime($employee->EmpJoinDat))) : ''),
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
                                                    'value' => (isset($employee) && $employee->EmpLeftOn ? (date('d/m/Y', strtotime($employee->EmpLeftOn))) : ''),
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