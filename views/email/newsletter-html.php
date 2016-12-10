<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head><title>Subscribed a Newsletter<?php echo $site_name; ?></title></head>
    <body>
        <div style="max-width: 800px; margin: 0; padding: 30px 0;">
            <table width="100%" border="0" cellspacing="20" cellpadding="0" style="background:#08588D;">
                <tr>
                    <td style="padding:20px; background:#F3F3F3;">
                        <a href="<?php echo site_url() ?>">
                            <img src="<?php echo site_url() ?>assets/frontend/images/logo.png" alt="Cozysham" title="Cozysham" />
                        </a>
                    </td>

                </tr>
                <tr>
                    <td style="padding:20px; background:#fff;">

                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="5%"></td>
                                <td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
                                    <h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Subscribe Newsletter</h2>
                                    <br />
                                    To subscribed newsletter, just follow this link:<br />
                                    <br />
                                    <big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo $link ?>" style="color: #3366cc;">Click Here</a></b></big><br />
                                    <br />
                            <nobr><a href="<?php echo $link; ?>" style="color: #3366cc;"></a></nobr><br />
                            <div>
                                To stop receiving these emails, you may unsubscribe now.
                                <a href="<?php echo site_url('frontend/home/unsubscribenewsletter'); ?>" style="color: #3366cc;">Click here</a><br />
                            </div>
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

