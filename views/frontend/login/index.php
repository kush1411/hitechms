    <section>
    <div id="content-section" class="clearfix"> 
        <div class="order-table">
            <?php // $this->load->view('frontend/layout/leftwidgets', $this->data); ?>
            <?php $this->load->view('frontend/layout/homewidgets', $this->data); ?>
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
            <?php // $this->load->view('frontend/layout/leftwidgets', $this->data); ?>
            <div class="order-tablular clearfix">
                <?php
                $this->load->view('frontend/login/login');
                $this->load->view('frontend/login/register');
                ?>
                <!-- Right widgets -->
                <?php // $this->load->view('frontend/layout/rightwidgets', $this->data); ?>
                <!-- end widgets --> 
                <!-- Popup -->

                <!-- Right widgets -->
                <?php // $this->load->view('frontend/layout/rightwidgets', $this->data); ?>
                <!-- end widgets --> 
                <!-- Popup -->
                <div id="dialog" class="popup-module"></div>
                <!-- end Popup --> 
                <div class="clr">&nbsp;</div>
            </div>
        </div> 
</section>

