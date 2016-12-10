<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head><title><?php echo $this->lang->line('welcome_to'); ?><?php echo $site_name; ?>!</title></head>
    <body>
        <div style="max-width: 800px; margin: 0; padding: 30px 0;">
            <table width="80%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="5%"></td>
                    <td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
                        <h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Hi <?=$Name?>!</h2>
                            We Required Service For Following Parts, So Please Send Quotation By Use Of Following Link
                        <br />
                        <b>Product Information :</b>
                        <br/>
                        Product Name : <i><?=$Product->ProductName?></i>
                        <br />
                        Product Manufacturer : <i><?=$Product->MfgName?></i>
                        <br />
                        <big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo $link; ?>" style="color: #3366cc;"><?php echo $this->lang->line('finsih_registration'); ?></a></b></big><br />
                        <br />
                        <?php echo $this->lang->line('link_not_work_copy_paste'); ?>
                <nobr><a href="<?php echo $link; ?>" style="color: #3366cc;"><?php echo $link; ?></a></nobr><br />
                <br />
                Please Send Quotation As Soon As Possible
                <br />
                Because We Have Emergency
                <br />
                <br />
                <b>Company Information :</b><br />
                <i><?=$company->user_profile->code?></i>
                <br/>
                Address : <i><?=$company->user_profile->address?></i>
                <br/>
                City : <i><?=$company->user_profile->city?></i>
                <br/>
                State : <i><?=$company->user_profile->state?></i>
                <br/>
                Country : <i><?=$company->user_profile->country?> - <?=$company->user_profile->zip?></i>
                <br/>
                Contact No : <i><?=$company->user_profile->telephone?></i>
                <br />
                <br />
                <?php echo $this->lang->line('have_fun'); ?>
                <br />
                The <?php echo $site_name; ?> Team
                </td>
                </tr>
            </table>
        </div>
    </body>
</html>