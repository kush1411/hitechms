
<!-- BEGIN CONTENT-->
<div id="content">
    <section class="style-default-bright">
        <div class="section-header">
            <h2 class="text-primary">View Admin</h2>
        </div>
        <div class="section-body">
            <!-- BEGIN DATATABLE 1 -->
            <div class="row">
                <div class="col-md-8">
                    <article class="margin-bottom-xxl">
                        <p class="lead">
                            User that's have admin rights to login on this panel
                        </p>
                    </article>
                </div><!--end .col -->
            </div><!--end .row -->
            <div class="row">
                <div class="col-lg-12 margin-bottom-10">
                    <?php if ($userRights['add']) { ?>
                        <a href = "<?php echo base_url() ?>admin/admin/add" class="btn btn-info btn-xs btn-raised pull-right" >Add Admin</a>
                    <?php } ?>
                    <?php
                    if ($userRights['delete']) {
                        $frmaction = 'admin/' . $controller . '/delete';
                        $attributes = 'id="frmDelete"';
                        echo form_open($frmaction, $attributes);
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
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <?php if (isset($allAdminuser) && !empty($allAdminuser)) { ?>
                            <table id="datatable1" class="table table-striped table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <?php if ($userRights['edit'] || $userRights['delete']) { ?>  <th><?php echo form_checkbox("selectAll", '', '', 'onclick=toggleChecks(this);id="selectall"'); ?></th>   <?php } ?>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th class="sort">Created Date</th>
                                        <?php if ($userRights['edit'] || $userRights['delete']) { ?> <th class="sort">Action</th><?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allAdminuser as $user) { ?>
                                        <tr class="odd gradeX <?php echo (!$user->admingroup->status) ? 'deactiveRow' : ''; ?>">
                                            <?php if ($userRights['edit'] || $userRights['delete']) { ?>
                                                <td><?php echo ($user->id != '1' && $user->id != $this->session->userdata[SITE_NAME . '_admin_user_data']['user_id']) ? form_checkbox("option[]", $user->id, '', 'class="case"') : ''; ?></td>
                                            <?php } ?>
                                            <td class="sorting_1"><?php echo $user->email; ?></td>
                                            <td class="sorting_1"><?php echo $user->username; ?></td>
                                            <td>
                                                <?php if ($user->id == '1' || $this->session->userdata[SITE_NAME . '_admin_user_data']['user_id'] == $user->id) { ?>
                                                    <?php if ($user->activated == '1') { ?>
                                                        <a href="javascript:void(0)" class="btn-mini btn-black btn-active"><i class="md md-check btn btn-info btn-xs btn-raised "></i></a> 
                                                    <?php } else { ?>
                                                        <a href="javascript:void(0)" class="btn-mini btn-black btn-deactive"><i class="md md-close btn btn-warning btn-xs btn-raised "></i></a>                              
                                                        <?php
                                                    }
                                                } else if ($user->activated == '1') {
                                                    $statusAction = 'javascript:void(0);';
                                                    if ($userRights['edit']) {
                                                        $statusAction = base_url("admin/deactive/" . $user->id);
                                                    }
                                                    ?>
                                                    <a href="<?php echo $statusAction ?>" id="deactive" title="Active" class="btn-mini btn-black btn-active"><i class="md md-check btn btn-info btn-xs btn-raised "></i></a> 
                                                    <?php
                                                } else {
                                                    $statusAction = '';
                                                    $statusAction = 'javascript:void(0);';
                                                    if ($userRights['edit']) {
                                                        $statusAction = base_url("admin/active/" . $user->id);
                                                    }
                                                    ?>
                                                    <a href="<?php echo $statusAction; ?>" id="active_priori" title="De-active" class="btn-mini btn-black btn-deactive"><i class="md md-close btn btn-warning btn-xs btn-raised "></i></a>                              
                                                <?php } ?>
                                            </td>
                                            <td class="center"><?php echo date("d-m-Y", strtotime($user->created)); ?></td>
                                            <?php if ($userRights['edit'] || $userRights['delete']) { ?> <td class="center">
                                                <?php
                                                if ($user->id != '1' && $user->id != $this->session->userdata[SITE_NAME . '_admin_user_data']['user_id']) {
                                                    if ($userRights['edit']) {
                                                        ?>
                                                            <a href="<?php echo base_url() ?>admin/edit/<?php echo $user->id; ?>" title="Edit" class=""><i class="md md-edit btn btn-success btn-xs btn-raised "></i></a>
                                                        <?php } if ($userRights['delete']) { ?>
                                                            <a href="<?php echo base_url() ?>admin/admin/delete/<?php echo $user->id ?>" title="Delete" class="alertme"><i class="md md-delete btn btn-danger btn-xs btn-raised "></i></a>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                        <div>No Action </div>
                                                    <?php } ?>
                                                </td><?php } ?>
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
            </div><!--end .row -->
        </div><!--end .section-body -->
    </section>
</div><!--end #content-->
<!-- END CONTENT -->
