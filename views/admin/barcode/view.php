<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style>
.barcode-edit {
    color: green;
    margin-left: 10px;
}
.pull-right.barcode-delete {
    color: red;
    margin-right: 10px;
}
.form-group.col-md-1 > label{
	width: 100%;
}
</style>

<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="section-body contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($action == 'edit') { ?> 
                        <h1 class="text-primary">Edit Barcode</h1>
                        <?php }
                        ?>
                </div>
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <div class="col-lg-12">
				<?php
                    if ($action == 'edit') {
                        $hidden = array('ErpSrnID' => $barcode->ErpSrnID);
                        echo form_open_multipart("admin/barcode/edit/$barcode->ErpSrnID", 'id="addadminfrm" class="form"', $hidden);
                    } 
                    ?>
					<div class="card">
                        <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label style="display: block">Client Name</label>
                                <span class="form-control"><?= ucfirst($barcode->firstname).' '.ucfirst($barcode->lastname)?></span>
                            </div>
                            <div class="form-group col-md-1">
                                <label style="display: block"><a href="javascript:void(0);" class="barcode-edit" id="f1" data-id="<?=$barcode->ErpSrnID?>"  ><i class="md md-mode-edit"></i></a><a href="javascript:void(0);" id="f1" class="pull-right barcode-delete" data-id="<?=$barcode->ErpSrnID?>"><i class="md md-delete"></i></a></label>
                                <?php
                                    $f1str = ''; $f1Type = '';
                                    if($barcode->F1SrMode == 'manual'){
                                        $f1str = $barcode->F1SrValue;
                                        $f1Type = 'Fix';
                                    }
                                    if($barcode->F1SrMode == 'auto'){
                                        $f1Type = 'Auto';
                                        if($barcode->F1SrType == 'Number'){
                                            $num_length = strlen((string)($barcode->F1SrValue));
                                            if($num_length == $barcode->F1SrValLength) {
                                               $f1str = $barcode->F1SrValue;
                                            } else {
                                                $numdata = (int)$barcode->F1SrValLength - (int)$num_length;
                                                $str = '';
                                                if($numdata > 0){
                                                    for($i = 0; $i < $numdata; $i++){
                                                        $str .='0';
                                                    }
                                                }
                                                $f1str = $str.$barcode->F1SrValue;
                                            }
                                        }
                                        if($barcode->F1SrType == 'Date'){
                                            if($barcode->F1SrTypeMode === 'ddmmyy'){
                                                $f1str = $barcode->F1SrTypeMode;
                                            }
                                            if($barcode->F1SrTypeMode === 'mmddyy'){
                                                $f1str = $barcode->F1SrTypeMode;
                                            }
                                        }
                                        if($barcode->F1SrType == 'Month'){
                                            if($barcode->F1SrTypeMode === 'mm'){
                                                $f1str = $barcode->F1SrTypeMode;
                                            }
                                            if($barcode->F1SrTypeMode === 'M'){
                                                $f1str = $barcode->F1SrTypeMode;
                                            }
                                        }
                                        if($barcode->F1SrType == 'Year'){
                                            if($barcode->F1SrTypeMode === 'yy'){
                                                $f1str = $barcode->F1SrTypeMode;
                                            }
                                            if($barcode->F1SrTypeMode === 'Y'){
                                                $f1str = $barcode->F1SrTypeMode;
                                            }
                                        }
                                        if($f1str == 'ddmmyy'){
                                            $f1str = date('dmY');
                                        }
                                        if($f1str == 'mmddyy'){
                                            $f1str = date('mdY');
                                        }
                                        if($f1str == 'mm'){
                                            $f1str = date('m');
                                        }
                                        if($f1str == 'M'){
                                            $f1str = strtoupper(date('F'));
                                        }
                                        if($f1str == 'yy'){
                                            $f1str = date('y');
                                        }
                                        if($f1str == 'Y'){
                                            $f1str = date('Y');
                                        }
                                    }
                                ?>
                                <input type="text" readonly="" readonly="" placeholder="" class="form-control" id="txtF1" maxlength="8" value="<?=$f1str?>">
                                <em class="valid" for="txtF1" id="emF1" style="margin-top:1px"><?=$f1Type?></em>
                            </div>
                            <div class="form-group col-md-1">
                                <label style="display: block"><a href="javascript:void(0);" class="barcode-edit" id="f2" data-id="<?=$barcode->ErpSrnID?>"><i class="md md-mode-edit"></i></a><a href="javascript:void(0);" id="f2" class="pull-right barcode-delete" data-id="<?=$barcode->ErpSrnID?>"><i class="md md-delete"></i></a></label>
                                <?php
                                    $f2str = ''; $f2Type='';
                                    if($barcode->F2SrMode == 'manual'){
                                        $f2str = $barcode->F2SrValue;
                                        $f2Type = 'Fix';
                                    }
                                    if($barcode->F2SrMode == 'auto'){
                                        $f2Type = 'Auto';
                                        if($barcode->F2SrType == 'Number'){
                                            $num_length = strlen((string)($barcode->F2SrValue));
                                            if($num_length == $barcode->F2SrValLength) {
                                               $f2str = $barcode->F2SrValue;
                                            } else {
                                                $numdata = (int)$barcode->F2SrValLength - (int)$num_length;
                                                $str = '';
                                                if($numdata > 0){
                                                    for($i = 0; $i < $numdata; $i++){
                                                        $str .='0';
                                                    }
                                                }
                                                $f2str = $str.$barcode->F2SrValue;
                                            }
                                        }
                                        if($barcode->F2SrType == 'Date'){
                                            if($barcode->F2SrTypeMode === 'ddmmyy'){
                                                $f2str = $barcode->F2SrTypeMode;
                                            }
                                            if($barcode->F2SrTypeMode === 'mmddyy'){
                                                $f2str = $barcode->F2SrTypeMode;
                                            }
                                        }
                                        if($barcode->F2SrType == 'Month'){
                                            if($barcode->F2SrTypeMode === 'mm'){
                                                $f2str = $barcode->F2SrTypeMode;
                                            }
                                            if($barcode->F2SrTypeMode === 'M'){
                                                $f2str = $barcode->F2SrTypeMode;
                                            }
                                        }
                                        if($barcode->F2SrType == 'Year'){
                                            if($barcode->F2SrTypeMode === 'yy'){
                                                $f2str = $barcode->F2SrTypeMode;
                                            }
                                            if($barcode->F2SrTypeMode === 'Y'){
                                                $f2str = $barcode->F2SrTypeMode;
                                            }
                                        }
                                        if($f2str == 'ddmmyy'){
                                            $f2str = date('dmY');
                                        }
                                        if($f2str == 'mmddyy'){
                                            $f2str = date('mdY');
                                        }
                                        if($f2str == 'mm'){
                                            $f2str = date('m');
                                        }
                                        if($f2str == 'M'){
                                            $f2str = strtoupper(date('F'));
                                        }
                                        if($f2str == 'yy'){
                                            $f2str = date('y');
                                        }
                                        if($f2str == 'Y'){
                                            $f2str = date('Y');
                                        }
                                        
                                    }
                                ?>
                                <input type="text" readonly="" placeholder="" class="form-control" id="txtF2" maxlength="8" value="<?=$f2str?>">
                                <em class="valid" for="txtF2" id="emF2" style="margin-top:1px"><?=$f2Type?></em>
                            </div>
                            <div class="form-group col-md-1">
                                <label style="display: block"><a href="javascript:void(0);" class="barcode-edit" id="f3" data-id="<?=$barcode->ErpSrnID?>"><i class="md md-mode-edit"></i></a><a href="javascript:void(0);" id="f3" class="pull-right barcode-delete" data-id="<?=$barcode->ErpSrnID?>"><i class="md md-delete"></i></a></label>
                                <?php
                                    $f3str = ''; $f3Type='';
                                    if($barcode->F3SrMode == 'manual'){
                                        $f3str = $barcode->F3SrValue;
                                        $f3Type = 'Fix';
                                    }
                                    if($barcode->F3SrMode == 'auto'){
                                        $f3Type = 'Auto';
                                        if($barcode->F3SrType == 'Number'){
                                            $num_length = strlen((string)($barcode->F3SrValue));
                                            if($num_length == $barcode->F3SrValLength) {
                                               $f3str = $barcode->F3SrValue;
                                            } else {
                                                $numdata = (int)$barcode->F3SrValLength - (int)$num_length;
                                                $str = '';
                                                if($numdata > 0){
                                                    for($i = 0; $i < $numdata; $i++){
                                                        $str .='0';
                                                    }
                                                }
                                                $f3str = $str.$barcode->F3SrValue;
                                            }
                                        }
                                        if($barcode->F3SrType == 'Date'){
                                            if($barcode->F3SrTypeMode === 'ddmmyy'){
                                                $f3str = $barcode->F3SrTypeMode;
                                            }
                                            if($barcode->F3SrTypeMode === 'mmddyy'){
                                                $f3str = $barcode->F3SrTypeMode;
                                            }
                                        }
                                        if($barcode->F3SrType == 'Month'){
                                            if($barcode->F3SrTypeMode === 'mm'){
                                                $f3str = $barcode->F3SrTypeMode;
                                            }
                                            if($barcode->F3SrTypeMode === 'M'){
                                                $f3str = $barcode->F3SrTypeMode;
                                            }
                                        }
                                        if($barcode->F3SrType == 'Year'){
                                            if($barcode->F3SrTypeMode === 'yy'){
                                                $f3str = $barcode->F3SrTypeMode;
                                            }
                                            if($barcode->F3SrTypeMode === 'Y'){
                                                $f3str = $barcode->F3SrTypeMode;
                                            }
                                        }
                                        if($f3str == 'ddmmyy'){
                                            $f3str = date('dmY');
                                        }
                                        if($f3str == 'mmddyy'){
                                            $f3str = date('mdY');
                                        }
                                        if($f3str == 'mm'){
                                            $f3str = date('m');
                                        }
                                        if($f3str == 'M'){
                                            $f3str = strtoupper(date('F'));
                                        }
                                        if($f3str == 'yy'){
                                            $f3str = date('y');
                                        }
                                        if($f3str == 'Y'){
                                            $f3str = date('Y');
                                        }
                                        
                                    }
                                ?>
                                <input type="text" readonly="" placeholder="" class="form-control" id="txtF3" maxlength="8" value="<?=$f3str?>">
                                <em class="valid" for="txtF3" id="emF3" style="margin-top:1px"><?=$f3Type?></em>
                            </div>
                            <div class="form-group col-md-1">
                                <label style="display: block"><a href="javascript:void(0);" class="barcode-edit" id="f4" data-id="<?=$barcode->ErpSrnID?>"><i class="md md-mode-edit"></i></a><a href="javascript:void(0);" id="f4" class="pull-right barcode-delete" data-id="<?=$barcode->ErpSrnID?>"><i class="md md-delete"></i></a></label>
                                <?php
                                    $f4str = ''; $f4Type = '';
                                    if($barcode->F4SrMode == 'manual'){
                                        $f4str = $barcode->F4SrValue;
                                        $f4Type  = 'Fix';
                                    }
                                    if($barcode->F4SrMode == 'auto'){
                                        $f4Type = 'Auto';
                                        if($barcode->F4SrType == 'Number'){
                                            $num_length = strlen((string)($barcode->F4SrValue));
                                            if($num_length == $barcode->F4SrValLength) {
                                               $f4str = $barcode->F4SrValue;
                                            } else {
                                                $numdata = (int)$barcode->F4SrValLength - (int)$num_length;
                                                $str = '';
                                                if($numdata > 0){
                                                    for($i = 0; $i < $numdata; $i++){
                                                        $str .='0';
                                                    }
                                                }
                                                $f4str = $str.$barcode->F4SrValue;
                                            }
                                        }
                                        if($barcode->F4SrType == 'Date'){
                                            if($barcode->F4SrTypeMode === 'ddmmyy'){
                                                $f4str = $barcode->F4SrTypeMode;
                                            }
                                            if($barcode->F4SrTypeMode === 'mmddyy'){
                                                $f4str = $barcode->F4SrTypeMode;
                                            }
                                        }
                                        if($barcode->F4SrType == 'Month'){
                                            if($barcode->F4SrTypeMode === 'mm'){
                                                $f4str = $barcode->F4SrTypeMode;
                                            }
                                            if($barcode->F4SrTypeMode === 'M'){
                                                $f4str = $barcode->F4SrTypeMode;
                                            }
                                        }
                                        if($barcode->F4SrType == 'Year'){
                                            if($barcode->F4SrTypeMode === 'yy'){
                                                $f4str = $barcode->F4SrTypeMode;
                                            }
                                            if($barcode->F4SrTypeMode === 'Y'){
                                                $f4str = $barcode->F4SrTypeMode;
                                            }
                                        }
                                        if($f4str == 'ddmmyy'){
                                            $f4str = date('dmY');
                                        }
                                        if($f4str == 'mmddyy'){
                                            $f4str = date('mdY');
                                        }
                                        if($f4str == 'mm'){
                                            $f4str = date('m');
                                        }
                                        if($f4str == 'M'){
                                            $f4str = strtoupper(date('F'));
                                        }
                                        if($f4str == 'yy'){
                                            $f4str = date('y');
                                        }
                                        if($f4str == 'Y'){
                                            $f4str = date('Y');
                                        }
                                        
                                    }
                                ?>
                                <input type="text" readonly="" placeholder="" class="form-control" id="txtF4" maxlength="8" value="<?=$f4str?>">
                                <em class="valid" for="txtF4" id="emF4" style="margin-top:1px"><?=$f4Type?></em>
                            </div>
                            <div class="form-group col-md-1">
                                <label style="display: block"><a href="javascript:void(0);" class="barcode-edit" id="f5" data-id="<?=$barcode->ErpSrnID?>"><i class="md md-mode-edit"></i></a><a href="javascript:void(0);" id="f5" class="pull-right barcode-delete" data-id="<?=$barcode->ErpSrnID?>"><i class="md md-delete"></i></a></label>
                                <?php
                                    $f5str = ''; $f5Type='';
                                    if($barcode->F5SrMode == 'manual'){
                                        $f5str = $barcode->F5SrValue;
                                        $f5Type = 'Fix';
                                    }
                                    if($barcode->F5SrMode == 'auto'){
                                        $f5Type = 'Auto';
                                        if($barcode->F5SrType == 'Number'){
                                            $num_length = strlen((string)($barcode->F5SrValue));
                                            if($num_length == $barcode->F5SrValLength) {
                                               $f5str = $barcode->F5SrValue;
                                            } else {
                                                $numdata = (int)$barcode->F5SrValLength - (int)$num_length;
                                                $str = '';
                                                if($numdata > 0){
                                                    for($i = 0; $i < $numdata; $i++){
                                                        $str .='0';
                                                    }
                                                }
                                                $f5str = $str.$barcode->F5SrValue;
                                            }
                                        }
                                        if($barcode->F5SrType == 'Date'){
                                            if($barcode->F5SrTypeMode === 'ddmmyy'){
                                                $f5str = $barcode->F5SrTypeMode;
                                            }
                                            if($barcode->F5SrTypeMode === 'mmddyy'){
                                                $f5str = $barcode->F5SrTypeMode;
                                            }
                                        }
                                        if($barcode->F5SrType == 'Month'){
                                            if($barcode->F5SrTypeMode === 'mm'){
                                                $f5str = $barcode->F5SrTypeMode;
                                            }
                                            if($barcode->F5SrTypeMode === 'M'){
                                                $f5str = $barcode->F5SrTypeMode;
                                            }
                                        }
                                        if($barcode->F5SrType == 'Year'){
                                            if($barcode->F5SrTypeMode === 'yy'){
                                                $f5str = $barcode->F5SrTypeMode;
                                            }
                                            if($barcode->F5SrTypeMode === 'Y'){
                                                $f5str = $barcode->F5SrTypeMode;
                                            }
                                        }
                                        if($f5str == 'ddmmyy'){
                                            $f5str = date('dmY');
                                        }
                                        if($f5str == 'mmddyy'){
                                            $f5str = date('mdY');
                                        }
                                        if($f5str == 'mm'){
                                            $f5str = date('m');
                                        }
                                        if($f5str == 'M'){
                                            $f5str = strtoupper(date('F'));
                                        }
                                        if($f5str == 'yy'){
                                            $f5str = date('y');
                                        }
                                        if($f5str == 'Y'){
                                            $f5str = date('Y');
                                        }
                                        
                                    }
                                ?>
                                <input type="text" readonly="" placeholder="" class="form-control" id="txtF5" maxlength="8" value="<?=$f5str?>"> 
                                <em class="valid" for="txtF5" id="emF5" style="margin-top:1px"><?=$f5Type?></em>
                            </div>
                            <div class="form-group col-md-1">
                                <label style="display: block"><a href="javascript:void(0);" class="barcode-edit" id="f6" data-id="<?=$barcode->ErpSrnID?>"><i class="md md-mode-edit"></i></a><a href="javascript:void(0);" id="f6" class="pull-right barcode-delete" data-id="<?=$barcode->ErpSrnID?>"><i class="md md-delete"></i></a></label>
                                <?php
                                    $f6str = '';$f6Type='';
                                    if($barcode->F6SrMode == 'manual'){
                                        $f6str = $barcode->F6SrValue;
                                        $f6Type = 'Fix';
                                    }
                                    if($barcode->F6SrMode == 'auto'){
                                        $f6Type='Auto';
                                        if($barcode->F6SrType == 'Number'){
                                            $num_length = strlen((string)($barcode->F6SrValue));
                                            if($num_length == $barcode->F6SrValLength) {
                                               $f6str = $barcode->F6SrValue;
                                            } else {
                                                $numdata = (int)$barcode->F6SrValLength - (int)$num_length;
                                                $str = '';
                                                if($numdata > 0){
                                                    for($i = 0; $i < $numdata; $i++){
                                                        $str .='0';
                                                    }
                                                }
                                                $f6str = $str.$barcode->F6SrValue;
                                            }
                                        }
                                        if($barcode->F6SrType == 'Date'){
                                            if($barcode->F6SrTypeMode === 'ddmmyy'){
                                                $f6str = $barcode->F6SrTypeMode;
                                            }
                                            if($barcode->F6SrTypeMode === 'mmddyy'){
                                                $f6str = $barcode->F6SrTypeMode;
                                            }
                                        }
                                        if($barcode->F6SrType == 'Month'){
                                            if($barcode->F6SrTypeMode === 'mm'){
                                                $f6str = $barcode->F6SrTypeMode;
                                            }
                                            if($barcode->F6SrTypeMode === 'M'){
                                                $f6str = $barcode->F6SrTypeMode;
                                            }
                                        }
                                        if($barcode->F6SrType == 'Year'){
                                            if($barcode->F6SrTypeMode === 'yy'){
                                                $f6str = $barcode->F6SrTypeMode;
                                            }
                                            if($barcode->F6SrTypeMode === 'Y'){
                                                $f6str = $barcode->F6SrTypeMode;
                                            }
                                        }
                                        if($f6str == 'ddmmyy'){
                                            $f6str = date('dmY');
                                        }
                                        if($f6str == 'mmddyy'){
                                            $f6str = date('mdY');
                                        }
                                        if($f6str == 'mm'){
                                            $f6str = date('m');
                                        }
                                        if($f6str == 'M'){
                                            $f6str = strtoupper(date('F'));
                                        }
                                        if($f6str == 'yy'){
                                            $f6str = date('y');
                                        }
                                        if($f6str == 'Y'){
                                            $f6str = date('Y');
                                        }
                                        
                                    }
                                ?>
                                <input type="text" readonly="" placeholder="" class="form-control" id="txtF6" maxlength="8" value="<?=$f6str?>">
                                <em class="valid" for="txtF6" id="emF6" style="margin-top:1px"><?=$f6Type?></em>
                            </div>
                            <div class="form-group col-md-1">
                                <label style="display: block"><a href="javascript:void(0);" class="barcode-edit" id="f7" data-id="<?=$barcode->ErpSrnID?>"><i class="md md-mode-edit"></i></a><a href="javascript:void(0);" id="f7" class="pull-right barcode-delete" data-id="<?=$barcode->ErpSrnID?>"><i class="md md-delete"></i></a></label>
                                <?php
                                    $f7str = '';$f7Type='';
                                    if($barcode->F7SrMode == 'manual'){
                                        $f7str = $barcode->F7SrValue;
                                        $f7Type = 'Fix';
                                    }
                                    if($barcode->F7SrMode == 'auto'){
                                        $f7Type='Auto';
                                        if($barcode->F7SrType === 'Number'){
                                            $num_length = strlen((string)($barcode->F7SrValue));
                                            if($num_length == $barcode->F7SrValLength) {
                                               $f7str = $barcode->F7SrValue;
                                            } else {
                                                $numdata = (int)$barcode->F7SrValLength - (int)$num_length;
                                                $str = '';
                                                if($numdata > 0){
                                                    for($i = 0; $i < $numdata; $i++){
                                                        $str .='0';
                                                    }
                                                }
                                                $f7str = $str.$barcode->F7SrValue;
                                            }
                                        }
                                        if($barcode->F7SrType == 'Date'){
                                            if($barcode->F7SrTypeMode === 'ddmmyy'){
                                                $f7str = $barcode->F7SrTypeMode;
                                            }
                                            if($barcode->F7SrTypeMode === 'mmddyy'){
                                                $f7str = $barcode->F7SrTypeMode;
                                            }
                                        }
                                        if($barcode->F7SrType == 'Month'){
                                            if($barcode->F7SrTypeMode === 'mm'){
                                                $f7str = $barcode->F7SrTypeMode;
                                            }
                                            if($barcode->F7SrTypeMode === 'M'){
                                                $f7str = $barcode->F7SrTypeMode;
                                            }
                                        }
                                        if($barcode->F7SrType == 'Year'){
                                            if($barcode->F7SrTypeMode === 'yy'){
                                                $f7str = $barcode->F7SrTypeMode;
                                            }
                                            if($barcode->F7SrTypeMode === 'Y'){
                                                $f7str = $barcode->F7SrTypeMode;
                                            }
                                        }
                                        if($f7str == 'ddmmyy'){
                                            $f7str = date('dmY');
                                        }
                                        if($f7str == 'mmddyy'){
                                            $f7str = date('mdY');
                                        }
                                        if($f7str == 'mm'){
                                            $f7str = date('m');
                                        }
                                        if($f7str == 'M'){
                                            $f7str = strtoupper(date('F'));
                                        }
                                        if($f7str == 'yy'){
                                            $f7str = date('y');
                                        }
                                        if($f7str == 'Y'){
                                            $f7str = date('Y');
                                        }
                                        
                                    }
                                ?>
                                <input type="text" readonly="" placeholder="" class="form-control" id="txtF7" maxlength="8" value="<?=$f7str?>">
                                <em class="valid" for="txtF7" id="emF7" style="margin-top:1px"><?=$f7Type?></em>
                            </div>
                        </div>

                    </div>
                        <div class="card-actionbar">
                            <div class="card-actionbar-row">
                            <div class="col-md-12">
                                <a  class="btn btn-default barcode-cancel" href="<?= base_url('admin/barcode/list') ?>" >
                                    Cancel
                                </a>
                                <a  class="btn btn-danger barcode-cancel" href="<?= base_url('admin/barcode/list') ?>">
                                    Submit
                                </a>
                            </div>
                        </div>
                        </div>
                    </div><!--end .card -->
                    <?php echo form_close(); ?>
                </div><!--end .col -->
            </div><!--end .row -->
        </div><!--end .section-body -->
    </section>
