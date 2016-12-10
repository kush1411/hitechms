<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="section-body contain-lg">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-primary">Personal Info</h2>
                </div>
                <div class="col-lg-12">
                    <?php echo $add_error; ?>
                    <?php echo $add_warning; ?>
                    <?php echo $add_info; ?>
                    <?php echo $add_success; ?>
                </div>
                <div class="col-lg-12">
                    <?php
                    $id = $this->session->userdata[SITE_NAME . '_user_data']['user_id'];
                    echo form_open('frontend/myaccount/edit/' . $id, 'class="form"');
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <?php
                                        echo form_input(
                                                array(
                                                    'name' => 'code',
                                                    'class' => 'form-control',
                                                    'id' => 'code',
                                                    'placeholder' => 'Code',
                                                    'readonly' => TRUE,
                                                    'value' => (isset($user->user_profile->code) ? $user->user_profile->code : ''),
                                                    'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('Company Code', 'code'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <?php
                                        echo form_input(
                                                array(
                                                    'name' => 'email',
                                                    'class' => 'form-control',
                                                    'id' => 'email',
                                                    'placeholder' => 'Email',
                                                    'readonly' => TRUE,
                                                    'value' => (isset($user->email) ? $user->email : ''),
                                                    'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('Email', 'email'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <?php
                                        echo form_input(
                                                array(
                                                    'name' => 'firstname',
                                                    'class' => 'form-control',
                                                    'id' => 'firstname',
                                                    'placeholder' => 'First Name',
                                                    'value' => (isset($postdata) && isset($postdata['firstname'])) ? $postdata['firstname'] : (isset($user->firstname) ? $user->firstname : ''),
                                                    'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> Firstname', 'firstname'); ?>
                                        <?php
                                        echo form_error('firstname');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">

                                    <div class="form-group">

                                        <?php
                                        echo form_input(
                                                array(
                                                    'name' => 'lastname',
                                                    'class' => 'form-control',
                                                    'id' => 'lastname',
                                                    'placeholder' => 'Last Name',
                                                    'value' => (isset($postdata) && isset($postdata['lastname'])) ? $postdata['lastname'] : (isset($user->lastname) ? $user->lastname : ''),
                                                    'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> Lastname', 'lastname'); ?>
                                        <?php
                                        echo form_error('lastname');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">

                                        <?php
                                        echo form_textarea(
                                                array(
                                                    'name' => 'address',
                                                    'class' => 'form-control',
                                                    'cols' => '0',
                                                    'rows' => '0',
                                                    'id' => 'address',
                                                    'placeholder' => 'Address',
                                                    'value' => (isset($postdata) && isset($postdata['address'])) ? $postdata['address'] : (($user->user_profile->address) ? $user->user_profile->address : ''),
                                                    'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> Address', 'email'); ?>
                                        <?php
                                        echo form_error('address');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">

                                        <?php
                                        echo form_input(
                                                array(
                                                    'name' => 'city',
                                                    'class' => 'form-control',
                                                    'id' => 'city',
                                                    'placeholder' => 'City',
                                                    'value' => (isset($postdata) && isset($postdata['city'])) ? $postdata['city'] : (($user->user_profile) ? $user->user_profile->city : ''),
                                                    'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> City', 'city'); ?>
                                        <?php
                                        echo form_error('city');
                                        ?>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">

                                        <?php
                                        echo form_input(array('name' => 'zip',
                                            'id' => 'zip',
                                            'palceholder' => 'zip', 'class' => 'form-control',
                                            'value' => (isset($postdata) && isset($postdata['zip'])) ? $postdata['zip'] : (isset($user) ? ($user->user_profile->zip) : ''),
                                            'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> Postal/Zip Code', 'zip'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">

                                        <?php
                                        echo form_input(array('name' => 'state',
                                            'id' => 'state',
                                            'palceholder' => 'state', 'class' => 'form-control',
                                            'value' => (isset($postdata) && isset($postdata['state'])) ? $postdata['state'] : (isset($user) ? ($user->user_profile->state) : ''),
                                            'required' => 'required'
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> State/Province', 'state'); ?>
                                        <?php
                                        echo form_error('state');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php echo form_label('<span style="color: red">*</span> Country', 'country'); ?>
                                        <?php
                                        echo form_input(array('name' => 'country',
                                            'id' => 'country',
                                            'palceholder' => 'country', 'class' => 'form-control',
                                            'value' => (isset($postdata) && isset($postdata['country'])) ? $postdata['country'] : (isset($user) ? ($user->user_profile->country) : '')
                                        ));
                                        echo form_error('country');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <?php
                                        echo form_input(array('name' => 'telephone', 'class' => 'form-control', 'placeholder' => 'Telephone',
                                            'value' => (isset($postdata) && isset($postdata['telephone'])) ? $postdata['telephone'] : (isset($user) && $user->user_profile ? $user->user_profile->telephone : '')
                                        ));
                                        ?>
                                        <?php echo form_label('<span style="color: red">*</span> Telephone', 'telephone'); ?>
                                        <?php echo form_error('telephone'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <?php
                                        echo form_input(array('name' => 'mobile', 'class' => 'form-control', 'placeholder' => 'Mobile',
                                            'value' => (isset($postdata) && isset($postdata['mobile'])) ? $postdata['mobile'] : (isset($user) && $user->user_profile ? $user->user_profile->mobile : '')
                                        ));
                                        ?>
                                        <?php echo form_label('Mobile', 'mobile'); ?>
                                        <?php echo form_error('mobile'); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <?php
                                        echo form_input(array('name' => 'company',
                                            'id' => 'company',
                                            'palceholder' => 'Company', 'class' => 'form-control',
                                            'value' => (isset($postdata) && isset($postdata['company'])) ? $postdata['company'] : (isset($user) ? ($user->user_profile->company) : ''),
                                        ));
                                        ?>
                                        <?php echo form_label('Company', 'company'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <?php
                                        echo form_input(array('name' => 'fax',
                                            'id' => 'fax',
                                            'palceholder' => 'fax', 'class' => 'form-control',
                                            'value' => (isset($postdata) && isset($postdata['fax'])) ? $postdata['fax'] : (isset($user) ? ($user->user_profile->fax) : ''),
                                        ));
                                        ?>
                                        <?php echo form_label('Fax', 'fax'); ?>
                                        <?php
                                        echo form_error('fax');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">

                                        <?php
                                        echo form_textarea(array('name' => 'aboutme', 'cols' => "0 ", 'id' => 'aboutme', 'class' => 'form-control', 'placeholder' => 'About Me', 'rows' => '0',
                                            'value' => (isset($postdata) && isset($postdata['aboutme'])) ? $postdata['aboutme'] : (isset($user) && $user->user_profile ? $user->user_profile->aboutme : '')
                                        ));
                                        ?>
                                        <?php echo form_label('About Me', 'aboutme'); ?>
                                        <?php echo form_error('aboutme'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-actionbar">
                            <div class="card-actionbar-row">
                                <?php
                                echo form_submit(array('name' => 'submit',
                                    'id' => 'submit',
                                    'value' => 'Submit',
                                    'class' => 'btn btn-danger ink-reaction'
                                ));
                                ?>
                            </div>
                        </div>
                    </div><!--end .card -->
                    <?php echo form_close(); ?>
                </div><!--end .col -->
            </div><!--end .row -->
        </div><!--end .section-body -->
    </section>
</div><!--end #content-->