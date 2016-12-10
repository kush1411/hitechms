
<!-- BEGIN CONTENT-->
<div id="content">
    <section class="style-default-bright">
        <div class="section-header">
            <h2 class="text-primary">View Quotation</h2>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <div class="col-lg-12">
                    <?php echo form_open('', 'id="quotation-form"'); ?>
                    <div class="table-responsive">
                        <?php if (isset($quotationlist) && !empty($quotationlist)) { ?>
                            <table id="datatable1" class="table table-striped table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Select Any One</th>
                                        <th>Provider Name</th>
                                        <th>Quotation Amt</th>
                                        <th>Remarks</th>
                                        <th>File</th>
                                        <th class="sort">Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($quotationlist as $user) { ?>
                                        <tr class="odd gradeX">
                                            <td class="sorting_1"><input type="radio" class="form-control selectany" name="selectany" class="selectany" value="<?=$user->quotation?>" data-id="<?=$user->refSerProvID?>" <?=$job->refProviderID == $user->refSerProvID ? 'checked' : '' ?> <?=$job->Status == 'Quotation Request Sent' ? '' : 'disabled=""'?>/></td>
                                            <td class=""><?php echo $user->Name; ?></td>
                                            <td class=""><?php echo $user->quotation; ?></td>
                                            <td><?php echo $user->remarks ?></td>
                                            <td><?php echo $user->filename ?></td>
                                            <td class="center"><?php echo date("d-m-Y", strtotime($user->InsDateTime)); ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                        } else {
                            echo "There is no data to display";
                        }
                        ?>
                    </div>
                    <?php if($job->Status == 'Quotation Request Sent'){ ?>
                    <input type="submit" name="Quotation Apply" value="Quotation Apply" class="btn btn-primary pull-right" style="margin-top: 20px;">
                    <?php } ?>
                    <?php echo form_close(); ?>
                </div>
            </div><!--end .row -->
        </div><!--end .section-body -->
    </section>
</div><!--end #content-->
<!-- END CONTENT -->
<div id="myQotModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <?php echo form_open_multipart('', 'id="quotation-final-form" class="form"'); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Fill The Box ::</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="selectedProvider" id="selectedProvider" value="" />
                <div class="form-group">
                    <?php
                    echo form_input(array(
                        'name' => 'Remarks',
                        'id' => 'Remarks',
                        'value' => isset($jobmst) ? $jobmst->Remarks : '',
                        'class' => 'form-control '
                    ));
                    ?>
<?php echo form_label('Remarks : ', 'Remarks'); ?>
<?php echo form_error('Remarks', '<div id="error"><div class="error-left"></div><div class="error-inner">', '</div></div>'); ?>
                </div>
                
                <div style="margin-top: 10px">
                    <?php echo form_label('<span style="color: red">*</span>Quotation File: ', 'file', array('class' => 'required')); ?>
                    <input type="file" name="file" id="file" value="" class="" accept="" required=""/>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    Apply Quotation
                </button>
            </div>
<?php echo form_close(); ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#quotation-final-form').validate();
        $('#quotation-form').validate({
            submitHandler: function () {
                var _prv = 0; var _qot = 0;
                $('.selectany').each(function(index){
                    console.log($(this).is(':checked'));
                    if($(this).is(':checked')){
                        _prv = $(this).attr('data-id');
                        _qot = $(this).val();
                    }
                });
                if(_prv == 0){
                    alert('Select Any One Provider');
                    return false;
                }
                $('#selectedProvider').val(_prv+'__11__'+_qot);
                $('#myQotModal').modal('show');
                return false;
            }
        });
    });
</script>