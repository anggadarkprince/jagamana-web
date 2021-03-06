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
                            <li><a href="<?=site_url()?>office/snapshot.html">SNAPSHOT</a></li>
                            <li class="active"><a href="<?=site_url()?>office/profile.html">PROFILE</a></li>
                            <li><a href="<?=site_url()?>office/world.html">WORLD</a></li>
                            <li><a href="<?=site_url()?>office/photo.html">MORE PHOTO</a></li>
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

                    <form action="<?=site_url()?>office/profile_update" method="post" enctype="multipart/form-data" class="form-horizontal" role="form" id="jm-form-office">
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-cube"></i> Office Life</h3>
                                <p>How your people work in company office</p>
                            </div>

                            <div class="form-group">
                                <label for="jm-life-title" class="col-sm-2 control-label">How Life</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jm-life-title" name="jm-life-title" placeholder="How beautiful your office" required maxlength="45" value="<?=set_value("jm-life-title",$life["cst_title"])?>">
                                    <span class="text-muted">How your office like</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-life-featured" class="col-sm-2 control-label">Featured</label>
                                <div class="col-sm-10">
                                    <?php
                                    $empty = "";
                                    if($life["cst_featured"] == null){
                                        $empty = "empty";
                                    }
                                    ?>
                                    <div class="select-image large <?=$empty?>">
                                        <div class="image-wrapper">
                                            <img src="<?=base_url()?>assets/img/office/<?=$life["cst_featured"]?>" class="img-responsive select-image-preview"/>
                                        </div>
                                        <input type="file" class="form-control select-image-file" id="jm-life-featured" name="jm-life-featured" placeholder="Select featured image">
                                    </div>
                                    <span class="text-muted">Optional image, for best view recommended 800px x 500px dimension</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-life-description" class="col-sm-2 control-label">Office Life</label>
                                <div class="col-sm-10">
                                    <textarea id="jm-life-description" name="jm-life-description" class="form-control wysiwyg" placeholder="Tell a story about your office" maxlength="2000" required><?=set_value("jm-life-description",$life["cst_description"])?></textarea>
                                    <span class="text-muted">Tell about office life max 2000 character</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-office-active" class="col-sm-2 control-label">Active</label>
                                <div class="col-sm-10">
                                    <div class="mtxs">
                                        <?php
                                        $yes = false;
                                        $no = false;
                                        if($life["cst_active"]){
                                            $yes = true;
                                        }
                                        else{
                                            $no = true;
                                        }
                                        ?>
                                        <div class="radio-inline">
                                            <label class="radio" for="jm-life-active">
                                                <input type="radio" value="1" id="jm-life-active" name="jm-life-status" data-toggle="radio" class="custom-radio required" <?=set_radio('jm-life-status', 1, $yes);?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                Yes
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label class="radio" for="jm-life-inactive">
                                                <input type="radio" value="0" id="jm-life-inactive" name="jm-life-status" data-toggle="radio" class="custom-radio" <?=set_radio('jm-life-status', 0, $no);?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <span class="text-muted">Set [Office Life] section is visible or not</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-map-marker"></i> Office Location</h3>
                                <p>Company location so everyone can visit you</p>
                            </div>

                            <div class="form-group">
                                <label for="jm-location-title" class="col-sm-2 control-label">Location Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jm-location-title" name="jm-location-title" placeholder="How beautiful your place" value="<?=set_value("jm-location-title",$location["cst_title"])?>">
                                    <span class="text-muted">How about your location</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Map Location</label>
                                <div class="col-sm-10">
                                    <div class="mbsm">
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" value="image" id="jm-location-image" name="jm-location-type" data-toggle="radio" class="custom-radio" checked>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                My Own Image Location
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" value="google" id="jm-location-google" name="jm-location-type" data-toggle="radio" class="custom-radio">
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                Google Coordinate
                                            </label>
                                        </div>
                                    </div>
                                    <div class="image-location" style="display: none">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="jm-location-lat" name="jm-location-lat" placeholder="Latitude" value="<?=set_value("jm-location-lat",$company["cmp_lat"])?>">
                                                <span class="text-muted">Google latitude coordinate</span>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="jm-location-lng" name="jm-location-lng" placeholder="Longitude" value="<?=set_value("jm-location-lng",$company["cmp_lng"])?>">
                                                <span class="text-muted">Google longitude coordinate</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="google-location">
                                        <?php
                                        $empty = "";
                                        if($location["cst_featured"] == null){
                                            $empty = "empty";
                                        }
                                        ?>
                                        <div class="select-image large <?=$empty?>">
                                            <div class="image-wrapper">
                                                <img src="<?=base_url()?>assets/img/office/<?=$location["cst_featured"]?>" class="img-responsive select-image-preview"/>
                                            </div>
                                            <input type="file" class="form-control select-image-file" id="jm-location-featured" name="jm-location-featured" placeholder="Select featured image">
                                        </div>
                                        <span class="text-muted">Optional image, for best view recommended 800px x 500px dimension</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-location-description" class="col-sm-2 control-label">Location Description</label>
                                <div class="col-sm-10">
                                    <textarea id="jm-location-description" name="jm-location-description" class="form-control wysiwyg" placeholder="Tell a story about your office" maxlength="2000" required><?=set_value("jm-location-description",$location["cst_description"])?></textarea>
                                    <span class="text-muted">Tell about office life max 2000 character</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-location-active" class="col-sm-2 control-label">Active</label>
                                <div class="col-sm-10">
                                    <div class="mtxs">
                                        <?php
                                        $yes = false;
                                        $no = false;
                                        if($location["cst_active"]){
                                            $yes = true;
                                        }
                                        else{
                                            $no = true;
                                        }
                                        ?>
                                        <div class="radio-inline">
                                            <label class="radio" for="jm-location-active">
                                                <input type="radio" value="1" id="jm-location-active" name="jm-location-status" data-toggle="radio" class="custom-radio required" <?=set_radio('jm-location-status', 1, $yes);?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                Yes
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label class="radio" for="jm-location-inactive">
                                                <input type="radio" value="0" id="jm-location-inactive" name="jm-location-status" data-toggle="radio" class="custom-radio" <?=set_radio('jm-location-status', 0, $no);?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <span class="text-muted">Set [Office Location] section is visible or not</span>
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