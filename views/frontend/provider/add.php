<?php
$email = array(
    'name' => 'Email',
    'type' => 'email',
    'id' => 'Email',
    'value' => isset($provider) ? $provider->Email : '',
    'class' => 'form-control',
    'required' => 'required'
);
$weburl = array(
    'name' => 'WebUrl',
    'type' => 'text',
    'id' => 'WebUrl',
    'value' => isset($provider) ? $provider->WebUrl : '',
    'class' => 'form-control',
        //'required' => 'required'
);
$name = array(
    'name' => 'Name',
    'id' => 'Name',
    'value' => isset($provider) ? $provider->Name : '',
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
    'checked' => isset($provider) && $provider->Status == 1 ? TRUE : !isset($provider) ? TRUE : '',
);
$deactiveRadio = array(
    'name' => 'Status',
    'id' => 'Status',
    'value' => '0',
    'class' => 'fancy-radio',
    'checked' => isset($provider) && $provider->Status == 0 ? TRUE : '',
);
?>

<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="section-body contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($action == 'edit') { ?> 
                        <h2 class="text-primary">Edit Service Provider</h2>
                    <?php } else {
                        ?>
                        <h2 class="text-primary">Create Service Provider</h2>
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
                        $hidden = array('SerProvID' => $provider->SerProvID);
                        echo form_open_multipart("provider/edit/$provider->SerProvID", 'id="addadminfrm" class="form"', $hidden);
                    } else {
                        echo form_open_multipart('provider/add', 'id="addadminfrm" class="form"');
                    }
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($name); ?>
                                        <?php echo form_label('<span style="color: red">*</span> Name : ', 'Name', array('class' => 'required')); ?>
                                        <?php echo form_error('Name', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class = "form-group">
                                        <?php echo form_input($email); ?>
                                        <?php echo form_label('<span style="color: red">*</span> Email address', 'Email'); ?>
                                        <?php echo form_error('Email', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'Addr1',
                                            'id' => 'Addr1',
//                                    'palceholder' => 'address',
                                            'class' => 'form-control',
                                            'value' => (isset($provider) && $provider->Addr1 ? ($provider->Addr1) : ''),
                                            'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> Address1', 'Addr1'); ?>
                                        <?php echo form_error('Addr1', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'Addr2',
                                            'id' => 'Addr2',
//                                    'palceholder' => 'address',
                                            'class' => 'form-control',
                                            'value' => (isset($provider) && $provider->Addr2 ? ($provider->Addr2) : ''),
                                                //'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('Address2', 'Addr2'); ?>
                                        <?php echo form_error('Addr2', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'City',
                                            'id' => 'City',
//                                    'palceholder' => 'city',
                                            'class' => 'form-control',
                                            'value' => (isset($provider) && $provider->City ? ($provider->City) : ''),
                                            'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> City', 'City'); ?>
                                        <?php echo form_error('City', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'State',
                                            'id' => 'State',
//                                    'palceholder' => 'state',
                                            'class' => 'form-control',
                                            'value' => (isset($provider) && $provider->State ? ($provider->State) : ''),
                                            'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> State/Province', 'State'); ?>
                                        <?php
                                        echo form_error('State', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'Country',
                                            'id' => 'Country',
//                                    'palceholder' => 'country',
                                            'class' => 'form-control',
                                            'value' => (isset($provider) && $provider->Country ? ($provider->Country) : ''),
                                            'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> Country', 'Country'); ?>
                                        <?php
                                        echo form_error('Country', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'Pincode',
                                            'id' => 'Pincode',
//                                    'palceholder' => 'zip',
                                            'class' => 'form-control',
                                            'value' => (isset($provider) && $provider->Pincode ? ($provider->Pincode) : ''),
                                            'pattern' => "\d+",
                                            'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> Postal/Zip Code', 'Pincode'); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'Contact1',
                                            'id' => 'Contact1',
//                                    'palceholder' => 'telephone',
                                            'class' => 'form-control',
                                            'value' => (isset($provider) && $provider->Contact1 ? ($provider->Contact1) : ''),
                                            'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> Contact1', 'Contact1'); ?>
                                        <?php
                                        echo form_error('Contact1', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('name' => 'Contact2',
                                            'id' => 'Contact2',
//                                    'palceholder' => 'telephone',
                                            'class' => 'form-control',
                                            'value' => (isset($provider) && $provider->Contact2 ? ($provider->Contact2) : ''),
                                        ));
                                        ?>
                                        <?php echo form_label(' Contact2', 'Contact2'); ?>
                                        <?php
                                        echo form_error('Contact2', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                        ?>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class = "form-group">
                                        <?php echo form_input($weburl); ?>
                                        <?php echo form_label(' Web address', 'WebUrl'); ?>
                                        <?php echo form_error('WebUrl', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
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
                rules: {
                    Name: {
                        required: true,
                        remote: "<?= base_url('provider/check/' . $provider->SerProvID); ?>",
                    },
                    Addr1: {required: true},
                    City: {required: true},
                    State: {required: true},
                    Country: {required: true},
                    Pincode: {required: true, number: true},
                    Contact1: {required: true},
                    Email: {
                        email: true,
                        required: true,
                        remote: "<?= base_url('provider/checkemail/' . $provider->SerProvID); ?>",
                    },
                },
                // Messages for form validation
                messages: {
                    Name: {
                        required: 'Please Enter Provider Name',
                        remote: 'Provider Name Already Available, Try Another'
                    },
                    Addr1: {required: 'Address Required'},
                    City: {required: 'City Required'},
                    State: {required: 'State Required'},
                    Country: {required: 'Country Required'},
                    Pincode: {required: 'Pincode Required', number: 'Numeric value required'},
                    Contact1: {required: 'Contact number Required'},
                    Email: {
                        email: 'Enter valid email address',
                        required: 'Please Enter Email',
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
        $(document).ready(function () {
            $("#addadminfrm").validate({
                // Rules for form validation
                rules: {
                    Name: {
                        required: true,
                        remote: "<?= base_url('provider/check/'); ?>",
                    },
                    Addr1: {required: true},
                    City: {required: true},
                    State: {required: true},
                    Country: {required: true},
                    Pincode: {required: true, number: true},
                    Contact1: {required: true},
                    Email: {
                        email: true,
                        required: true,
                        remote: "<?= base_url('provider/checkemail/'); ?>",
                    },
                },
                // Messages for form validation
                messages: {
                    Name: {
                        required: 'Please Enter Provider Name',
                        remote: 'Provider Name Already Available, Try Another'
                    },
                    Addr1: {required: 'Address Required'},
                    City: {required: 'City Required'},
                    State: {required: 'State Required'},
                    Country: {required: 'Country Required'},
                    Pincode: {required: 'Pincode Required', number: 'Numeric value required'},
                    Contact1: {required: 'Contact number Required'},
                    Email: {
                        email: 'Enter valid email address',
                        required: 'Please Enter Email',
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
<?php } ?>