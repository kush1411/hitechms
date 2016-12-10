<section>
    <div id="content-section" class="clearfix"> 
        <div class="order-table">
            <?php // $this->load->view('frontend/layout/leftwidgets', $this->data); ?>
            <?php $this->load->view('frontend/layout/homewidgets', $this->data); ?>
            <?php
            echo isset($add_error) ? $add_error : "";
            echo isset($add_success) ? $add_success : "";
            ?>
            <?php if (isset($signuperror) && !empty($signuperror)) { ?>
                <span class="error" style="float:none"><?php echo $signuperror; ?></span>
            <?php } ?>
            <?php if (isset($success) && !empty($success)) { ?>
                <span class="success" style="float:none"><?php echo $success; ?></span>
            <?php } ?>
            <h1 class="page-header"><span>Change Password</span></h1>
            <?php
            $old_password = array(
                'name' => 'old_password',
                'id' => 'old_password',
                'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
                'size' => 30,
                'class' => 'form-control'
            );
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
                    <span style="color: red">*</span> <?php echo form_label('Old Password', $old_password['id']); ?>
                    <?php echo form_password($old_password); ?>
                    <span style="color: red;"><?php echo form_error($old_password['name']); ?><?php echo isset($errors[$old_password['name']]) ? $errors[$old_password['name']] : ''; ?></span>
                </div>
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