</div><!--end #content-->



<!-- Modal -->
<div class="modal fade" id="f1Modal" tabindex="-1" role="dialog" aria-labelledby="f1ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="f1ModalLabel">Select Pattern</h4>
            </div>
            <?= form_open('updatebarcode','class="form-horizontal" id="srngenfrm"') ?>
            <div class="modal-body barcode-data">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    Change
                </button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
$(document).on('click', '.barcode-edit', function () {
	$('.barcode-data').html('<a class="txt-color-blue" href="javascript:void(0);"><i class="md md-mood"></i></a>');
	$('#f1Modal').modal('show');
	var _url = '<?= base_url("getbarcodetype") ?>';
	var _post = 'GET';
	var _postType = 'json';
	var _data = {};
	_data['id'] = $(this).attr('data-id');
	_data['type'] = $(this).attr('id');
	$.ajax({type: _post, url: _url, dataType: _postType, data: _data,
		success: function (_returnData) {
			$('.barcode-data').html(_returnData.result);
			return false;
		},
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('Connection Error, Try Again');
                    setTimeout(function(){
                        location = ''
                    },10);
              }
	});
	return false;
});
$(document).on('click', '.barcode-delete', function () {
	var _val = $(this).attr('data-id');
	var id = $(this).attr('id');
	var _type = id.toUpperCase();
	if ($('#txt' + _type).val() == '') {
		console.log('No record in db');
	} else {
		var r = confirm("Are you sure you want to delete this field?");
		if (r == true) {
			var _url = '<?= base_url("deletebarcodetype")?>';
			var _post = 'GET';
			var _postType = 'json';
			var _data = {};
			_data['id'] = $(this).attr('data-id');
			_data['type'] = $(this).attr('id');

			$.ajax({type: _post, url: _url, dataType: _postType, data: _data,
				success: function (_returnData) {
					if (_returnData.res == 'success') {
						$('#txt' + _returnData.type).val(_returnData.msg);
						$('#em' + _returnData.type).html(_returnData.BarType);
					} else {
						alert(_returnData.msg);
						return false;
					}
					return false;
				},
                error: function (xhr, ajaxOptions, thrownError) {
                    setTimeout(function(){
                        location = ''
                    },10);
              }
			});
			return false;
		} else {
			return false;
		}
	}
	return false;
});
$(document).on('click', '.SrMode', function () {
	if ($(this).val() == 'auto') {
		console.log('auto ::: ' + $(this).val());
		$('.autodiv').show();
		$('.manualdiv').hide();
	}
	if ($(this).val() == 'manual') {
		console.log('manual ::: ' + $(this).val());
		$('.manualdiv').show();
		$('.autodiv').hide();
	}
});
$(document).on('click', '.SrType', function () {
	if ($(this).val() == 'Number') {
		$('.srtypenum,.srtypemodnum').show();
		$('.srtypeyr,.srtypeday,.srtypemnth').hide();
	}
	if ($(this).val() == 'Date') {
		$('.srtypeday').show();
		$('.srtypenum,.srtypemodnum,.srtypemnth,.srtypeyr').hide();
	}
	if ($(this).val() == 'Month') {
		$('.srtypemnth').show();
		$('.srtypenum,.srtypemodnum,.srtypeday,.srtypeyr').hide();
	}
	if ($(this).val() == 'Year') {
		$('.srtypeyr').show();
		$('.srtypenum,.srtypemodnum,.srtypeday,.srtypemnth').hide();
	}
});
$(document).ready(function(){
	$("#srngenfrm").validate({
		// Rules for form validation
		rules: {
			SrMode: {
				required: true
			},
			SrType: {
				required: true
			},
			nSrTypeMode: {
				required: true
			},
			dSrTypeMode: {
				required: true
			},
			mSrTypeMode: {
				required: true
			},
			ySrTypeMode: {
				required: true
			},
			SrValue: {
				required: true,
				min: 1,
				number: true,
			},
			SrValLength: {
				required: true,
				min: 1,
				number: true,
				max: 8
			},
			SrValue1: {
				required: true
			}

		},
		// Messages for form validation
		messages: {
		},
		submitHandler: function (form) {
			var _data = $("#srngenfrm").serialize();
			var _url = $("#srngenfrm").attr('action');
			var _post = 'POST';
			var _postType = 'json';
			$.ajax({type: _post, url: _url, dataType: _postType, data: _data,
				success: function (_returnData) {
					if (_returnData.res == 'success') {
						$('#txt' + _returnData.type).val(_returnData.msg);
						$('#em' + _returnData.type).html(_returnData.BarType);
						$('#f1Modal').modal('hide');
					} else {
						alert(_returnData.msg);
						return false;
					}
				},
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('Connection Error, Try Again');
                    setTimeout(function(){
                        location = ''
                    },10);
              }
			});
			return false;
		}
	});
});
</script>