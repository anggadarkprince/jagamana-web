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
                                    <img width="80" src="<?=base_url()?>assets/img/people/<?=$people["plp_avatar"]?>" class="select-image-preview"/>
                                </div>
                            </li>
                            <li class="active"><a href="<?=site_url()?>people/profile/<?=$this->uri->segment(3)?>.html">PROFILE</a></li>
                            <li><a href="<?=site_url()?>people/contact/<?=$this->uri->segment(3)?>.html">CONTACT</a></li>
                            <li><a href="<?=site_url()?>people/work/<?=$this->uri->segment(3)?>.html">WORK</a></li>
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
                    <form action="<?=site_url()?>people/update_profile/<?=$this->uri->segment(3)?>.html" method="post" enctype="multipart/form-data" class="form-horizontal" role="form" id="jm-form-people">
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-user-plus"></i> Profile People</h3>
                                <p>Create new people in your team</p>
                            </div>

                            <div class="form-group">
                                <label for="jm-people-name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jm-people-name" name="jm-people-name" placeholder="E.g Angga Ari Wijaya" required maxlength="50" value="<?=set_value("jm-people-name",$people["plp_name"])?>">
                                    <span class="text-muted">Put employee complete name</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-people-position" class="col-sm-2 control-label">Position</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jm-people-position" name="jm-people-position" placeholder="E.g Manager" required maxlength="50" value="<?=set_value("jm-people-position",$people["plp_position"])?>"">
                                    <span class="text-muted">Position or field he/she work for</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-people-avatar" class="col-sm-2 control-label">Avatar</label>
                                <div class="col-sm-10">
                                    <?php
                                    $empty = "";
                                    if($people["plp_avatar"] == null || $people["plp_avatar"] == "noimage.jpg"){
                                        $empty = "empty";
                                    }
                                    ?>
                                    <div class="select-image small square <?=$empty?>">
                                        <div class="image-wrapper">
                                            <img src="<?=base_url()?>assets/img/people/<?=$people["plp_avatar"]?>" class="img-responsive select-image-preview"/>
                                        </div>
                                        <input type="file" class="form-control select-image-file" name="jm-people-avatar" id="jm-people-avatar" placeholder="Select avatar image">
                                    </div>
                                    <span class="text-muted">Avatar image, for best view recommended 500px x 500px dimension</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-people-description" class="col-sm-2 control-label">About</label>
                                <div class="col-sm-10">
                                    <textarea rows="4" id="jm-people-about" name="jm-people-about" class="form-control" placeholder="How he/she personality" maxlength="2000" required><?=set_value("jm-people-about",$people["plp_about"])?></textarea>
                                    <span class="text-muted">Profile description</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-people-cover" class="col-sm-2 control-label">Cover</label>
                                <div class="col-sm-10">
                                    <?php
                                    $empty = "";
                                    if($people["plp_cover"] == null || $people["plp_cover"] == "nocover.jpg"){
                                        $empty = "empty";
                                    }
                                    ?>
                                    <div class="select-image large <?=$empty?>">
                                        <div class="image-wrapper">
                                            <img src="<?=base_url()?>assets/img/people/<?=$people["plp_cover"]?>" class="img-responsive select-image-preview"/>
                                        </div>
                                        <input type="file" class="form-control select-image-file" id="jm-people-cover" name="jm-people-cover" placeholder="Select featured image">
                                    </div>
                                    <span class="text-muted">Optional image, for best view recommended 800px x 500px dimension</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-people-opinion" class="col-sm-2 control-label">Opinion</label>
                                <div class="col-sm-10">
                                    <textarea rows="4" id="jm-people-opinion" name="jm-people-opinion" class="form-control" placeholder="Personal opinion about your company" maxlength="300" required><?=set_value("jm-people-opinion",$people["plp_caption"])?></textarea>
                                    <span class="text-muted">Tell everyone how you this person excite in this company max 300 character</span>
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