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
                            <li><a href="<?=site_url()?>people/work/<?=$this->uri->segment(3)?>.html">WORK</a></li>
                            <li class="active"><a href="<?=site_url()?>people/photo/<?=$this->uri->segment(3)?>.html">MORE PHOTO</a></li>
                        </ul>
                    </div>
                    <div class="form-section">
                        <div class="title">
                            <h3><i class="fa fa-camera"></i> More Photo</h3>
                            <p>List of people you want applicants meet</p>
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

                        <div class="mblg">
                            <table class="table table-striped table-hover table-responsive table-custom">
                                <thead>
                                <tr>
                                    <th width="10%" class="text-center"><i class="fa fa-circle-o"></i></th>
                                    <th width="30%" class="text-left">Images</th>
                                    <th width="20%" class="text-center">Details</th>
                                    <th width="20%" class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(isset($photos)){
                                    foreach($photos as $photo):
                                    ?>

                                        <tr data-id="<?=$photo["pph_id"]?>" data-title="<?=$photo["pph_title"]?>" data-resource="<?=$photo["pph_resource"]?>">
                                            <td class="text-center"><i class="fa fa-circle-o"></i></td>
                                            <td>
                                                <img src="<?=base_url()?>assets/img/people/<?=$photo["pph_resource"]?>" class="img-responsive avatar-table table-bordered">
                                                <span style="line-height: 30px"><?=ucwords(strtolower($photo["pph_title"]))?></span>
                                            </td>
                                            <td class="text-center"><a href="<?=site_url()?>photo/detail" class="photo-detail">DETAIL</a></td>
                                            <td class="text-center">
                                                <ul class="control list-inline">
                                                    <li><a href="<?=site_url()?>photo/create/people" class="photo-create"><i class="fa fa-file"></i></a></li>
                                                    <li><a href="<?=site_url()?>photo/delete/people" class="photo-delete"><i class="fa fa-trash"></i></a></li>
                                                </ul>
                                            </td>
                                        </tr>

                                    <?php
                                    endforeach;
                                }
                                ?>

                                </tbody>
                            </table>
                            <a href="<?=site_url()?>photo/create/people" class="btn btn-dash btn-block photo-create"><i class="fa fa-plus-circle"></i> ADD NEW PHOTO</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(".photo-delete").click(function(e){
        e.preventDefault();
        var row = $(this).parent().parent().parent().parent();
        var id = row.data("id");
        var title = row.data("title");
        var link = $(this).attr("href")+"/<?=$this->uri->segment(3)?>";
        var module = "Photo";
        var message = "Are You Sure Want To Delete <strong>'"+title+"'</strong>?";
        $("#jm-form-delete").attr("action", link);
        $("#jm-delete-title").html(module);
        $("#jm-delete-message").html(message);
        $("#jm-delete-id").val(id);
        $("#confirm-delete").modal("show");
    });

    $(".photo-create").click(function(e){
        e.preventDefault();
        $("#jm-form-photo").attr("action",$(this).attr("href")+"/<?=$this->uri->segment(3)?>");
        $("#modal-photo-create").modal("show");
    });

    $(".photo-detail").click(function(e){
        e.preventDefault();
        var row = $(this).parent().parent();
        var resource = row.data("resource");
        $("#photo-detail-featured").attr("src", '<?=base_url()."assets/img/people/"?>'+resource);
        $("#modal-photo-detail").modal("show");
    });
</script>

<?php $this->load->view("website/modals/confirm_delete"); ?>
<?php $this->load->view("website/modals/photo/photo_create"); ?>
<?php $this->load->view("website/modals/photo/photo_detail"); ?>