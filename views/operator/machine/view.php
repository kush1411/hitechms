
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
                        <a href = "<?php echo base_url() ?>operator/machine/add" class="btn btn-info btn-xs btn-raised pull-right">Add Machine</a>
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
                    $frmaction = 'operator/machine/delete';
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

                                            <td>
                                                <?php
                                                if (($userRights['edit'] || $userRights['delete']) && $user->MachStatus == '0') {
                                                    echo form_checkbox("option[]", $user->MachID, '', 'class="case"');
                                                }
                                                ?>
                                            </td>

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
                                                <?php
                                                if ($user->MachStatus == '1') {
                                                    echo 'Approve';
                                                } else {
                                                    echo 'Pending';
                                                }
                                                ?>
                                            </td>
                                            <td class="center"><?php echo date("d-m-Y", strtotime($user->InsDateTime)); ?></td>
                                            <td class="center">
                                                <a href="<?php echo base_url() ?>operator/machine/view/<?php echo $user->MachID; ?>" title="View" class="btn-view"><i class="md md-remove-red-eye btn btn-info btn-xs btn-raised "></i></a>
                                                <?php
                                                if ($userRights['edit'] && $user->MachStatus == '0') {
                                                    ?>
                                                    <a href="<?php echo base_url() ?>operator/machine/edit/<?php echo $user->MachID; ?>" title="Edit" class="btn-edit"><i class="md md-edit btn btn-success btn-xs btn-raised "></i></a>
                                                <?php } if ($userRights['delete'] && $user->MachStatus == '0') { ?>
                                                    <a href="<?php echo base_url() ?>operator/machine/delete/<?php echo $user->MachID ?>"  title="Delete" class="btn-cross alertme"><i class="md md-delete btn btn-danger btn-xs btn-raised "></i></a>        
                                                    <?php
                                                }
                                                ?>
                                                <?php if ($userRights['edit'] && $user->MachStatus == '1') { ?>
                                                    <a href="<?php echo base_url() ?>operator/machine/info/<?php echo $user->MachID ?>"  title="Machine Info" class="fancybox fancybox.ajax"><i class="md md-assignment btn btn-success btn-xs btn-raised "></i></a>
                                                <?php } ?>
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
                }
                ?>
            </div><!--end .row -->
        </div><!--end .section-body -->
    </section>
</div><!--end #content-->
<!-- END CONTENT -->
<script type="text/javascript" src="<?= base_url() ?>assets/frontend/lib/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/lib/jquery.fancybox.css" media="screen" />
<script type="text/javascript">
                            $(document).ready(function () {
                                $('.fancybox').fancybox();
                            });
</script>