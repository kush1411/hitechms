<?php
$BarcodeNo = array(
    'name' => 'BarcodeNo',
    'id' => 'BarcodeNo',
    'value' => isset($inmst) ? $inmst->BarcodeNo : '',
    'class' => 'form-control ',
    'required' => true
);
$EngineerName = array(
    'name' => 'EngineerName',
    'id' => 'EngineerName',
    'value' => isset($inmst) ? $inmst->EngineerName : '',
    'class' => 'form-control ',
    'required' => true
);
$EngineerContact = array(
    'name' => 'EngineerContact',
    'id' => 'EngineerContact',
    'value' => isset($inmst) ? $inmst->EngineerContact : '',
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
        <div class=" contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($action == 'edit') { ?> 
                        <h2 class="text-primary">Edit Inward</h2>
                    <?php } else {
                        ?>
                        <h2 class="text-primary">Create Inward</h2>
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
                        $hidden = array('InID' => $inmst->InID);
                        echo form_open_multipart("operator/inmst/edit/$inmst->InID", 'id="addadminfrm" class="form"', $hidden);
                    } else {
                        echo form_open_multipart('operator/inmst/add', 'id="addadminfrm" class="form"');
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
                                            'value' => isset($inmst) ? $inmst->refJobID : '',
                                            'class' => 'form-control ',
                                            'type' => 'hidden'
                                        ));
                                        echo form_input(array(
                                            'name' => 'refOutID',
                                            'id' => 'refOutID',
                                            'value' => isset($inmst) ? $inmst->refOutID : '',
                                            'class' => 'form-control ',
                                            'type' => 'hidden'
                                        ));
                                        ?>
                                        <?php
                                        echo form_input(array(
                                            'name' => 'MachName',
                                            'id' => 'MachName',
                                            'value' => isset($inmst) ? $inmst->MachName : '',
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
                                            'value' => isset($inmst) ? $inmst->Product : '',
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
                                            'value' => isset($inmst) ? $inmst->MfgName : '',
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
                                                echo form_input(array('name' => 'EngineerDropTime',
                                                    'id' => 'EngineerDropTime',
                                                    'class' => 'form-control',
                                                    'value' => (isset($inmst) && $inmst->EngineerDropTime != '0000-00-00' ? (date('d/m/Y', strtotime($inmst->EngineerDropTime))) : ''),
                                                    'required' => 'required'
                                                ));
                                                ?>
                                                <?php echo form_label('<span style="color: red">*</span>Engineer Drop Date', 'EngineerDropTime'); ?>
                                                <?php
                                                echo form_error('EngineerDropTime', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                                ?>
                                            </div>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row warranty">
                                <div class="col-md-3">
                                    <?php echo form_label('<span style="color: red">*</span>Return Status', 'Status'); ?>
                                    <div>
                                        <label class="radio-inline radio-styled">
                                            <input type="radio" name="Status" value="Done" required="" class="Status"><span>Done</span>
                                        </label>
                                        <label class="radio-inline radio-styled">
                                            <input type="radio" name="Status" value="Discardable" required="" class="Status"><span>Discardable</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 sm">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array(
                                            'name' => 'InvoiceNo',
                                            'id' => 'InvoiceNo',
                                            'value' => '',
                                            'class' => 'form-control ',
                                            'required' => true
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span>Invoice No : ', 'InvoiceNo'); ?>
                                    </div>
                                </div>
                                <div class="col-md-3 sm">
                                    <div class="form-group control-width-normal">
                                        <div class="input-group date date-format">
                                            <div class="input-group-content">
                                                <?php
                                                echo form_input(array('name' => 'WarrantyFrom',
                                                    'id' => 'WarrantyFrom',
                                                    'class' => 'form-control',
                                                    'value' => date('d/m/Y'),
                                                    'required' => 'required'
                                                ));
                                                ?>
                                                <?php echo form_label('<span style="color: red">*</span>Warranty From', 'WarrantyFrom'); ?>
                                                <?php
                                                echo form_error('WarrantyFrom', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                                ?>
                                            </div>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 sm">
                                    <div class="form-group control-width-normal">
                                        <div class="input-group date date-format1">
                                            <div class="input-group-content">
                                                <?php
                                                echo form_input(array('name' => 'WarrantyTo',
                                                    'id' => 'WarrantyTo',
                                                    'class' => 'form-control',
                                                    'value' => '',
                                                    'required' => 'required'
                                                ));
                                                ?>
                                                <?php echo form_label('<span style="color: red">*</span>Warranty To', 'WarrantyTo'); ?>
                                                <?php
                                                echo form_error('WarrantyTo', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                                ?>
                                            </div>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row warranty">
                                <div class="col-md-6 sm">
                                    <?php echo form_label('<span style="color: red">*</span>Invoice File: ', 'file', array('class' => 'required')); ?>
                                    <input type="file" name="file" id="file" value="" class="" accept="application/pdf" required=""/>
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
        $('.date-format1').datepicker({autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"});
        $("#addadminfrm").validate();
    });
    $(document).on('click','.Status',function(){
       if($(this).val() == 'Discardable'){
           $('.sm').hide();
       }
       if($(this).val() == 'Done'){
           $('.sm').show();
       }
    });
</script>

<script>
    var barc = '';
    $(document).on('keyup paste propertychange', '#BarcodeNo', function () {
        if ($(this).val() && barc != $(this).val()) {
            barc = $(this).val();
            console.log($(this).val());
            var _url = '<?= base_url('operator/inmst/findbarcode') ?>';
            var _post = 'GET';
            var _postType = 'json';
            var _data = {};
            _data['barc'] = barc;
            $.ajax({type: _post, url: _url, dataType: _postType, data: _data,
                success: function (_returnData) {
                    if (_returnData.res == 'success') {
                        $('#refJobID').val(_returnData.msg.JobID);
                        $('#refOutID').val(_returnData.msg.OutID);
                        $('#MachName').val(_returnData.msg.MachCode + ' | ' + _returnData.msg.MachName);
                        $('#Product').val(_returnData.msg.ProductName);
                        $('#MfgName').val(_returnData.msg.MfgName);
                        if (_returnData.msg.IsWarranty == 1) {
                            $('.warranty').hide();
                        }
                        console.log(_returnData.msg);
                    } else {
                        $('#refJobID').val('');
                        $('#refOutID').val('');
                        $('#MachName').val('');
                        $('#Product').val('');
                        $('#MfgName').val('');
                        if (_returnData.res == 'alert') {
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

