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
                            <li><a href="<?=site_url()?>profile/opinion.html">OPINION</a></li>
                            <li class="active"><a href="<?=site_url()?>profile/achievement.html">ACHIEVEMENT</a></li>
                        </ul>
                    </div>
                    <form class="form-horizontal" role="form">
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-medkit"></i> Award Ever Reached</h3>
                                <p>List of achievement that have reached</p>
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
                                        <th width="30%" class="text-left">Award</th>
                                        <th width="20%" class="text-center">Reached</th>
                                        <th width="20%" class="text-center">Details</th>
                                        <th width="20%" class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(isset($achievements))
                                    {
                                        foreach($achievements as $achievement):
                                            ?>

                                            <tr data-id="<?=$achievement["ach_id"]?>" data-award="<?=$achievement["ach_award"]?>" data-earned="<?=$achievement["ach_earned"]?>" data-description="<?=$achievement["ach_description"]?>">
                                                <td class="text-center"><i class="fa fa-circle-o"></i></td>
                                                <td class="text-left"><?=$achievement["ach_award"]?></td>
                                                <td class="text-center"><?=$achievement["ach_earned"]?></td>
                                                <td class="text-center"><a href="<?=site_url()?>achievement/detail" class="achievement-detail">DETAIL</a></td>
                                                <td class="text-center">
                                                    <ul class="control list-inline">
                                                        <li><a href="<?=site_url()?>achievement/create" class="achievement-create"><i class="fa fa-file"></i></a></li>
                                                        <li><a href="<?=site_url()?>achievement/edit" class="achievement-edit"><i class="fa fa-pencil"></i></a></li>
                                                        <li><a href="<?=site_url()?>achievement/delete" class="achievement-delete"><i class="fa fa-trash"></i></a></li>
                                                    </ul>
                                                </td>
                                            </tr>

                                            <?php
                                        endforeach;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-dash btn-block achievement-create"><i class="fa fa-plus-circle"></i> ADD NEW AWARD</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(".achievement-delete").click(function(e){
        e.preventDefault();
        var row = $(this).parent().parent().parent().parent();
        var id = row.data("id");
        var label = row.data("award");
        var link = $(this).attr("href")+"/"+id;
        var title = "Achievement";
        var message = "Are You Sure Want To Delete <strong>'"+label+"'</strong>?";
        $("#jm-form-delete").attr("action", link);
        $("#jm-delete-title").html(title);
        $("#jm-delete-message").html(message);
        $("#confirm-delete").modal("show");
    });

    $(".achievement-create").click(function(e){
        e.preventDefault();
        $("#modal-achievement-create").modal("show");
    });

    $(".achievement-edit").click(function(e){
        e.preventDefault();
        var row = $(this).parent().parent().parent().parent();
        var id = row.data("id");
        var award = row.data("award");
        var description = row.data("description");
        var earned = row.data("earned");

        var link =  '<?=base_url()."achievement/update/"?>'+id;
        $("#jm-form-achievement-edit").attr("action", link);
        $(".jm-achievement-award").val(award);
        $(".jm-achievement-description").val(description);
        $(".jm-achievement-earned").find("option[value='"+earned+"']").attr("selected");
        $("#modal-achievement-edit").modal("show");
    });

    $(".achievement-detail").click(function(e){
        e.preventDefault();
        var row = $(this).parent().parent();
        var award = row.data("award");
        var description = row.data("description");
        var earned = row.data("earned");

        $(".achievement-detail-award").text(award);
        $(".achievement-detail-description").text(description);
        $(".achievement-detail-earned").text(earned);
        $("#modal-achievement-detail").modal("show");
    });
</script>

<?php $this->load->view("website/modals/confirm_delete"); ?>
<?php $this->load->view("website/modals/achievement/achievement_create"); ?>
<?php $this->load->view("website/modals/achievement/achievement_edit"); ?>
<?php $this->load->view("website/modals/achievement/achievement_detail"); ?>