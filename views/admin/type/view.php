
<!-- BEGIN CONTENT-->
<div id="content">
    <section class="style-default-bright">
        <div class="section-header">
            <h2 class="text-primary">View Type</h2>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12 margin-bottom-10">
                    <?php
                    if ($userRights['add']) {
                        ?>
                        <a href = "<?php echo base_url() ?>admin/type/add" class="btn btn-info btn-xs btn-raised pull-right">Add Type</a>
                    <?php } ?>
                    <?php
                    if ($userRights['delete']) {
                        ?>
                        <a href = "javascript:void(0)" onclick="checkValid();" class="btn btn-danger btn-xs btn-raised pull-left">Delete Rows</a>
                    <?php } ?>
                </div>
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <?php
                    if ($userRights['delete']) {
                        $frmaction = 'admin/' . $controller . '/delete';
                        $attributes = 'method="POST" id="frmDelete"';
                        echo form_open($frmaction, $attributes);
                    }
                        ?>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <?php if (isset($alltype) && !empty($alltype)) { ?>
                            <table id="datatable1" class="table table-striped table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <?php if ($userRights['edit'] || $userRights['delete']) { ?>  <th><?php echo form_checkbox("selectAll", '', '', 'onclick=toggleChecks(this);id="selectall"'); ?></th>   <?php } ?>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Mfg Company</th>
                                        <th>Status</th>
                                        <th class="sort">Created Date</th>
                                        <?php if ($userRights['edit'] || $userRights['delete']) { ?> <th class="sort">Action</th><?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($alltype as $user) { ?>
                                        <tr class="odd gradeX">
                                            <?php if ($userRights['edit'] || $userRights['delete']) { ?> 
                                                <td><?php echo form_checkbox("option[]", $user->TypeID, '', 'class="case"'); ?>
                                                </td>
                                            <?php } ?>
                                            <td class="sorting_1"><?php echo $user->TypeName; ?></td>
                                            <td class=""><?php echo $user->CatName; ?></td>
                                            <td class=""><?php echo $user->MfgName; ?></td>
                                            <td>
                                                <?php if ($user->Status == '1') {
                                                    $statusAction = 'javascript:void(0);';
                                                    if ($userRights['edit']) {
                                                        $statusAction = base_url("admin/type/deactivate/" . $user->TypeID);
                                                    }
                                                    ?>
                                                    <a href="<?php echo $statusAction ?>" id="deactive" title="Active" class="btn-mini btn-black btn-active"><i class="md md-check btn btn-info btn-xs btn-raised "></i></a> 
                                                    <?php
                                                } else {
                                                    $statusAction = '';
                                                    $statusAction = 'javascript:void(0);';
                                                    if ($userRights['edit']) {
                                                        $statusAction = base_url("admin/type/activate/" . $user->TypeID);
                                                    }
                                                    ?>
                                                    <a href="<?php echo $statusAction; ?>" id="active_priori" title="De-active" class="btn-mini btn-black btn-deactive"><i class="md md-close btn btn-warning btn-xs btn-raised "></i></a> md-close btn btn-warning                             
                                                <?php } ?>
                                            </td>
                                            <td class="center"><?php echo date("d-m-Y", strtotime($user->InsDateTime)); ?></td>
                                            <td class="center">
                                                <?php
                                                    if ($userRights['edit']) {
                                                        ?>
                                                        <a href="<?php echo base_url() ?>admin/type/edit/<?php echo $user->TypeID; ?>" title="Edit" class="btn-edit"><i class="md md-edit btn btn-success btn-xs btn-raised "></i></a>
                                                    <?php } if ($userRights['delete']) { ?>
                                                        <a href="<?php echo base_url() ?>admin/type/delete/<?php echo $user->TypeID ?>"  title="Delete" class="btn-cross alertme"><i class="md md-delete btn btn-danger btn-xs btn-raised "></i></a>        
                                                            <?php
                                                        }
                                                        ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                        } else {
                            echo "There is no data to display";
                        }
                        ?>
                    </div>
                </div>
                <?php
                    if ($userRights['delete']) {
                        echo form_close();
                    }?>
            </div><!--end .row -->
        </div><!--end .section-body -->
    </section>
</div><!--end #content-->
<!-- END CONTENT -->