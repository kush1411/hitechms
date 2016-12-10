<?php
            if ($add_error)
                echo $add_error;
            if ($add_success)
                echo $add_success;
            ?>

<?php
 
  
$login = array(
    'name' => 'email',
    'id' => 'email',
    'type' => 'email',
    'placeholder' => 'Enter email',
    'value' => '',
    'class' => 'form-control',
    'required' => 'required'
);
?>
<!--<div class="col-lg-6">-->
<!--    <div class="order-tablular forgotpass clearfix">
        <h4 class="page-header">Forget Password</h4>
        <?php //echo form_open("frontend/auth/forgotpass", 'id="forgotpassword"') ?> 
        <div class="form-group">
            <?php //echo form_label('Email Address', 'email'); ?>
            <?php //echo form_input($login); ?>
            <?php// echo form_error('password', '<span class="error">', '</span>');  ?>
        </div>
        <?php
        //echo form_submit('submit', 'Submit', 'class="btn btn-default"');
        //echo form_close();
        ?>
    </div>-->
<!--</div>-->
<section>
           <div id="body-content" class="container">
    <div class="clearfix"> 
                 <table class="table table-striped" width="100%" cellspacing="0" cellpadding="2" border="0">
                        <thead>
                            <tr>
                                
                                <th colspan="2" align="center" class="">Forgot Password</th>
                                <th class=""></th>
                                <th align="left" class=""></th>
                                <th align="left" class=""></th>
                                <th align="left" class=""></th>
                            </tr>
                        </thead>
                      
                        <tbody>
                            <tr class="row0">
                              <?php echo form_open("frontend/auth/forgotpass", 'id="forgotpassword"') ?> 
                            <td><?php echo form_label('Email Address', 'email'); ?></td>
                            <td><?php echo form_input($login); ?>
                                <?php echo form_error('password', '<span class="error">', '</span>');  ?>
                            </td>
                            </tr>
           
                            <tr class="row0 text18">
                                <td></td>
                                <td></td>
                                <td></td>
                            <td align="right"><span class="bold">
                            <?php
                                echo form_submit('submit', 'Submit', 'class="btn btn-primary"');
                                echo form_close();
                            ?> 
                              </span></td>
             
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
</section>
