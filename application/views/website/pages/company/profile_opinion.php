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
                            <li><a href="<?=site_url()?>profile/story.html">STORY</a></li>
                            <li><a href="<?=site_url()?>profile/task.html">TASK</a></li>
                            <li class="active"><a href="<?=site_url()?>profile/opinion.html">OPINION</a></li>
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
                    <form action="<?=site_url()?>profile/update_opinion" method="post" enctype="multipart/form-data" class="form-horizontal" id="jm-form-opinion" role="form">
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-user"></i> Expecting From Applicant</h3>
                                <p>Tell the story about how and what expecting from applicant</p>
                            </div>

                            <div class="form-group">
                                <label for="jm-expectation-expecting" class="col-sm-2 control-label">Expecting</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jm-expectation-expecting" name="jm-expectation-expecting" placeholder="Caption for applicant" required maxlength="45" value="<?=set_value("jm-expectation-expecting",$expectation["cst_title"])?>">
                                    <span class="text-muted">What your expecting from applicant</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-expectation-featured" class="col-sm-2 control-label">Featured</label>
                                <div class="col-sm-10">
                                    <?php
                                    $empty = "";
                                    if($expectation["cst_featured"] == null){
                                        $empty = "empty";
                                    }
                                    ?>
                                    <div class="select-image large <?=$empty?>">
                                        <div class="image-wrapper">
                                            <img src="<?=base_url()?>assets/img/office/<?=$expectation["cst_featured"]?>" class="img-responsive select-image-preview"/>
                                        </div>
                                        <input type="file" class="form-control select-image-file" id="jm-expectation-featured" name="jm-expectation-featured" placeholder="Select featured image">
                                    </div>
                                    <span class="text-muted">Optional image, for best view recommended 800px x 500px dimension</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-expectation-description" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea id="jm-expectation-description" name="jm-expectation-description" class="form-control wysiwyg" placeholder="Tell your company expectation for applicant" maxlength="2000" required><?=set_value("jm-who-description",$expectation["cst_description"])?></textarea>
                                    <span class="text-muted">More story about your business expectation max 2000 character</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-expectation-active" class="col-sm-2 control-label">Active</label>
                                <div class="col-sm-10">
                                    <div class="mtxs">
                                        <?php
                                        $yes = false;
                                        $no = false;
                                        if($expectation["cst_active"]){
                                            $yes = true;
                                        }
                                        else{
                                            $no = true;
                                        }
                                        ?>
                                        <div class="radio-inline">
                                            <label class="radio" for="jm-expectation-active">
                                                <input type="radio" value="1" id="jm-expectation-active" name="jm-expectation-status" data-toggle="radio" class="custom-radio required" <?=set_radio('jm-expectation-status', 1, $yes);?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                Yes
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label class="radio" for="jm-expectation-inactive">
                                                <input type="radio" value="0" id="jm-expectation-inactive" name="jm-expectation-status" data-toggle="radio" class="custom-radio" <?=set_radio('jm-expectation-status', 0, $no);?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <span class="text-muted">Set [Business Expectation] section is visible or not</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-users"></i> Employee Opinion</h3>
                                <p>Tell the story about how feeling your employee work on you</p>
                            </div>

                            <div class="form-group">
                                <label for="jm-opinion-feeling" class="col-sm-2 control-label">Feeling</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jm-opinion-feeling" name="jm-opinion-feeling" placeholder="Employee feeling" required maxlength="45" value="<?=set_value("jm-opinion-feeling",$opinion["cst_title"])?>">
                                    <span class="text-muted">Input your employee opinion respond</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-opinion-featured" class="col-sm-2 control-label">Featured</label>
                                <div class="col-sm-10">
                                    <?php
                                    $empty = "";
                                    if($expectation["cst_featured"] == null){
                                        $empty = "empty";
                                    }
                                    ?>
                                    <div class="select-image large <?=$empty?>">
                                        <div class="image-wrapper">
                                            <img src="<?=base_url()?>assets/img/office/<?=$opinion["cst_featured"]?>" class="img-responsive select-image-preview"/>
                                        </div>
                                        <input type="file" class="form-control select-image-file" id="jm-opinion-featured" name="jm-opinion-featured" placeholder="Select featured image">
                                    </div>
                                    <span class="text-muted">Optional image, for best view recommended 800px x 500px dimension</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-opinion-description" class="col-sm-2 control-label">Employee Story</label>
                                <div class="col-sm-10">
                                    <textarea id="jm-opinion-description" name="jm-opinion-description" class="form-control wysiwyg" placeholder="Tell your employee story" required maxlength="2000"><?=set_value("jm-opinion-description",$opinion["cst_description"])?></textarea>
                                    <span class="text-muted">More story about employee max 2000 character</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-opinion-active" class="col-sm-2 control-label">Active</label>
                                <div class="col-sm-10">
                                    <div class="mtxs">
                                        <?php
                                        $yes = false;
                                        $no = false;
                                        if($opinion["cst_active"]){
                                            $yes = true;
                                        }
                                        else{
                                            $no = true;
                                        }
                                        ?>
                                        <div class="radio-inline">
                                            <label class="radio" for="jm-opinion-active">
                                                <input type="radio" value="1" id="jm-opinion-active" name="jm-opinion-status" data-toggle="radio" class="custom-radio required" <?=set_radio('jm-opinion-status', 1, $yes);?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                Yes
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label class="radio" for="jm-opinion-inactive">
                                                <input type="radio" value="0" id="jm-opinion-inactive" name="jm-opinion-status" data-toggle="radio" class="custom-radio" <?=set_radio('jm-opinion-status', 0, $no);?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <span class="text-muted">Set [Employee Opinion] section is visible or not</span>
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