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
                            <li><a href="<?=site_url()?>office/profile.html">PROFILE</a></li>
                            <li class="active"><a href="<?=site_url()?>office/world.html">WORLD</a></li>
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
                    <form action="<?=site_url()?>office/update_world" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-globe"></i> Company In The World</h3>
                                <p>Business contribution in the world</p>
                            </div>

                            <div class="form-group">
                                <label for="jm-world-title" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jm-world-title" name="jm-world-title" placeholder="Professional action in the world" required maxlength="45" value="<?=set_value("jm-world-title",$world["cst_title"])?>">
                                    <span class="text-muted">What people thinking about your company</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-world-featured" class="col-sm-2 control-label">Featured</label>
                                <div class="col-sm-10">
                                    <?php
                                    $empty = "";
                                    if($world["cst_featured"] == null){
                                        $empty = "empty";
                                    }
                                    ?>
                                    <div class="select-image large <?=$empty?>">
                                        <div class="image-wrapper">
                                            <img src="<?=base_url()?>assets/img/office/<?=$world["cst_featured"]?>" class="img-responsive select-image-preview"/>
                                        </div>
                                        <input type="file" class="form-control select-image-file" id="jm-world-featured" name="jm-world-featured" placeholder="Select featured image">
                                    </div>
                                    <span class="text-muted">Optional image, for best view recommended 800px x 500px dimension</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-world-description" class="col-sm-2 control-label">People Know</label>
                                <div class="col-sm-10">
                                    <textarea id="jm-world-description" name="jm-world-description" class="form-control wysiwyg" placeholder="Tell point of view people about your business" required maxlength="2000"><?=set_value("jm-world-description",$world["cst_description"])?></textarea>
                                    <span class="text-muted">How people know and what company know max 2000 character</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-world-active" class="col-sm-2 control-label">Active</label>
                                <div class="col-sm-10">
                                    <div class="mtxs">
                                        <?php
                                        $yes = false;
                                        $no = false;
                                        if($world["cst_active"]){
                                            $yes = true;
                                        }
                                        else{
                                            $no = true;
                                        }
                                        ?>
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" value="1" id="jm-world-active" name="jm-world-status" data-toggle="radio" class="custom-radio required" <?=set_radio('jm-world-status', 1, $yes);?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                Yes
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" value="0" id="jm-world-inactive" name="jm-world-status" data-toggle="radio" class="custom-radio" <?=set_radio('jm-world-status', 0, $no);?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <span class="text-muted">Set [Company World] section is visible or not</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-star"></i> Office Unique</h3>
                                <p>Tell another story about your company</p>
                            </div>

                            <div class="form-group">
                                <label for="jm-unique-title" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jm-unique-title" name="jm-unique-title" placeholder="Unique title story" value="<?=set_value("jm-unique-title",$unique["cst_title"])?>">
                                    <span class="text-muted">Describe some awesome</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-unique-featured" class="col-sm-2 control-label">Featured</label>
                                <div class="col-sm-10">
                                    <?php
                                    $empty = "";
                                    if($unique["cst_featured"] == null){
                                        $empty = "empty";
                                    }
                                    ?>
                                    <div class="select-image large <?=$empty?>">
                                        <div class="image-wrapper">
                                            <img src="<?=base_url()?>assets/img/office/<?=$unique["cst_featured"]?>" class="img-responsive select-image-preview"/>
                                        </div>
                                        <input type="file" class="form-control select-image-file" id="jm-unique-featured" name="jm-unique-featured" placeholder="Select featured image">
                                    </div>
                                    <span class="text-muted">Optional image, for best view recommended 800px x 500px dimension</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-world-description" class="col-sm-2 control-label">People Know</label>
                                <div class="col-sm-10">
                                    <textarea id="jm-unique-description" name="jm-unique-description" class="form-control wysiwyg" placeholder="Office unique thing that make your business different" maxlength="2000" required><?=set_value("jm-unique-description",$unique["cst_description"])?></textarea>
                                    <span class="text-muted">Another interesting story max 2000 character</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-unique-active" class="col-sm-2 control-label">Active</label>
                                <div class="col-sm-10">
                                    <div class="mtxs">
                                        <?php
                                        $yes = false;
                                        $no = false;
                                        if($unique["cst_active"]){
                                            $yes = true;
                                        }
                                        else{
                                            $no = true;
                                        }
                                        ?>
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" value="1" id="jm-unique-active" name="jm-unique-status" data-toggle="radio" class="custom-radio required" <?=set_radio('jm-unique-status', 1, $yes);?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                Yes
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" value="0" id="jm-unique-inactive" name="jm-unique-status" data-toggle="radio" class="custom-radio" <?=set_radio('jm-unique-status', 0, $no);?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <span class="text-muted">Set [Office Unique] section is visible or not</span>
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