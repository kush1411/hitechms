<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$data = (array)$masterValue;
$type = strtoupper($type);

?>


    <fieldset>
        <div class="col-md-12">
            <div class="form-group" >
                <label class="">Select Mode :</label>
                <div class="col-md-12">
                    <label class="radio radio-inline ">
                        <input type="radio" name="SrMode" class="SrMode radiobox" value="auto" <?= $data[$type.'SrMode'] == 'auto' ? 'checked' : '' ?> >
                        <span>Auto</span> 
                    </label>
                    <label class="radio radio-inline">
                        <input type="radio" name="SrMode" class="SrMode radiobox" value="manual" <?= $data[$type.'SrMode'] == 'manual' ? 'checked' : '' ?> >
                        <span>Fix</span>  
                    </label>
                </div>
            </div>
        </div>
        <div class="autodiv" <?= $data[$type.'SrMode'] == 'auto' ? '' : 'style="display: none"' ?> >
            <div class="col-md-12 srtypea" >
                <div class="form-group" >
                    <label class="">Select Type :</label>
                    <div class="col-md-12">
                        <label class="radio radio-inline">
                            <input type="radio" name="SrType" class="SrType radiobox" value="Number" <?= $data[$type.'SrType'] == 'Number' ? 'checked' : '' ?> >
                            <span>Number</span> 
                        </label>
                        <label class="radio radio-inline">
                            <input type="radio" name="SrType" class="SrType radiobox" value="Date" <?= $data[$type.'SrType'] == 'Date' ? 'checked' : '' ?> >
                            <span>Date</span>  
                        </label>
                        <label class="radio radio-inline">
                            <input type="radio" name="SrType" class="SrType radiobox" value="Month" <?= $data[$type.'SrType'] == 'Month' ? 'checked' : '' ?> >
                            <span>Month</span> 
                        </label>
                        <label class="radio radio-inline">
                            <input type="radio" name="SrType" class="SrType radiobox" value="Year" <?= $data[$type.'SrType'] == 'Year' ? 'checked' : '' ?> >
                            <span>Year</span>  
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12 srtypenum" <?= $data[$type.'SrType'] == 'Number' ? '' : 'style="display: none"' ?> >
                <div class="form-group" >
                    <label class="">Select Type Mode :</label>
                    <div class="col-md-12">
                        <label class="radio radio-inline">
                            <input type="radio" name="nSrTypeMode" class="SrTypeMode radiobox" value="*" <?= $data[$type.'SrTypeMode'] === '*' ? 'checked' : '' ?> >
                            <span>Continues</span> 
                        </label>
                        <label class="radio radio-inline">
                            <input type="radio" name="nSrTypeMode" class="SrTypeMode radiobox" value="*d" <?= $data[$type.'SrTypeMode'] === '*d' ? 'checked' : '' ?>>
                            <span>Reset Daily</span> 
                        </label>
                        <label class="radio radio-inline">
                            <input type="radio" name="nSrTypeMode" class="SrTypeMode radiobox" value="*m" <?= $data[$type.'SrTypeMode'] === '*m' ? 'checked' : '' ?>>
                            <span>Reset Monthly</span> 
                        </label>
                        <label class="radio radio-inline">
                            <input type="radio" name="nSrTypeMode" class="SrTypeMode radiobox" value="*y" <?= $data[$type.'SrTypeMode'] === '*y' ? 'checked' : '' ?>>
                            <span>Reset Yearly</span> 
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12 srtypeday" <?= $data[$type.'SrType'] == 'Date' ? '' : 'style="display: none"' ?> >
                <div class="form-group" >
                    <label class="">Select Type Mode :</label>
                    <div class="col-md-12">
                        <label class="radio radio-inline">
                            <input type="radio" name="dSrTypeMode" class="SrTypeMode radiobox" value="ddmmyy" <?= $data[$type.'SrTypeMode'] === 'ddmmyy' ? 'checked' : '' ?>>
                            <span>ddmmyy (<?= date('dmY') ?>)</span> 
                        </label>
                        <label class="radio radio-inline">
                            <input type="radio" name="dSrTypeMode" class="SrTypeMode radiobox" value="mmddyy" <?= $data[$type.'SrTypeMode'] === 'mmddyy' ? 'checked' : '' ?> >
                            <span>mmddyy (<?= date('mdY') ?>)</span> 
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12 srtypemnth" <?= $data[$type.'SrType'] == 'Month' ? '' : 'style="display: none"' ?> >
                <div class="form-group" >
                    <label class="">Select Type Mode :</label>
                    <div class="col-md-12">
                        <label class="radio radio-inline">
                            <input type="radio" name="mSrTypeMode" class="SrTypeMode radiobox" value="mm" <?= $data[$type.'SrTypeMode'] === 'mm' ? 'checked' : '' ?> >
                            <span>mm (<?= date('m') ?>)</span> 
                        </label>
                        <label class="radio radio-inline">
                            <input type="radio" name="mSrTypeMode" class="SrTypeMode radiobox" value="M" <?= $data[$type.'SrTypeMode'] === 'M' ? 'checked' : '' ?> >
                            <span>M (<?= strtoupper(date('F')) ?>)</span> 
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12 srtypeyr" <?= $data[$type.'SrType'] == 'Year' ? '' : 'style="display: none"' ?> >
                <div class="form-group" >
                    <label class="">Select Type Mode :</label>
                    <div class="col-md-12">
                        <label class="radio radio-inline">
                            <input type="radio" name="ySrTypeMode" class="SrTypeMode radiobox" value="yy" <?= $data[$type.'SrTypeMode'] === 'yy' ? 'checked' : '' ?> >
                            <span>yy (<?= date('y') ?>)</span> 
                        </label>
                        <label class="radio radio-inline">
                            <input type="radio" name="ySrTypeMode" class="SrTypeMode radiobox" value="Y" <?= $data[$type.'SrTypeMode'] === 'Y' ? 'checked' : '' ?> >
                            <span>Y (<?= date('Y') ?>)</span> 
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12 srtypemodnum" <?= $data[$type.'SrType'] == 'Number' ? '' : 'style="display: none"' ?> >
                <div class="form-group col-sm-12" style="padding: unset;margin-right: 10px">
                    <label>Starting Value :</label>
                    <input type="text" name="SrValue" id="SrValue" maxlength="8" class="form-control numbersonly" value="<?=$data[$type.'SrValue']?>" style="margin-top: 7px">
                </div>
                <div class="form-group col-sm-12" style="padding: unset;margin-right: 0">
                    <label>Value Length :</label>
                    <input type="text" name="SrValLength" id="SrValLength" min="1" maxlength="1" class="form-control numbersonly" value="<?= $data[$type.'SrValLength'] == 0 || $data[$type.'SrValLength'] == '' ? 5 : $data[$type.'SrValLength'] ?>" style="margin-top: 7px">
                </div>
            </div>
        </div>
        <div class="manualdiv" <?= $data[$type.'SrMode'] == 'manual' ? '' : 'style="display: none"' ?> >
            <div class="col-md-12 ">
                <div class="form-group col-sm-4" style="padding-left:0;margin-right: 10px">
                    <label>Value :</label>
                    <input type="text" name="SrValue1" id="SrValue1" maxlength="8" class="form-control" value="<?=$data[$type.'SrValue']?>" style="margin-top: 7px">
                </div>
            </div>
        </div>
    </fieldset>
<input type="hidden" name="id" value="<?=$masterID?>"/>
<input type="hidden" name="type" value="<?=$type?>"/>