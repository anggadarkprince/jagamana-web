<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php $this->load->view("website/elements/sidebar"); ?>
            </div>
            <div class="col-md-9">
                <div class="main-content">
                    <form action="<?=site_url()?>job/save" method="post" class="form-horizontal" role="form" id="jm-form-job">
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-briefcase"></i> Create Job</h3>
                                <p>Manage job vacancy</p>
                            </div>

                            <!-- alert -->
                            <?php
                            if(isset($operation))
                            {
                                ?>
                                <div class="alert alert-<?=$operation?> alert-block alert-dismissible" role="alert">
                                    <?php echo $message; ?>
                                </div>
                            <?php
                            }
                            ?>
                            <!-- end of alert -->

                            <div class="form-group">
                                <label for="jm-job-field" class="col-sm-2 control-label">Job Field</label>
                                <div class="col-sm-10">
                                    <select class="form-control select select-primary mbl required" id="jm-job-field" name="jm-job-field" title="This field is required.">
                                        <option value="" <?=set_select('jm-job-field', '', TRUE); ?>>Select Field</option>
                                        <?php
                                        if(isset($fields))
                                        {
                                            foreach($fields as $field):
                                            ?>

                                                <option value="<?=$field["jfd_id"]?>" <?=set_select('jm-job-field', $field["jfd_id"]); ?>><?=$field["jfd_field"]?></option>

                                            <?php
                                            endforeach;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-muted">Select job related field</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-job-vacancy" class="col-sm-2 control-label">Vacancy</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jm-job-vacancy" name="jm-job-vacancy" placeholder="Your title job vacancy" required maxlength="45" value="<?=set_value('jm-job-vacancy', "");?>">
                                    <span class="text-muted">Eg. Doctor Specialist Senior</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-job-type" class="col-sm-2 control-label">Type</label>
                                <div class="col-sm-10">
                                    <select class="form-control select select-primary mbl required" id="jm-job-type" name="jm-job-type" title="This field is required.">
                                        <option value="" <?=set_select('jm-job-type', '', TRUE); ?>>Select Type</option>
                                        <?php
                                        if(isset($types))
                                        {
                                            foreach($types as $type):
                                                ?>

                                                <option value="<?=$type["jty_id"]?>" <?=set_select('jm-job-type', $type["jty_id"]); ?>><?=$type["jty_type"]?></option>

                                            <?php
                                            endforeach;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-muted">Select job type for this vacancy</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-job-level" class="col-sm-2 control-label">Level</label>
                                <div class="col-sm-10">
                                    <select class="form-control select select-primary mbl required" id="jm-job-level" name="jm-job-level" title="This field is required.">
                                        <option value="" <?=set_select('jm-job-level', '', TRUE); ?>>Select Level</option>
                                        <?php
                                        if(isset($levels))
                                        {
                                            foreach($levels as $level):
                                                ?>

                                                <option value="<?=$level["jlv_id"]?>" <?=set_select('jm-job-level', $level["jlv_id"]); ?>><?=$level["jlv_level"]?></option>

                                            <?php
                                            endforeach;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-muted">Select job level for this vacancy</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-job-location-country" class="col-sm-2 control-label">Location</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="jm-job-location-country" class="control-label">Country</label>
                                            <select class="form-control select select-primary select-block mbl required" id="jm-job-location-country" name="jm-job-location-country" title="This field is required.">
                                                <option value="" <?=set_select('jm-job-location-country', '', TRUE); ?>>Select Country</option>
                                                <?php
                                                if(isset($countries))
                                                {
                                                    foreach($countries as $country):
                                                        ?>

                                                        <option value="<?=$country["ctr_id"]?>" <?=set_select('jm-job-location-country', $country["ctr_id"]); ?>><?=$country["ctr_country"]?></option>

                                                    <?php
                                                    endforeach;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="jm-job-location-province" class="control-label">Province</label>
                                            <select class="form-control select select-primary select-block mbl required" id="jm-job-location-province" name="jm-job-location-province" title="This field is required.">
                                                <option value="" <?=set_select('jm-job-location-province', '', TRUE); ?>>Select Province</option>
                                                <?php
                                                if(isset($states))
                                                {
                                                    foreach($states as $state):
                                                        ?>

                                                        <option value="<?=$state["stt_id"]?>" <?=set_select('jm-job-location-province', $state["stt_id"]); ?>><?=$state["stt_state"]?></option>

                                                    <?php
                                                    endforeach;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="jm-job-location-city" class="control-label">City</label>
                                            <select class="form-control select select-primary select-block mbl required" id="jm-job-location-city" name="jm-job-location-city" title="This field is required.">
                                                <option value="" <?=set_select('jm-job-location-city', '', TRUE); ?>>Select City</option>
                                                <?php
                                                if(isset($cities))
                                                {
                                                    foreach($cities as $city):
                                                        ?>

                                                        <option value="<?=$city["cty_id"]?>" <?=set_select('jm-job-location-city', $city["cty_id"]); ?>><?=$city["cty_city"]?></option>

                                                    <?php
                                                    endforeach;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <span class="text-muted">Where your candidate needed</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="jm-job-description" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea rows="5" id="jm-job-description" name="jm-job-description" class="form-control" placeholder="Describe the job and necessary information" maxlength="4000" required><?=set_value('jm-job-description', "");?></textarea>
                                    <span class="text-muted">Job detail description</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-job-responsibility" class="col-sm-2 control-label">Responsibility</label>
                                <div class="col-sm-10">
                                    <textarea id="jm-job-responsibility" name="jm-job-responsibility" class="form-control wysiwyg" placeholder="Describe by list what candidate to do at work" maxlength="4000" required><?=set_value('jm-job-responsibility', "");?></textarea>
                                    <span class="text-muted">Specify job responsibility</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-job-qualification" class="col-sm-2 control-label">Qualification</label>
                                <div class="col-sm-10">
                                    <textarea id="jm-job-qualification" name="jm-job-qualification" class="form-control wysiwyg" placeholder="Specify the job requirement like education, certification, ect" maxlength="4000" required><?=set_value('jm-job-qualification', "");?></textarea>
                                    <span class="text-muted">What skill or condition which needed</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-job-qualification" class="col-sm-2 control-label">Open</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control datepicker" id="jm-job-open" name="jm-job-open" placeholder="Date this vacancy open" required value="<?=set_value('jm-job-open')?>">
                                    <span class="text-muted">Date announcement the job opened</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-job-qualification" class="col-sm-2 control-label">Close</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control datepicker" id="jm-job-close" name="jm-job-close" placeholder="Date this vacancy close" required value="<?=set_value('jm-job-close');?>">
                                    <span class="text-muted">Date announcement the job closed</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-job-ready" class="col-sm-2 control-label">Job Ready</label>
                                <div class="col-sm-10">
                                    <div class="mbsm">
                                        <input type="checkbox" data-toggle="switch" data-on-color="info" id="jm-job-ready" name="jm-job-ready" <?=set_checkbox('jm-job-ready', "on", TRUE); ?>/>
                                    </div>
                                    <span class="text-muted">Allow apply the job</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mtlg ptmd">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="reset" class="btn btn-default">RESET</button>
                                <button type="submit" class="btn btn-primary">SAVE JOB</button>
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
        $("#jm-job-location-country").change(function(){
            var id_country = $(this).val();
            var province = $("#jm-job-location-province");
            var city = $("#jm-job-location-city");
            var province_option = "<option value='' selected>Select Province</option>";
            var city_option = "<option value='' selected>Select City</option>";

            province.html(province_option);
            city.html(city_option);

            $("#select2-chosen-5").html("Select Province");
            $("#select2-chosen-6").html("Select City");

            $.ajax({
                type:"POST",
                url:"<?=site_url()?>state/read_json",
                data:{id_country:id_country},
                success:function(data){
                    var state = JSON.parse(data);
                    if(state.length == 0){
                        $("#select2-chosen-5").html("Select Province");
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

        $("#jm-job-location-province").change(function(){
            var id_state = $(this).val();
            var city = $("#jm-job-location-city");
            var city_option = "<option value='' selected>Select City</option>";

            city.html(city_option);

            $("#select2-chosen-6").html("Select City");

            $.ajax({
                type:"POST",
                url:"<?=site_url()?>city/read_json",
                data:{id_state:id_state},
                success:function(data){
                    var state = JSON.parse(data);
                    if(state.length == 0){
                        $("#select2-chosen-6").html("Select City");
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