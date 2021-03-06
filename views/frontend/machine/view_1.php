
<!-- BEGIN CONTENT-->
<div id="content">
    <section class="style-default-bright">
        <div class="section-header">
            <h2 class="text-primary">View Machine</h2>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12 margin-bottom-10">
                    <?php
                    if ($userRights['add']) {
                        ?>
                        <a href = "<?php echo base_url() ?>machine/add" class="btn btn-info btn-xs btn-raised pull-right">Add Machine</a>
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
                        $frmaction = 'machine/delete';
                        $attributes = 'method="POST" id="frmDelete"';
                        echo form_open($frmaction, $attributes);
                    }
                        ?>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <?php if (isset($allmachine) && !empty($allmachine)) { ?>
                            <table id="datatable1" class="table table-striped table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <?php if ($userRights['edit'] || $userRights['delete']) { ?>  <th><?php echo form_checkbox("selectAll", '', '', 'onclick=toggleChecks(this);id="selectall"'); ?></th>   <?php } ?>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th>Mfg</th>
                                        <th>Location</th>
                                        <th>Purchase Dt</th>
                                        <th>Purchase Amt</th>
                                        <th>Actual Amt</th>
                                        <th>Bill No</th>
                                        <th>Serial No</th>
                                        <th>Remarks</th>
                                        <th>Status</th>
                                        <th class="sort">Created Date</th>
                                        <?php if ($userRights['edit'] || $userRights['delete']) { ?> <th class="sort">Action</th><?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allmachine as $user) { ?>
                                        <tr class="odd gradeX">
                                            <?php if ($userRights['edit'] || $userRights['delete']) { ?> 
                                                <td><?php echo form_checkbox("option[]", $user->MachID, '', 'class="case"'); ?>
                                                </td>
                                            <?php } ?>
                                            <td class="sorting_1"><?php echo $user->MachCode; ?></td>
                                            <td class="sorting_1"><?php echo $user->MachName; ?></td>
                                            <td class="">
                                                <?php echo trim($user->CatName) ?>
                                            </td>
                                            <td class="">
                                                <?php echo trim($user->TypeName) ?>
                                            </td>
                                            <td class="">
                                                <?php echo trim($user->MfgName) ?>
                                            </td>
                                            <td class="">
                                                <?php echo trim($user->LocName) ?>
                                            </td>
                                            <td class="">
                                                <?php echo trim($user->MachPurDate) ?>
                                            </td>
                                            <td>
                                                <?php echo $user->MachPurAmt; ?>
                                            </td>
                                            <td>
                                                <?php echo $user->MachCurrAmt; ?>
                                            </td>
                                            <td>
                                                <?php echo $user->MachBillNo; ?>
                                            </td>
                                            <td>
                                                <?php echo $user->MachSerialNo; ?>
                                            </td>
                                            <td>
                                                <?php echo $user->MachRemarks; ?>
                                            </td>
                                            <td>
                                                <?php if ($user->MachStatus == '1') {
                                                    $statusAction = 'javascript:void(0);';
                                                    if ($userRights['edit']) {
                                                        $statusAction = base_url("machine/deactivate/" . $user->MachID);
                                                    }
                                                    ?>
                                                    <a href="<?php echo $statusAction ?>" id="deactive" title="Active" class="btn-mini btn-black btn-active"><i class="md md-edit btn btn-success btn-xs btn-raised "></i></a> 
                                                    <?php
                                                } else {
                                                    $statusAction = '';
                                                    $statusAction = 'javascript:void(0);';
                                                    if ($userRights['edit']) {
                                                        $statusAction = base_url("machine/activate/" . $user->MachID);
                                                    }
                                                    ?>
                                                    <a href="<?php echo $statusAction; ?>" id="active_priori" title="De-active" class="btn-mini btn-black btn-deactive"><i class="md md-close btn btn-success btn-xs btn-raised "></i></a>                              
                                                <?php } ?>
                                            </td>
                                            <td class="center"><?php echo date("d-m-Y", strtotime($user->InsDateTime)); ?></td>
                                            <td class="center">
												<a href="<?php echo base_url() ?>machine/view/<?php echo $user->MachID; ?>" title="View" class="btn-view"><i class="md md-remove-red-eye btn btn-info btn-xs btn-raised "></i></a>
                                                <?php
                                                    if ($userRights['edit']) {
                                                        ?>
                                                        <a href="<?php echo base_url() ?>machine/edit/<?php echo $user->MachID; ?>" title="Edit" class="btn-edit"><i class="md md-edit btn btn-success btn-xs btn-raised "></i></a>
                                                    <?php } if ($userRights['delete']) { ?>
                                                        <a href="<?php echo base_url() ?>machine/delete/<?php echo $user->MachID ?>"  title="Delete" class="btn-cross alertme"><i class="md md-delete btn btn-danger btn-xs btn-raised "></i></a>        
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