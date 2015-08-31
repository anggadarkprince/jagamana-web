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
                            <li>
                                <div class="image-wrapper">
                                    <img width="80" src="<?=base_url()?>assets/img/people/<?=$people["plp_avatar"]?>" id="jm-people-avatar" class="select-image-preview"/>
                                </div>
                            </li>
                            <li><a href="<?=site_url()?>people/profile/<?=$this->uri->segment(3)?>.html">PROFILE</a></li>
                            <li><a href="<?=site_url()?>people/contact/<?=$this->uri->segment(3)?>.html">CONTACT</a></li>
                            <li class="active"><a href="<?=site_url()?>people/work/<?=$this->uri->segment(3)?>.html">WORK</a></li>
                            <li><a href="<?=site_url()?>people/photo/<?=$this->uri->segment(3)?>.html">MORE PHOTO</a></li>
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
                    <form action="<?=site_url()?>people/update_work/<?=$this->uri->segment(3)?>.html" method="post" class="form-horizontal" role="form" id="jm-form-people">
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-briefcase"></i> What People Does</h3>
                                <p>What specific task job to complete</p>
                            </div>

                            <div class="form-group">
                                <label for="jm-work-job" class="col-sm-3 control-label">What Do You Do</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="jm-work-title" name="jm-work-title" placeholder="Facebook complete url" required maxlength="45" value="<?=set_value("jm-work-title", $job["pst_title"])?>">
                                    <span class="text-muted">What kind of job you handle</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-work-description" class="col-sm-3 control-label">Job Description</label>
                                <div class="col-sm-9">
                                    <textarea id="jm-work-description" name="jm-work-description" class="form-control wysiwyg" placeholder="Tell what kind of task you handled and role in you position" maxlength="2000" required><?=set_value("jm-work-job", $job["pst_title"])?></textarea>
                                    <span class="text-muted">How people know and what company know max 2000 character</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-calendar-o"></i> Daily At Work</h3>
                                <p>Kind of activity you complete everyday</p>
                            </div>

                            <div class="form-group">
                                <label for="jm-daily-work" class="col-sm-3 control-label">You at Work</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="jm-daily-title" name="jm-daily-title" placeholder="Your daily activity" required maxlength="45" value="<?=set_value("jm-daily-title", $daily["pst_title"])?>">
                                    <span class="text-muted">Tell how your feeling work in office environment</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-daily-description" class="col-sm-3 control-label">Activity Description</label>
                                <div class="col-sm-9">
                                    <textarea id="jm-daily-description" name="jm-daily-description" class="form-control wysiwyg" placeholder="Tell a story about you day in office" maxlength="2000"><?=set_value("jm-daily-description", $daily["pst_description"])?></textarea>
                                    <span class="text-muted">What do you do at work max 2000 character</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-comments"></i> Tell About Company</h3>
                                <p>Your complete comment about works and office</p>
                            </div>

                            <div class="form-group">
                                <label for="jm-opinion-title" class="col-sm-3 control-label">Opinion</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="jm-opinion-title" name="jm-opinion-title" placeholder="Your daily activity" required maxlength="45" value="<?=set_value("jm-opinion-title", $opinion["pst_title"])?>">
                                    <span class="text-muted">Opinion about company</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-opinion-description" class="col-sm-3 control-label">Short Description</label>
                                <div class="col-sm-9">
                                    <textarea id="jm-opinion-description" name="jm-opinion-description" class="form-control wysiwyg" placeholder="Give a opinion about company" maxlength="2000" required><?=set_value("jm-opinion-description", $opinion["pst_description"])?></textarea>
                                    <span class="text-muted">How about you company max 200 character</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mtlg ptmd">
                            <div class="col-sm-offset-2 col-sm-10">
                                <a href="<?=site_url()?>people" class="btn btn-default">BACK TO LIST</a>
                                <button type="submit" class="btn btn-primary">SAVE CHANGES</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>