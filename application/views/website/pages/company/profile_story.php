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
                            <li><a href="<?=site_url()?>profile/about.html">ABOUT</a></li>
                            <li class="active"><a href="<?=site_url()?>profile/story.html">STORY</a></li>
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
                    <form action="<?=site_url()?>profile/update_story" method="post" enctype="multipart/form-data" class="form-horizontal" id="jm-form-story" role="form">
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-question-circle"></i> Who We Are</h3>
                                <p>Tell the story about your business</p>
                            </div>

                            <div class="form-group">
                                <label for="jm-who-we" class="col-sm-2 control-label">We Are</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jm-who-we" name="jm-who-we" placeholder="Who are you actually" maxlength="45" required value="<?=set_value("jm-who-we",$who["cst_title"])?>">
                                    <span class="text-muted">Company identity profile</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-who-featured" class="col-sm-2 control-label">Featured</label>
                                <div class="col-sm-10">
                                    <?php
                                    $empty = "";
                                    if($who["cst_featured"] == null){
                                        $empty = "empty";
                                    }
                                    ?>
                                    <div class="select-image large <?=$empty?>">
                                        <div class="image-wrapper">
                                            <img src="<?=base_url()?>assets/img/office/<?=$who["cst_featured"]?>" class="img-responsive select-image-preview"/>
                                        </div>
                                        <input type="file" class="form-control select-image-file" id="jm-who-featured" name="jm-who-featured" placeholder="Select featured image">
                                    </div>
                                    <span class="text-muted">Optional image, for best view recommended 800px x 500px dimension</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-who-description" class="col-sm-2 control-label">Business Story</label>
                                <div class="col-sm-10">
                                    <textarea id="jm-who-description" name="jm-who-description" class="form-control wysiwyg" placeholder="Put company short description" required maxlength="2000"><?=set_value("jm-who-description",$who["cst_description"])?></textarea>
                                    <span class="text-muted">More story about your business max 2000 character</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-company-active" class="col-sm-2 control-label">Active</label>
                                <div class="col-sm-10">
                                    <div class="mtxs">
                                        <?php
                                        $yes = false;
                                        $no = false;
                                        if($who["cst_active"]){
                                            $yes = true;
                                        }
                                        else{
                                            $no = true;
                                        }
                                        ?>
                                        <div class="radio-inline">
                                            <label class="radio" for="jm-who-active">
                                                <input type="radio" value="1" id="jm-who-active" name="jm-who-status" data-toggle="radio" class="custom-radio required" <?=set_radio('jm-who-status', 1, $yes);?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                Yes
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label class="radio" for="jm-who-inactive">
                                                <input type="radio" value="0" id="jm-who-inactive" name="jm-who-status" data-toggle="radio" class="custom-radio" <?=set_radio('jm-who-status', 0, $no);?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <span class="text-muted">Set [Who We Are] section is visible or not</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-random"></i> Office Culture</h3>
                                <p>Tell the story about office environment and how you work</p>
                            </div>

                            <div class="form-group">
                                <label for="jm-culture-title" class="col-sm-2 control-label">Culture</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jm-culture-title" name="jm-culture-title" placeholder="Caption office culture" maxlength="45" required value="<?=set_value("jm-culture-title",$culture["cst_title"])?>">
                                    <span class="text-muted">Describe your business culture</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-office-featured" class="col-sm-2 control-label">Featured</label>
                                <div class="col-sm-10">
                                    <?php
                                    $empty = "";
                                    if($culture["cst_featured"] == null){
                                        $empty = "empty";
                                    }
                                    ?>
                                    <div class="select-image large <?=$empty?>">
                                        <div class="image-wrapper">
                                            <img src="<?=base_url()?>assets/img/office/<?=$culture["cst_featured"]?>" class="img-responsive select-image-preview"/>
                                        </div>
                                        <input type="file" class="form-control select-image-file" id="jm-culture-featured" name="jm-culture-featured" placeholder="Select featured image">
                                    </div>
                                    <span class="text-muted">Optional image, for best view recommended 800px x 500px dimension</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-culture-description" class="col-sm-2 control-label">Office Story</label>
                                <div class="col-sm-10">
                                    <textarea id="jm-culture-description" name="jm-culture-description" class="form-control wysiwyg" placeholder="Put your office short story" maxlength="2000" required><?=set_value("jm-culture-description",$culture["cst_description"])?></textarea>
                                    <span class="text-muted">More story about your office max 2000 character</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-office-active" class="col-sm-2 control-label">Active</label>
                                <div class="col-sm-10">
                                    <div class="mtxs">
                                        <?php
                                        $yes = false;
                                        $no = false;
                                        if($culture["cst_active"]){
                                            $yes = true;
                                        }
                                        else{
                                            $no = true;
                                        }
                                        ?>
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" value="1" id="jm-culture-active" name="jm-culture-status" data-toggle="radio" class="custom-radio required" <?=set_radio('jm-culture-status', 1, $yes);?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                Yes
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" value="0" id="jm-culture-inactive" name="jm-culture-status" data-toggle="radio" class="custom-radio" <?=set_radio('jm-culture-status', 0, $no);?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <span class="text-muted">Set [Office Culture] section is visible or not</span>
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