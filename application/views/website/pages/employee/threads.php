<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php $this->load->view("website/elements/sidebar"); ?>
            </div>
            <div class="col-md-9">
                <div class="main-content">
                    <div class="form-section">
                        <div class="title">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3><i class="fa fa-comments"></i> Thread List</h3>
                                    <p class="mbn">Your thread post in forum</p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="<?=site_url()?>thread/create.html" class="btn btn-primary pull-right">CREATE THREAD</a>
                                </div>
                            </div>
                        </div>
                        <!-- alert -->
                        <?php
                        if($this->session->flashdata('jm-operation')!= NULL)
                        {
                            ?>
                            <div class="alert alert-<?=$this->session->flashdata('jm-operation')?> alert-block alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo $this->session->flashdata('jm-message'); ?>
                            </div>
                        <?php
                        }
                        ?>
                        <!-- end of alert -->
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-hover table-responsive table-custom">
                                    <thead>
                                    <tr>
                                        <th width="10%" class="text-center"><i class="fa fa-circle-o"></i></th>
                                        <th width="25%" class="text-left">Thread</th>
                                        <th width="20%" class="text-center">Category</th>
                                        <th width="10%" class="text-center">Comment</th>
                                        <th width="15%" class="text-center">Status</th>
                                        <th width="20%" class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(isset($threads))
                                    {
                                        if(count($threads) == 0){
                                            echo "<tr><td colspan='6' class='text-center'>No threads created</td><tr>";
                                        }
                                        foreach($threads as $thread):
                                            ?>

                                            <tr class="table-row">
                                                <td class="text-center"><i class="fa fa-circle-o"></i></td>
                                                <td><a href="<?=site_url()?>forum/thread/<?=$thread["permalink"]?>.html" target="_blank" class="row-title"><?=$thread["title"]?></a></td>
                                                <td class="text-center"><a href="<?=site_url()?>forum/category/<?=$thread["permalink_category"]?>.html" target="_blank"><?=$thread["category"]?></a></td>
                                                <td class="text-center"><?=$thread["comment"]?></td>
                                                <td class="text-center"><?=$thread["status"]?></td>
                                                <td class="text-center">
                                                    <ul class="control list-inline">
                                                        <li><a href="<?=site_url()?>thread/create.html"><i class="fa fa-file"></i></a></li>
                                                        <li><a href="<?=site_url()?>thread/edit/<?=$thread["permalink"]?>.html"><i class="fa fa-pencil"></i></a></li>
                                                        <li><a href="<?=site_url()?>thread/delete/<?=$thread["permalink"]?>.html" class="delete" data-title="Thread"><i class="fa fa-trash"></i></a></li>
                                                    </ul>
                                                </td>
                                            </tr>

                                            <?php
                                        endforeach;
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a href="<?=site_url()?>thread/create.html" class="btn btn-dash btn-block"><i class="fa fa-plus-circle"></i> CREATE THREAD</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $(".table-row .delete").click(function(e){
            e.preventDefault();
            var link = $(this).attr("href");
            var title = $(this).data("title");
            var message = "Are You Sure Want To Delete <strong>'"+$(this).parent().parent().parent().parent().find(".row-title").text()+"'</strong>?";
            $("#jm-form-delete").attr("action", link);
            $("#jm-delete-title").html(title);
            $("#jm-delete-message").html(message);
            $("#confirm-delete").modal("show");
        });
    });
</script>

<?php $this->load->view("website/modals/confirm_delete"); ?>