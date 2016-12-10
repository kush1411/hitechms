
<!-- BEGIN CONTENT-->
<div id="content">
    <section class="style-default-bright">
        <div class="section-header">
            <h2 class="text-primary">View Jobs</h2>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12 margin-bottom-10">
                    <?php
                    if ($userRights['add']) {
                        ?>
                        <a href = "<?php echo base_url() ?>operator/jobmst/add" class="btn btn-info btn-xs btn-raised pull-right">Add Job</a>
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
                        <?php if (isset($alljobs) && !empty($alljobs)) { ?>
                            <table id="datatable1" class="table table-striped table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Barcode No</th>
                                        <th>Machine</th>
                                        <th>Part</th>
                                        <th>Mfg</th>
                                        <th>Provider</th>
                                        <th>Quotation Amt</th>
                                        <th>Issue</th>
                                        <th>Status</th>
                                        <th class="sort">Created Date</th>
                                        <?php if ($userRights['edit'] || $userRights['delete']) { ?> <th class="sort">Action</th><?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($alljobs as $user) { ?>
                                        <tr class="odd gradeX">
                                            <td class="sorting_1"><?php echo $user->BarcodeNo; ?></td>
                                            <td class=""><?php echo $user->MachCode . ' | ' . $user->MachName; ?></td>
                                            <td class=""><?php echo $user->SubPartName == NULL ? $user->PartName : $user->SubPartName; ?></td>
                                            <td><?php echo $user->MfgName ?></td>
                                            <td><?php echo $user->ProviderName ?></td>
                                            <td class="sorting_1"><?php echo $user->QuotAmt; ?></td>
                                            <td class=""><?php echo $user->Issue; ?></td>
                                            <td class=""><?php echo $user->Status; ?></td>
                                            <td class="center"><?php echo date("d-m-Y", strtotime($user->InsDateTime)); ?></td>
                                            <td class="center">
                                                <?php if ($user->IsWarranty == 0) { ?>
                                                    <a href="<?php echo base_url() ?>operator/jobmst/quotation/<?php echo $user->JobID; ?>" title="Quotation" class=""><i class="md md-remove-red-eye btn btn-warning btn-xs btn-raised "></i></a>
                                                <?php } ?>
                                                <?php
                                                if ($user->Status == 'Pending' || $user->Status == 'Quotation Request Sent' || $user->Status == 'Quotation Applied') {
                                                    if ($userRights['edit']) {
                                                        ?>
                                                        <a href="<?php echo base_url() ?>operator/jobmst/edit/<?php echo $user->JobID; ?>" title="Edit" class="btn-edit"><i class="md md-edit btn btn-success btn-xs btn-raised "></i></a>
                                                        <?php
                                                        }
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
            </div><!--end .row -->
        </div><!--end .section-body -->
    </section>
</div><!--end #content-->
<!-- END CONTENT -->