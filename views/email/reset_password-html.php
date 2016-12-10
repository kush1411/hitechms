<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head><title>Reset Password<?php echo $site_name; ?></title></head>
    <body>
        <div style="max-width: 800px; margin: 0; padding: 30px 0;">
            <table width="100%" border="0" cellspacing="20" cellpadding="0" style="background:#002032;">
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
                                    <h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Your new password on <?php echo $site_name; ?></h2>
                                    <br />
                                    This email confirms that your password has been changed.
                                    <br />
                                    You have changed your password OR admin change your password.<br />
                                    Please, keep it in your records so you don't forget it.<br />
                                    <br />
                                    <b>Organization Code : </b> <?php echo $OrgCode; ?><br />
                                    <b>Username : </b> <?php echo $UserName; ?><br />
                                    <b>Password : </b> <?php echo $UserPass; ?>
                                    <br />
                                    <br />
                                    If you have any question or encounter any problems logging in, Please <br /> contact a site administrator.
                                    <br />
                                    <br />
                                    Thank you,
                                    <br /> 
                                    <strong style="color:#002032">The <?php echo $site_name; ?> Team</strong>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>