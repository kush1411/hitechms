
<!-- BEGIN CONTENT-->
<div id="content">
    <section class="style-default-bright">
        <div class="section-header">
            <h2 class="text-primary">View Account</h2>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <?php if (isset($allaccount) && !empty($allaccount)) { ?>
                            <table id="datatable1" class="table table-striped table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Job ID</th>
                                        <th>Service Provider</th>
                                        <th>Invoice Number</th>
                                        <th>File</th>
                                        <th>Payment DateTime</th>
                                        <th>Payment Type</th>
                                        <th>Payment Taken By</th>
                                        <th>Status</th>
                                        <th class="sort">Created Date</th>
                                        <th class="sort">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $cnt=0; foreach ($allaccount as $user) { $cnt++; ?>
                                        <tr class="odd gradeX">
                                            <td><?=$cnt?></td>
                                            <td class="sorting_1"><?php echo $user->refJobID; ?></td>
                                            <td><?=$user->provider->Name?></td>
                                            <td class=""><?php echo $user->InvoiceNo; ?></td>
                                            <td><?php echo $user->InvoiceImage; ?></td>
                                            <td><?php echo $user->PaymentDate != '' ? date("d-m-Y H:i", strtotime($user->PaymentDate)) : ''; ?></td>
                                            <td><?= $user->PaymentType?></td>
                                            <td><?= $user->PaymentTakenPerson?></td>
                                            <td><?=$user->Status?></td>
                                            <td class="center"><?php echo date("d-m-Y", strtotime($user->InsDateTime)); ?></td>
                                            <td class="center">
                                                <?php if($user->Status == 'Pending'){ ?>
                                                <a href="<?php echo base_url() ?>account/edit/<?php echo $user->AccountID; ?>" title="Edit" class="btn-edit"><i class="md md-edit btn btn-success btn-xs btn-raised "></i></a>
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
            </div><!--end .row -->
        </div><!--end .section-body -->
    </section>
</div><!--end #content-->
<!-- END CONTENT -->