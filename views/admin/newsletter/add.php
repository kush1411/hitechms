<?php
//echo '<pre>';print_r($editdata);exit;
$title = array('name' => 'newsletterName',
    'id' => 'newsletterName',
    'value' => isset($editdata) && isset($editdata->newslettername) ? $editdata->newslettername : (isset($postdata) && isset($postdata->newsletterName) ? $postdata->newsletterName : ""),
    'class' => 'mini');

$long_desc = isset($editdata) && isset($editdata->newsletter_content) ? $editdata->newsletter_content : (isset($postdata) && isset($postdata->newsletter_content) ? $postdata->newsletter_content : "");
?>
<h2>Add Newsletter</h2>
<div class="block ">

    <?php
//    echo '<pre>';print_r($action);exit;
    if ($action == 'edit') {
        echo form_open("admin/newsletters/edit/" . $editdata->id, "id=addnewsletter");
    }
    echo form_open('admin/newsletters/add', 'id="addnewsletter"');
    ?>
    <table class="form">
        <tr>
            <td valign="top">
                <?php echo form_label('Newsletter Name '); ?><label style="color:red;">*</label> 
            </td>
            <td>
                <?php echo form_input($title); ?>
                <?php if (form_error('title')) { ?>
                    <div id="error" style="display: <?php echo (form_error('title') != '') ? 'block' : 'none'; ?>">
                        <div class="error-left"></div>
                        <div class="error-inner"><?php echo (form_error('title') != '') ? form_error('title') : 'This field is required.'; ?></div>
                    </div>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td valign="top">
                <?php echo form_label('Long Description'); ?>
            </td>
            <td>
                <textarea name="newsletter_content" id="newsletter_content" style="width:100%"><?php echo $long_desc; ?></textarea>
                <?php // form_textarea($long_desc)     ?>
                <?php if (form_error('newsletter_content')) { ?>
                    <div id="error" style="display: <?php echo (form_error('newsletter_content') != '') ? 'block' : 'none'; ?>">
                        <div class="error-left"></div>
                        <div class="error-inner"><?php echo (form_error('newsletter_content') != '') ? form_error('newsletter_content') : 'This field is required.'; ?></div>
                    </div>
                <?php } ?>
            </td>
        </tr>
        <tr id="submit">
            <td>&nbsp;</td>
            <td valign="top">
                <input type="submit" id="sumbit" value="Submit" class="btn btn-blue" />
                <?php if ($action != 'edit') { ?><input type="reset" value="reset" class="btn btn-blue"  /><?php } ?>
            </td>
            <td></td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>
