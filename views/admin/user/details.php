<!-- BEGIN CONTENT-->
<div id="content">
    <section class="style-default-bright">
        <div class="section-header">
            <h2 class="text-primary">View Machine</h2>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12 margin-bottom-10">

                </div>
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <?php if (isset($machine) && !empty($machine)) { ?>
                            <table id="datatable1" class="data display datatable" width="100%">
                                <thead>
                                    <tr>
                                        
                                        <th>Machine Code</th>
                                        <th>Machine Name</th>
                                        <th>Machine Description</th>
                                        <th>Machine Bill No</th>
                                        <th>MAchine Status</th>
                                        <?php if ($userRights['download']) { ?> <th class="sort">Action</th><?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($machine as $user) { ?>
                                        <tr class="odd gradeX">
                                            <td class="sorting_1"><?php echo $user->MachCode; ?></td>
                                            <td class=""><?php echo $user->MachName; ?></td>
                                            <td class=""><?php echo $user->MachDesc; ?></td>
                                            <td class=""><?php echo $user->MachBillNo; ?></td>
                                            <td class="">
                                                <?php if($user->MachStatus == 1){
                                                    $statuslink =  base_url("admin/members/machine/deactivate/" . $user->MachID);
                                                    $status = 'Approve';
                                                }else{
                                                    $statuslink = base_url("admin/members/machine/activate/" . $user->MachID);
                                                    $status = 'Pending';
                                                } ?>
                                                <a href="<?php echo $statuslink; ?>" title="<?=$status?>" class="activeme"><?=$status?></a>
                                            </td>
                                            <?php if ($userRights['download']) { ?> <td><a href="<?php echo base_url() ?>admin/members/pdf/<?php echo $user->MachID; ?>" title="Pdf" class="btn-mini btn-black btn-download alertpdf"><i class="md md-play-download btn btn-success btn-xs btn-raised "></i></a></td><?php } ?>
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
