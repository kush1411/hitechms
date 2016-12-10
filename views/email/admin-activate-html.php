<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head><title><?php echo $this->lang->line('welcome_to'); ?><?php echo $site_name; ?>!</title></head>
    <body>
        <div style="max-width: 800px; margin: 0; padding: 30px 0;">

            <table width="100%" border="0" cellspacing="20" cellpadding="0" style="background:#08588D;">
                <tr>
                    <td style="padding:20px; background:#F3F3F3;">
                        <a href="<?php echo site_url() ?>">
                            <img src="<?php echo site_url() ?>assets/admin/img/logoadmin.png" alt="HiTechMS" title="HiTechMS" />
                        </a>
                    </td>

                </tr>
                <tr>
                    <td style="padding:20px; background:#fff;">

                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="5%"></td>
                                <td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
                                    <h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;"><?php echo $this->lang->line('welcome_to'); ?><?php echo $site_name; ?>!</h2>
                                    <?php echo $this->lang->line('joining_details'); ?>
                                    <br />
                                    <big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('login'); ?>" style="color: #3366cc;">Click here to login</a></b></big><br />
                                    <br />
                                    <?php echo $this->lang->line('link_not_work_copy_paste'); ?>
                            <nobr><a href="<?php echo site_url('login'); ?>" style="color: #3366cc;"><?php echo site_url('login'); ?></a></nobr><br />
                            <br />
                            <?php echo $this->lang->line('varify_within'); ?>
                            <?php echo $activation_period; ?> 
                            <?php echo $this->lang->line('other_wise_invalid'); ?>
                            <br />

                            <div style="background:#F3F3F3; padding:10px;"><strong><?php echo $this->lang->line('login_email'); ?><?php echo $email; ?></strong><br />
                                <strong><?php if (isset($password)) { ?><?php echo $this->lang->line('login_password'); ?> <?php echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $password; ?><br /><?php } ?></strong></div>

                            <br />
                            <?php echo $this->lang->line('have_fun'); ?>
                            <br />
                            <strong style="color:#08588D">The <?php echo $site_name; ?> Team</strong>
                    </td>
                </tr>
            </table>

        </td>

    </tr>
</table>
</div>
</body>
</html>