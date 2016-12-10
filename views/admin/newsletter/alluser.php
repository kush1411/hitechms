<h2>View Users</h2>
<?php
//            if ($add_error)
//                echo $add_error;
//            if ($add_success)
//                echo $add_success;
            ?>
<a href="<?php echo base_url('admin/newsletters/list') ?>" class="btn btn-blue">Back</a>
<div style="clear:both; visiblity:hidden; height:1px">&nbsp;</div>
<div class="block">
    <?php if ($this->session->flashdata('error_message')) { ?> <div class="message success"><?php echo $this->session->flashdata('error_message'); ?></div><?php } ?>
    <?php echo form_open('admin/newsletters/mail', 'id="send_mail"'); ?>
    <table id="product-table" class="data display datatable" width="100%">
        <thead>
            <tr>
                <th>Email</th>
                <th>status</th>
                <th><?php echo form_checkbox("selectAll", '', '', 'onclick=toggleChecks(this);id="selectall"'); ?></th>
            </tr>
        </thead>
        <tbody>

            <?php
            if (isset($alluser) && count($alluser) > 0) {
                foreach ($alluser as $m) {
                    if ($m->status == '1') {
                        $color = "";
                    } else {
                        $color = "red";
                    }
                    ?>
                    <tr style="color: <?php echo $color; ?>">
                        <td><?php echo $m->email; ?></td>
                        <td>
                            <?php
                            if ($m->status == '1') {
                                $statusAction = 'javascript:void(0);';
                                if ($userRights['edit']) {
                                    $statusAction = base_url("admin/newsletters/deactivate/" . $m->id);
                                }
                                ?>
                                <a href="<?php echo $statusAction ?>" id="deactive" title="Active" class="btn-mini btn-black btn-active"><i class="md md-edit btn btn-success btn-xs btn-raised "></i></a> 
                                <?php
                            } else {
                                $statusAction = '';
                                $statusAction = 'javascript:void(0);';
                                if ($userRights['edit']) {
                                    $statusAction = base_url("admin/newsletters/activate/" . $m->id);
                                }
                                ?>
                                <a href="<?php echo $statusAction; ?>" id="active_priori" title="De-active" class="btn-mini btn-black btn-deactive"><i class="md md-close btn btn-success btn-xs btn-raised "></i></a>                              
                            <?php } ?>
                        </td>
                        <td class="options-width">
                            <?php if ($m->status == '1') { ?>
                                <?php echo form_checkbox("mail[]", $m->email, '', 'class="case"'); ?>
                                            <!--<input type="checkbox" value="<?php // echo $m->email   ?>" name="mail[]">-->
                            <?php } ?>

                        </td>

                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="11">
                        <b>There is no data to display</b>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <p><br />
        <input type="submit" name="send_mail" value="Send mail" class="btn btn-blue">
    </p><br/>
    <input type="hidden" name="newsletter_id" value="<?php echo $this->uri->segment(4) ?>"/>
    <?php echo form_close(); ?>
</div>
