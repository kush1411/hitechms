
<!-- BEGIN CONTENT-->
<div id="content">
    <section class="style-default-bright">
        <div class="section-header">
            <h2 class="text-primary">View Members</h2>
        </div>
        <div class="section-body">
            <!-- BEGIN DATATABLE 1 -->
            <div class="row">
                <div class="col-md-8">
                    <article class="margin-bottom-xxl">
                        <p class="lead">
                            User that's have Organization Or Company Or Firm
                        </p>
                    </article>
                </div><!--end .col -->
            </div><!--end .row -->
            <div class="row">
                    <?php
                    if ($userRights['add']) {
                        ?>
                        <a href = "<?php echo base_url() ?>admin/members/add"  class="btn btn-info btn-xs btn-raised pull-right" >Add Member</a>
                    <?php } ?>
                    <?php
                    if ($userRights['delete']) {
                        $frmaction = 'admin/' . $controller . '/delete';
                        $attributes = 'id="frmDelete"';
                        echo form_open($frmaction, $attributes);
                        ?>
                        <a href = "javascript:void(0)" onclick="checkValid();" class="btn btn-danger btn-xs btn-raised pull-left">Delete Rows</a>
                    <?php   } ?>

               
                <div class="col-lg-12">

                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <?php if (isset($allusers) && !empty($allusers)) { ?>
                            <table id="datatable1" class="data display datatable" width="100%">
                                <thead>
                                    <tr>
                                        <?php if ($userRights['edit'] || $userRights['delete']) { ?>  <th><?php echo form_checkbox("selectAll", '', '', 'onclick=toggleChecks(this);id="selectall"'); ?></th>   <?php } ?>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th class="sort">Created Date</th>
                                        <?php if ($userRights['edit'] || $userRights['delete']) { ?> <th class="sort">Action</th><?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allusers as $user) { ?>
                                        <tr class="odd gradeX">

                                            <?php if ($userRights['edit'] || $userRights['delete']) { ?> <td><?php echo form_checkbox("option[]", $user->id, '', 'class="case"'); ?></td><?php } ?>

                                            <td class="sorting_1"><?php echo $user->firstname; ?>
                                            <td class="sorting_1"><?php echo $user->lastname; ?>
                                            <td class="sorting_1"><?php echo $user->email; ?></td>

                                            <td>
                                                <?php
                                                if ($user->activated == '1') {
                                                    $statusAction = 'javascript:void(0);';

                                                    $statusAction = base_url("admin/members/deactivate/" . $user->id);
                                                    ?>
                                                    <a href="<?php echo $statusAction ?>" id="deactive" title="Active" class="btn-mini btn-black btn-active"><i class="md md-check btn btn-info btn-xs btn-raised "></i></a> 
                                                    <?php
                                                } else {
                                                    $statusAction = '';
                                                    $statusAction = 'javascript:void(0);';

                                                    $statusAction = base_url("admin/members/activate/" . $user->id);
                                                    ?>
                                                    <a href="<?php echo $statusAction; ?>" id="active_priori" title="De-active" class="btn-mini btn-black btn-deactive"><i class="md md-close btn btn-warning btn-xs btn-raised "></i></a>                              
                                                <?php } ?>
                                            </td>
                                            <td class="center"><?php echo date("d-m-Y", strtotime($user->insdatetime)); ?></td>
                                            <?php if ($userRights['edit'] || $userRights['delete']) { ?><td class="center">


                                                    <?php if ($userRights['edit']) { ?> 
                                                        <a href="<?php echo base_url() ?>admin/members/edit/<?php echo $user->id; ?>" title="Edit" class="btn-mini btn-black btn-edit"><i class="md md-edit btn btn-success btn-xs btn-raised "></i></a>
                                                    <?php } ?>
                                                    <?php if ($userRights['delete']) { ?> 
                                                        <a href="<?php echo base_url() ?>admin/members/delete/<?php echo $user->id; ?>" title="Delete" class="btn-mini btn-black btn-cross alertme"><i class="md md-delete btn btn-danger btn-xs btn-raised "></i></a>        
                                                            <?php } ?>
                                                        <a href="<?php echo base_url() ?>admin/members/details/<?php echo $user->id; ?>" title="View Details"><i class="md md-remove-red-eye btn btn-info btn-xs btn-raised "></i></a>        

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
                <?php echo form_close(); ?>
            </div><!--end .row -->
        </div><!--end .section-body -->
    </section>
</div><!--end #content-->
<!-- END CONTENT -->
