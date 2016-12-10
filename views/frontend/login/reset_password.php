<section>
    <div id="content-section" class="clearfix"> 
        <div class="order-table">
            <?php
            if (isset($add_error))
                echo $add_error;
            if (isset($add_success))
                echo $add_success;
            ?>
            <h1 class="page-header"><span>Reset Password</span></h1>
            <?php
            $new_password = array(
                'name' => 'new_password',
                'id' => 'new_password',
                'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
                'size' => 30,
                'class' => 'form-control'
            );
            $confirm_new_password = array(
                'name' => 'confirm_new_password',
                'id' => 'confirm_new_password',
                'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
                'size' => 30,
                'class' => 'form-control'
            );
            ?>
            <?php echo form_open($this->uri->uri_string()); ?>
            <div class="login-box" style="width:550px; margin: 0 auto;">
                <div class="form-group">
                    <span style="color: red">*</span> <?php echo form_label('New Password', $new_password['id']); ?>
                    <?php echo form_password($new_password); ?>
                    <span style="color: red;"><?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']]) ? $errors[$new_password['name']] : ''; ?></span>
                </div>
                <div class="form-group">
                    <span style="color: red">*</span> <?php echo form_label('Confirm New Password', $confirm_new_password['id']); ?>
                    <?php echo form_password($confirm_new_password); ?>
                    <span style="color: red;"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']]) ? $errors[$confirm_new_password['name']] : ''; ?></span>
                </div>
                <div class="form-group">
                    <?php echo form_submit('change', 'Change Password', 'class="org-btn default-btn"'); ?>

                </div>

            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>
