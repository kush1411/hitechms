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
                    <h2 class="text-primary">Edit Account</h2>
                </div>
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <div class="col-lg-12">
                    <?php
                        $hidden = array('AccountID' => $account->AccountID);
                        echo form_open_multipart("account/edit/$account->AccountID", 'id="addadminfrm" class="form"', $hidden);
                   
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group control-width-normal">
                                        <div class="input-group date date-format2">
                                            <div class="input-group-content">
                                                <?php
                                                echo form_input(array('name' => 'PaymentDate',
                                                    'id' => 'PaymentDate',
                                                    'class' => 'form-control',
                                                    'value' => date('d/m/Y'),
                                                    'required' => 'required'
                                                ));
                                                ?>
                                                <?php echo form_label('<span style="color: red">*</span>Payment Date', 'PaymentDate'); ?>
                                                <?php
                                                echo form_error('PaymentDate', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>');
                                                ?>
                                            </div>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="PaymentTakenPerson" id="PaymentTakenPerson" value="" maxlength="100" class="form-control"/>
                                        <?php echo form_label(' Person Name : ', 'PaymentTakenPerson'); ?>
                                        <?php echo form_error('PaymentTakenPerson', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h6 style="margin-top: 0; color: #9d9d9d">Select Payment Option :</h6>
                                    <div class="">
                                        <div class="checkbox checkbox-styled checkbox-inline"><label><input type="radio" name="PaymentType" value="Bank" class="PaymentType form-control" required=""> Bank  </label> </div>  
                                        <div class="checkbox checkbox-styled checkbox-inline"><label><input type="radio" name="PaymentType" value="Cheque" class="PaymentType form-control" required=""> Cheque  </label> </div>  
                                        <div class="checkbox checkbox-styled checkbox-inline"><label><input type="radio" name="PaymentType" value="Cash" class="PaymentType form-control" required=""> Cash  </label> </div>  
                                        <div class="checkbox checkbox-styled checkbox-inline"><label><input type="radio" name="PaymentType" value="DD" class="PaymentType form-control" required=""> DD  </label> </div>  
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
    $(document).ready(function () {
        $("#addadminfrm").validate();
    });
</script>

