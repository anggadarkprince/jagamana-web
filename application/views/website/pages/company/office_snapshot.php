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
                            <li class="active"><a href="<?=site_url()?>office/snapshot.html">SNAPSHOT</a></li>
                            <li><a href="<?=site_url()?>office/profile.html">PROFILE</a></li>
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
                    <form action="<?=site_url()?>office/update_snapshot" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-camera"></i> Office Snapshot</h3>
                                <p>Some photo from your office</p>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Office Image</label>
                                <div class="col-sm-10">
                                    <?php
                                    $empty = "";
                                    if($primary["cph_resource"] == null || $primary["cph_resource"] == "noimage.jpg"){
                                        $empty = "empty";
                                    }
                                    ?>
                                    <input type="hidden" id="jm-primary-id" name="jm-primary-id" value="<?=$primary["cph_id"]?>">
                                    <div class="select-image large <?=$empty?>">
                                        <div class="image-wrapper">
                                            <img src="<?=base_url()?>assets/img/office/<?=$primary["cph_resource"]?>" id="img-office-featured" class="img-responsive select-image-preview"/>
                                        </div>
                                        <input type="file" class="form-control select-image-file" id="jm-snapshot-primary" name="jm-snapshot-primary" placeholder="Select featured image">
                                    </div>
                                    <span class="text-muted">Primary image, for best view recommended 1100px x 500px dimension</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Featured Image</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <?php
                                        if(isset($secondary))
                                        {
                                            $counter = 0;
                                            foreach($secondary as $row):
                                                $counter++;
                                                $empty = "";
                                                if($row["cph_resource"] == null || $row["cph_resource"] == "noimage.jpg"){
                                                    $empty = "empty";
                                                }
                                                ?>
                                                <input type="hidden" id="jm-secondary-id<?=$counter?>" name="jm-secondary-id<?=$counter?>" value="<?=$row["cph_id"]?>">
                                                <div class="col-md-4">
                                                    <div class="select-image small <?=$empty?>">
                                                        <div class="image-wrapper">
                                                            <img src="<?=base_url()?>assets/img/office/<?=$row["cph_resource"]?>" class="img-responsive select-image-preview"/>
                                                        </div>
                                                        <input type="file" class="form-control select-image-file" id="jm-snapshot-secondary<?=$counter?>" name="jm-snapshot-secondary<?=$counter?>" placeholder="Select featured image">
                                                    </div>
                                                </div>

                                                <?php
                                            endforeach;
                                        }
                                        ?>
                                    </div>
                                    <span class="text-muted">Secondary image, for best view recommended 600 x 400</span>
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