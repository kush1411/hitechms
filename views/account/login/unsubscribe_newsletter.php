<section>
    <div id="body-content" class="container">
    <div class="clearfix"> 
            <?php // $this->load->view('frontend/layout/leftwidgets', $this->data); ?>
            <?php // $this->load->view('frontend/layout/homewidgets', $this->data); ?>
            <?php
            if ($add_error)
                echo $add_error;
            if ($add_success)
                echo $add_success;
            ?>
            <?php if (isset($signuperror) && !empty($signuperror)) { ?>
                <span class="error" style="float:none"><?php echo $signuperror; ?></span>
            <?php } ?>
            <?php if (isset($success) && !empty($success)) { ?>
                <span class="success" style="float:none"><?php echo $success; ?></span>
            <?php } ?>

            <h4>  <div class="login-box" style="width:550px; margin: 0 auto;"><span>Unsubscribe Newsletter</span></div></h4>
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
            <?php echo form_open($this->uri->uri_string()); ?>
            <div class="login-box" style="width:550px; margin: 0 auto;">
                <div class="form-group">
                    <span style="color: red">*</span> <?php echo form_label('Email', 'email'); ?>
                    <?php echo form_input($login); ?>
                    <span style="color: red;"><?php echo form_error('email'); ?></span>
                </div>
                <tr class="row0 text18">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="right"><span class="bold">
                            <?php echo form_submit('unsubscribe', 'Unsubscribe', 'class="org-btn default-btn"'); ?>
                        </span></td>
                </tr>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>
