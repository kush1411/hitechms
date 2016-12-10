<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class=" contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-primary">Add Quotation</h2>
                </div>
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <div class="col-lg-12">
                    <?php
                    echo form_open_multipart('', 'id="addadminfrm" class="form"');
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="refProviderID" id="refProviderID" class="form-control select2-list" data-placeholder="--Select Service Provider--" >
                                            <?php
                                            if (!empty($provider)) {

                                                foreach ($provider as $key => $value) {
                                                    $sel = '';
                                                    $disable = '';
                                                    if ($providerStatus) {
                                                        $disable = 'disabled=""';
                                                    }
                                                    if (isset($jobmst) && $jobmst->refProviderID == $value->SerProvID) {
                                                        $sel = 'selected=""';
                                                        $disable = '';
                                                    }
                                                    echo '<option value="' . $value->SerProvID . '" ' . $sel . ' ' . $disable . '>' . $value->Name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_label('<span style="color: red">*</span>Service Provider : ', 'refProviderID'); ?>
                                        <?php echo form_error('refProviderID', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="quotation" id="quotation" value="" class="form-control numbersonly" maxlength="10" min="1" required=""/>
                                        <?php echo form_label('<span style="color: red">*</span>Quotation : ', 'quotation', array('class' => 'required')); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="">
                                        <?php echo form_label('Quotation File: ', 'file', array('class' => 'required')); ?>
                                        <input type="file" name="file" id="file" value="" class="" accept=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea name="remarks" id="remarks" rows="2" class="form-control" maxlength="400" ></textarea>
                                        <?php echo form_label('Remarks : ', 'remarks'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-actionbar">
                                <div class="card-actionbar-row">
                                    <?php
                                    echo form_submit(array('name' => 'submit',
                                        'id' => 'submit',
                                        'value' => 'Submit',
                                        'class' => 'btn btn-danger'
                                    ));
                                    ?>
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
        $("#addadminfrm").validate({ignore: ''});
    });
</script>

