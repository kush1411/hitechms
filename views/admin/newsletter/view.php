<h2>View Newsletter</h2>
<?php
if ($userRights['add']) {
    ?>
    <p class="fl "><br /><a href = "<?php echo base_url() ?>admin/newsletters/add" class="btn btn-blue" style="float:left">Add Newsletter</a></p>
<?php } ?>
<?php
if ($userRights['delete']) {
    $frmaction = 'admin/' . $controller . '/delete';
    $attributes = 'id="frmDelete"';
    echo form_open($frmaction, $attributes);
    ?>
    <p class="fl marginleft10"><br /><a href = "javascript:void(0)" onclick="checkValid();" class="btn btn-blue" style="float:left">Delete Rows</a></p>
<?php } ?>
<div style="clear:both; visiblity:hidden; height:1px">&nbsp;</div>
<div class="block">
    <?php echo $add_error; ?>
    <?php echo $add_warning; ?>
    <?php echo $add_info; ?>
    <?php echo $add_success; ?>
    <?php if (isset($alldata) && count($alldata) > 0) { ?>
        <table id="product-table" class="data display datatable" width="100%">
            <thead>
                <tr>
                    <?php if ($userRights['edit'] || $userRights['delete']) { ?>  <th><?php echo form_checkbox("selectAll", '', '', 'onclick=toggleChecks(this);id="selectall"'); ?></th>   <?php } ?>
                    <th>Newsletter Name</th>
                    <th>Newsletter Content</th>
                    <th class="sort">Created Date</th>
                    <?php if ($userRights['edit'] || $userRights['delete']) { ?><th class="sort">Action</th><?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alldata as $newsletter) { ?>
                    <tr class="odd gradeX">
                        <?php if ($userRights['edit'] || $userRights['edit']) { ?>
                            <td><?php echo form_checkbox("option[]", $newsletter->id, '', 'class="case"'); ?></td>
                        <?php } ?>
                        <td class="sorting_1"><?php echo $newsletter->newslettername; ?></td>
                        <td class="sorting_1"><?php echo substr($newsletter->newsletter_content, 0, 50); ?></td>

                        <td class="center"><?php echo date("d-m-Y", strtotime($newsletter->created)); ?></td>
                        <?php if ($userRights['edit'] || $userRights['delete']) { ?><td class="center">
                            <?php
                            if ($userRights['edit']) {
                                ?>
                                    <a href="<?php echo base_url() ?>admin/newsletters/edit/<?php echo $newsletter->id; ?>" title="Edit" class="btn-mini btn-black btn-edit"><span></span>Edit</a>
                                <?php } if ($userRights['delete']) { ?>
                                    <a href="<?php echo base_url() ?>admin/newsletters/delete/<?php echo$newsletter->id; ?>" title="Delete" class="btn-mini btn-black btn-cross"><span></span>Delete</a>        
                                <?php } ?>
                                <a href="<?php echo base_url() ?>admin/newsletters/send_mail/<?php echo$newsletter->id; ?>" title="Send to selected" class="btn-mini btn-black btn-send"><span></span>Send To Selected</a>
                                <a href="<?php echo base_url() ?>admin/newsletters/send_to_all/<?php echo$newsletter->id; ?>" title="Send to all" class="btn-mini btn-black btn-send-to-all"><span></span>Send To All</a>
                            </td><?php } ?>
                    </tr>
                    <?php
                }
                ?>

            <div>&nbsp;</div>



            </tbody>
        </table>
        <?php
    } else {
        echo "There is no data to display";
    }
    ?>
</div>
