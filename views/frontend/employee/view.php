
<!-- BEGIN CONTENT-->
<div id="content">
    <section class="style-default-bright">
        <div class="section-header">
            <h2 class="text-primary">View Employee</h2>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12 margin-bottom-10">
                    <?php
                    if ($userRights['add']) {
                        ?>
                        <a href = "<?php echo base_url() ?>employee/add" class="btn btn-info btn-xs btn-raised pull-right">Add Employee</a>
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
                        $frmaction = 'employee/delete';
                        $attributes = 'method="POST" id="frmDelete"';
                        echo form_open($frmaction, $attributes);
                    }
                        ?>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <?php if (isset($allemployee) && !empty($allemployee)) { ?>
                            <table id="datatable1" class="table table-striped table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <?php if ($userRights['edit'] || $userRights['delete']) { ?>  <th><?php echo form_checkbox("selectAll", '', '', 'onclick=toggleChecks(this);id="selectall"'); ?></th>   <?php } ?>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Location</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Sift</th>
                                        <th>Salary</th>
                                        <th>Joining Dt.</th>
                                        <th>Left Ft.</th>
                                        <th>Remarks</th>
                                        <th>Status</th>
                                        <th class="sort">Created Date</th>
                                        <?php if ($userRights['edit'] || $userRights['delete']) { ?> <th class="sort">Action</th><?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allemployee as $user) { ?>
                                        <tr class="odd gradeX">
                                            <?php if ($userRights['edit'] || $userRights['delete']) { ?> 
                                                <td><?php echo form_checkbox("option[]", $user->EmpID, '', 'class="case"'); ?>
                                                </td>
                                            <?php } ?>
                                            <td class="sorting_1"><?php echo $user->EmpName; ?></td>
                                            <td class=""><?php echo $user->DesigName; ?></td>
                                            <td><?php echo $user->LocationName; ?></td>
                                            <td class="">
                                                <?php //echo trim($user->EmpAddr1.', '.$user->EmpAddr2,', ').'<br>'; ?>
                                                <?php echo trim($user->EmpCity.', '.$user->EmpState,', ').'<br>'; ?>
                                                <?php echo trim($user->EmpCountry.' - '.$user->EmpPincode,' - ').'<br>'; ?>
                                            </td>
                                            <td class="">
                                                <?php echo trim($user->EmpContact1.', '.$user->EmpContact2,', ').'<br>'; ?>
                                            </td>
                                            <td>
                                                <?php echo $user->EmpShift; ?>
                                            </td>
                                            <td>
                                                <?php echo $user->EmpSalary; ?>
                                            </td>
                                            <td>
                                                <?php echo date('d-m-Y',strtotime($user->EmpJoinDat)); ?>
                                            </td>
                                            <td>
                                                <?php echo $user->EmpLeftOn != '' ? date('d-m-Y',strtotime($user->EmpLeftOn)) : ''; ?>
                                            </td>
                                            <td>
                                                <?php echo $user->EmpRemarks; ?>
                                            </td>
                                            <td>
                                                <?php if ($user->EmpStatus == '1') {
                                                    $statusAction = 'javascript:void(0);';
                                                    if ($userRights['edit']) {
                                                        $statusAction = base_url("employee/deactivate/" . $user->EmpID);
                                                    }
                                                    ?>
                                                    <a href="<?php echo $statusAction ?>" id="deactive" title="Active" class="btn-mini btn-black btn-active"><i class="md md-check btn btn-info btn-xs btn-raised "></i></a> 
                                                    <?php
                                                } else {
                                                    $statusAction = '';
                                                    $statusAction = 'javascript:void(0);';
                                                    if ($userRights['edit']) {
                                                        $statusAction = base_url("employee/activate/" . $user->EmpID);
                                                    }
                                                    ?>
                                                    <a href="<?php echo $statusAction; ?>" id="active_priori" title="De-active" class="btn-mini btn-black btn-deactive"><i class="md md-close btn btn-warning btn-xs btn-raised "></i></a>                              
                                                <?php } ?>
                                            </td>
                                            <td class="center"><?php echo date("d-m-Y", strtotime($user->InsDateTime)); ?></td>
                                            <td class="center">
                                                <?php
                                                    if ($userRights['edit']) {
                                                        ?>
                                                <?php if($user->DesigName == 'Computer Operator' || $user->DesigName == 'Accountant'){?>
                                                        <a href="<?php echo base_url() ?>employee/login/<?php echo $user->EmpID; ?>" title="Generate Login" class="btn-login"><i class="md md-remove-red-eye btn btn-info btn-xs btn-raised "></i></a>
                                                <?php } ?>
                                                        <a href="<?php echo base_url() ?>employee/edit/<?php echo $user->EmpID; ?>" title="Edit" class="btn-edit"><i class="md md-edit btn btn-success btn-xs btn-raised "></i></a>
                                                    <?php } if ($userRights['delete']) { ?>
                                                        <a href="<?php echo base_url() ?>employee/delete/<?php echo $user->EmpID ?>"  title="Delete" class="btn-cross alertme"><i class="md md-delete btn btn-danger btn-xs btn-raised "></i></a>        
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