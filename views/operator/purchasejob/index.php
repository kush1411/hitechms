
<!-- BEGIN CONTENT-->
<div id="content">
    <section class="style-default-bright">
        <div class="section-header">
            <h2 class="text-primary">View Purchases</h2>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12 margin-bottom-10">
                    <?php
                    if ($userRights['add']) {
                        ?>
                        <a href = "<?php echo base_url() ?>operator/purchasejob/add" class="btn btn-info btn-xs btn-raised pull-right">Add Purchase</a>
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
                        <?php if (isset($allpurchasesjob) && !empty($allpurchasesjob)) { ?>
                            <table id="datatable1" class="table table-striped table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Job Id</th>
                                        <th>Mfg</th>
                                        <th>Purchase Amt</th>
                                        <th>Provider</th>
                                        <th class="sort">Created Date</th>
                                        <th class="sort">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allpurchasesjob as $user) { ?>
                                        <tr class="odd gradeX">
                                            <td class="sorting_1"><?php echo $user->refJobID; ?></td>
                                            <td><?php echo $user->MfgName ?></td>
                                            <td class="sorting_1"><?php echo $user->PurAmt;  ?></td>
                                            <td><?php echo $user->ProviderName ?></td>
                                            <td class="center"><?php echo date("d-m-Y", strtotime($user->UpdDateTime)); ?></td>
                                            <td class="center">
                                                <a href="<?php echo base_url() ?>operator/purchasejob/quotation/<?php echo $user->POID; ?>" title="Quotation" class=""><i class="md md-remove-red-eye btn btn-warning btn-xs btn-raised "></i></a>
                                                <?php
                                                if ($userRights['edit']) {
                                                    ?>
                                                    <a href="<?php echo base_url() ?>operator/purchasejob/edit/<?php echo $user->POID; ?>" title="Edit" class="btn-edit"><i class="md md-edit btn btn-success btn-xs btn-raised "></i></a>
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
            </div><!--end .row -->
        </div><!--end .section-body -->
    </section>
</div><!--end #content-->
<!-- END CONTENT -->