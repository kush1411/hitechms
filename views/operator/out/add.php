<?php
$BarcodeNo = array(
    'name' => 'BarcodeNo',
    'id' => 'BarcodeNo',
    'value' => isset($outmst) ? $outmst->BarcodeNo : '',
    'class' => 'form-control ',
    'required' => true
);
$EngineerName = array(
    'name' => 'EngineerName',
    'id' => 'EngineerName',
    'value' => isset($outmst) ? $outmst->EngineerName : '',
    'class' => 'form-control ',
    'required' => true
);
$EngineerContact = array(
    'name' => 'EngineerContact',
    'id' => 'EngineerContact',
    'value' => isset($outmst) ? $outmst->EngineerContact : '',
    'class' => 'form-control numbersonly',
    'required' => true
);

$submit = array('name' => 'submit',
    'id' => 'submit',
    'value' => 'Submit',
    'class' => 'btn btn-danger'
);
?>

<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($action == 'edit') { ?> 
                        <h2 class="text-primary">Edit Outward</h2>
                    <?php } else {
                        ?>
                        <h2 class="text-primary">Create Outward</h2>
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
                        $hidden = array('OutID' => $outmst->OutID);
                        echo form_open_multipart("operator/outmst/edit/$outmst->OutID", 'id="addadminfrm" class="form"', $hidden);
                    } else {
                        echo form_open_multipart('operator/outmst/add', 'id="addadminfrm" class="form"');
                    }
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($BarcodeNo); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Barcode : ', 'BarcodeNo', array('class' => 'required')); ?>
                                        <?php echo form_error('BarcodeNo', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array(
                                            'name' => 'refJobID',
                                            'id' => 'refJobID',
                                            'value' => isset($outmst) ? $outmst->refJobID : '',
                                            'class' => 'form-control ',
                                            'type' => 'hidden'
                                        ));
                                        ?>
                                        <?php
                                        echo form_input(array(
                                            'name' => 'MachName',
                                            'id' => 'MachName',
                                            'value' => isset($outmst) ? $outmst->MachName : '',
                                            'class' => 'form-control ',
                                            'readonly' => true
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span>Machine : ', 'refJobID'); ?>
                                        <?php echo form_error('refJobID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array(
                                            'name' => 'Product',
                                            'id' => 'Product',
                                            'value' => isset($outmst) ? $outmst->Product : '',
                                            'class' => 'form-control ',
                                            'readonly' => true
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span>Part : ', 'Product'); ?>
                                        <?php echo form_error('Product', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array(
                                            'name' => 'MfgName',
                                            'id' => 'MfgName',
                                            'value' => isset($outmst) ? $outmst->MfgName : '',
                                            'class' => 'form-control ',
                                            'readonly' => true
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span>Mfg Company : ', 'MfgName'); ?>
                                        <?php echo form_error('MfgName', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($EngineerName); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Engineer Name : ', 'EngineerName', array('class' => 'required')); ?>
                                        <?php echo form_error('EngineerName', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php echo form_input($EngineerContact); ?>
                                        <?php echo form_label('<span style="color: red">*</span>Engineer Contact : ', 'EngineerContact'); ?>
                                        <?php echo form_error('EngineerContact', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group control-width-normal">
                                        <div class="input-group date date-format">
                                            <div class="input-group-content">
                                                <?php
                                                echo form_input(array('name' => 'EngineerPickupDate',
                                                    'id' => 'EngineerPickupDate',
                                                    'class' => 'form-control',
                                                    'value' => (isset($outmst) && $outmst->EngineerPickupDate != '0000-00-00' ? (date('d/m/Y', strtotime($machine->EngineerPickupDate))) : ''),
                                                    'required' => 'required'
                                                ));
                                                ?>
                                                <?php echo form_label('<span style="color: red">*</span>Engineer Pickup Date', 'EngineerPickupDate'); ?>
                                                <?php
                                                echo form_error('EngineerPickupDate', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                                ?>
                                            </div>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-actionbar">
                                <div class="card-actionbar-row">
                                    <?php echo form_submit($submit); ?>
                                </div>
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
    $(document).ready(function () {
        $("#addadminfrm").validate();
    });
</script>

<script>
    var barc = '';
    $(document).on('keyup paste propertychange', '#BarcodeNo', function () {
        if ($(this).val() && barc != $(this).val()) {
            barc = $(this).val();
            console.log($(this).val());
            var _url = '<?= base_url('operator/outmst/findbarcode') ?>';
            var _post = 'GET';
            var _postType = 'json';
            var _data = {};
            _data['barc'] = barc;
            $.ajax({type: _post, url: _url, dataType: _postType, data: _data,
                success: function (_returnData) {
                    if (_returnData.res == 'success') {
                        $('#refJobID').val(_returnData.msg.JobID);
                        $('#MachName').val(_returnData.msg.MachCode + ' | ' + _returnData.msg.MachName);
                        $('#Product').val(_returnData.msg.ProductName);
                        $('#MfgName').val(_returnData.msg.MfgName);
                        console.log(_returnData.msg);
                    } else {
                        $('#refJobID').val('');
                        $('#MachName').val('');
                        $('#Product').val('');
                        $('#MfgName').val('');
                        if(_returnData.res == 'alert'){
                            alert(_returnData.msg);
                            $('#BarcodeNo').val('');
                        }
                        console.log('Try again');
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('Connection Error, Try Again');
                    setTimeout(function(){
                        location = ''
                    },10);
              }
            });
        }
    });
</script>

