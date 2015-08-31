<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php $this->load->view("website/elements/sidebar"); ?>
            </div>
            <div class="col-md-9">
                <div class="main-content">
                    <div class="tab-navigation guided">
                        <ul class="list-inline">
                            <li class="active"><a href="<?=site_url()?>profile/about.html">ABOUT</a></li>
                            <li><a href="<?=site_url()?>profile/story.html">STORY</a></li>
                            <li><a href="<?=site_url()?>profile/task.html">TASK</a></li>
                            <li><a href="<?=site_url()?>profile/opinion.html">OPINION</a></li>
                            <li><a href="<?=site_url()?>profile/achievement.html">ACHIEVEMENT</a></li>
                        </ul>
                    </div>
                    <!-- alert -->
                    <?php
                    if($this->session->flashdata('jm-operation')!= NULL)
                    {
                        ?>
                        <div class="alert alert-<?=$this->session->flashdata('jm-operation')?> alert-block alert-dismissible mtmd" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo $this->session->flashdata('jm-message'); ?>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- end of alert -->

                    <!-- alert -->
                    <?php
                    if(isset($operation))
                    {
                        ?>
                        <div class="alert alert-<?=$operation?> alert-block alert-dismissible mtmd" role="alert">
                            <?php echo $message; ?>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- end of alert -->
                    <form action="<?=site_url()?>profile/update_about" method="post" enctype="multipart/form-data" class="form-horizontal" id="jm-form-about" role="form">
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-suitcase"></i> Basic Information</h3>
                                <p>Information about your business</p>
                            </div>

                            <div class="form-group">
                                <label for="jm-profile-company" class="col-sm-2 control-label">Company</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jm-profile-company" name="jm-profile-company" placeholder="Put your company" required maxlength="45" value="<?=set_value("jm-profile-company",$about["cmp_name"])?>">
                                    <span class="text-muted">Input your complete name</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-profile-type" class="col-sm-2 control-label">Field</label>
                                <div class="col-sm-10">
                                    <select class="form-control select select-primary mbl" id="jm-profile-type" name="jm-profile-field">
                                        <option value="" <?=set_select('jm-profile-field', '', TRUE); ?>>Select Field</option>
                                        <?php
                                        if(isset($fields))
                                        {
                                            foreach($fields as $field):
                                                $selected = "";
                                                if($about["cmp_field"] == $field["cfd_id"])
                                                {
                                                    $selected = TRUE;
                                                }
                                                else{
                                                    $selected = FALSE;
                                                }
                                                ?>

                                                <option value="<?=$field["cfd_id"]?>" <?=set_select('jm-profile-field', $field["cfd_id"], $selected); ?>><?=$field["cfd_field"]?></option>

                                            <?php
                                            endforeach;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-muted">Select your business field</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-profile-location-country" class="col-sm-2 control-label">Location</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="jm-profile-location-country" class="control-label">Country</label>
                                            <select class="form-control select select-primary select-block mbl required" id="jm-profile-location-country" name="jm-profile-location-country" title="This field is required.">
                                                <option value="" <?=set_select('jm-profile-location-country', '', TRUE); ?>>Select Country</option>
                                                <?php
                                                if(isset($countries))
                                                {
                                                    foreach($countries as $country):
                                                        $selected = "";
                                                        if($about["country_id"] == $country["ctr_id"])
                                                        {
                                                            $selected = TRUE;
                                                        }
                                                        else{
                                                            $selected = FALSE;
                                                        }
                                                        ?>

                                                        <option value="<?=$country["ctr_id"]?>" <?=set_select('jm-profile-location-country', $country["ctr_id"], $selected); ?>><?=$country["ctr_country"]?></option>

                                                    <?php
                                                    endforeach;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="jm-profile-location-province" class="control-label">Province</label>
                                            <select class="form-control select select-primary select-block mbl required" id="jm-profile-location-province" name="jm-profile-location-province" title="This field is required.">
                                                <option value="" <?=set_select('jm-profile-location-province', '', TRUE); ?>>Select Province</option>
                                                <?php
                                                if(isset($states))
                                                {
                                                    foreach($states as $state):
                                                        $selected = "";
                                                        if($about["state_id"] == $state["stt_id"])
                                                        {
                                                            $selected = TRUE;
                                                        }
                                                        else{
                                                            $selected = FALSE;
                                                        }
                                                        ?>

                                                        <option value="<?=$state["stt_id"]?>" <?=set_select('jm-profile-location-province', $state["stt_id"], $selected); ?>><?=$state["stt_state"]?></option>

                                                    <?php
                                                    endforeach;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="jm-profile-location-city" class="control-label">City</label>
                                            <select class="form-control select select-primary select-block mbl required" id="jm-profile-location-city" name="jm-profile-location-city" title="This field is required.">
                                                <option value="" <?=set_select('jm-profile-location-city', '', TRUE); ?>>Select City</option>
                                                <?php
                                                if(isset($cities))
                                                {
                                                    foreach($cities as $city):
                                                        $selected = "";
                                                        if($about["city_id"] == $city["cty_id"])
                                                        {
                                                            $selected = TRUE;
                                                        }
                                                        else{
                                                            $selected = FALSE;
                                                        }
                                                        ?>

                                                        <option value="<?=$city["cty_id"]?>" <?=set_select('jm-profile-location-city', $city["cty_id"], $selected); ?>><?=$city["cty_city"]?></option>

                                                    <?php
                                                    endforeach;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <span class="text-muted">Where your business location</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-size-small" class="col-sm-2 control-label">Size</label>
                                <div class="col-sm-10">
                                    <div class="mtxs">
                                        <?php
                                        if(isset($sizes))
                                        {
                                            foreach($sizes as $size):
                                                $checked = false;
                                                if($about["size_id"] == $size["csz_id"]){
                                                    $checked = true;
                                                }
                                            ?>

                                                <div class="radio-inline">
                                                    <label class="radio" for="jm-size-<?=$size["csz_id"]?>">
                                                        <input type="radio" value="<?=$size["csz_id"]?>" id="jm-size-<?=$size["csz_id"]?>" name="jm-profile-size" data-toggle="radio" class="custom-radio" <?=set_radio('jm-profile-size', $size["csz_id"], $checked);?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                        <?=$size["csz_size"]?>
                                                    </label>
                                                </div>

                                            <?php
                                            endforeach;
                                        }
                                        ?>
                                    </div>
                                    <span class="text-muted">Select company size</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-profile-logo" class="col-sm-2 control-label">Logo</label>
                                <div class="col-sm-10">
                                    <div class="profile-avatar-wrapper mbsm">
                                        <img src="<?=base_url()?>assets/img/avatar/<?=$about["cmp_logo"]?>" class="account-avatar" style="max-height: 120px; width: auto"/>
                                    </div>
                                    <input type="file" id="jm-profile-logo" name="jm-profile-logo" value="SELECT IMAGE">
                                    <span class="text-muted">Recommendation 400px x 200px size dimension</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-profile-description" class="col-sm-2 control-label">Short Description</label>
                                <div class="col-sm-10">
                                    <textarea rows="3" id="jm-profile-description" name="jm-profile-description" class="form-control" placeholder="Put company description" required maxlength="350"><?=set_value("jm-profile-description", $about["cmp_description"])?></textarea>
                                    <span class="text-muted">Tell about your business max 350 character</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-phone-square"></i> Business Contact</h3>
                                <p>Keep in touch with you</p>
                            </div>

                            <div class="form-group">
                                <label for="jm-profile-contact" class="col-sm-2 control-label">Contact</label>
                                <div class="col-sm-10">
                                    <input type="tel" class="form-control" id="jm-profile-contact" name="jm-profile-contact" placeholder="Contact number or mobile phone" required maxlength="100" value="<?=set_value("jm-profile-contact", $about["cmp_contact"])?>">
                                    <span class="text-muted">Phone number with code area</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-profile-address" class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jm-profile-address" name="jm-profile-address" placeholder="Business address city or state" required maxlength="200" value="<?=set_value("jm-profile-address", $about["cmp_address"])?>">
                                    <span class="text-muted">Business detail location</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-profile-email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <label id="jm-profile-email" class="form-control text-muted disabled"><?=$about["cmp_email"]?></label>
                                    <span class="text-muted">Current company email (Can't edited)</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-profile-website" class="col-sm-2 control-label">Website</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="jm-profile-website" name="jm-profile-website" placeholder="Business web address http://" maxlength="100" value="<?=set_value("jm-profile-website", $about["cmp_website"])?>">
                                    <span class="text-muted">Enter company profile website</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mtlg ptmd">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="reset" class="btn btn-default">RESET</button>
                                <button type="submit" class="btn btn-primary">SAVE CHANGES</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        $("#jm-profile-location-country").change(function(){
            var id_country = $(this).val();
            var province = $("#jm-profile-location-province");
            var city = $("#jm-profile-location-city");
            var province_option = "<option value='' selected>Select Province</option>";
            var city_option = "<option value='' selected>Select City</option>";

            province.html(province_option);
            city.html(city_option);

            $("#select2-chosen-3").html("Select Province");
            $("#select2-chosen-4").html("Select City");

            $.ajax({
                type:"POST",
                url:"<?=site_url()?>state/read_json",
                data:{id_country:id_country},
                success:function(data){
                    var state = JSON.parse(data);
                    if(state.length == 0){
                        $("#select2-chosen-3").html("Select Province");
                    }
                    else{
                        $.each(state, function(index, row){
                            province_option += "<option value="+row.stt_id+">"+row.stt_state+"</option>";
                        });
                    }
                    province.html(province_option);
                },
                error:function(e){
                    alert("Something is getting wrong");
                }
            });
        });

        $("#jm-profile-location-province").change(function(){
            var id_state = $(this).val();
            var city = $("#jm-profile-location-city");
            var city_option = "<option value='' selected>Select City</option>";

            city.html(city_option);

            $("#select2-chosen-4").html("Select City");

            $.ajax({
                type:"POST",
                url:"<?=site_url()?>city/read_json",
                data:{id_state:id_state},
                success:function(data){
                    var state = JSON.parse(data);
                    if(state.length == 0){
                        $("#select2-chosen-4").html("Select City");
                    }
                    else{
                        $.each(state, function(index, row){
                            city_option += "<option value="+row.cty_id+">"+row.cty_city+"</option>";
                        });
                    }
                    city.html(city_option);
                },
                error:function(e){
                    alert("Something is getting wrong");
                }
            });
        });
    });
</script>