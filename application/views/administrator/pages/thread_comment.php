<div class="title-section">
    <div class="title">
        <h1>Thread Comments</h1>
        <div class="pull-right mtxs">
            <a href="<?=site_url()?>threads/comment.html" class="btn-circle btn-o"><i class="fa fa-refresh"></i></a>
        </div>
    </div>
    <p class="subtitle">Show all thread had written, you can manage like create new, see profile in details, edit or remove them. Do all action with carefully because will affect the users data.</p>
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
    <div class="tab-navigation">
        <ul class="list-inline">
            <li><a href="<?=site_url()?>threads.html"><i class="fa fa-file"></i>THREADS</a></li>
            <li><a href="<?=site_url()?>threads/categories.html"><i class="fa fa-list-ul"></i>CATEGORIES</a></li>
            <li class="active"><a href="<?=site_url()?>threads/comments.html"><i class="fa fa-comment"></i>COMMENTS</a></li>
        </ul>
    </div>
</div>
<div class="content-section container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-responsive table-striped table-hover" id="datatable">
                <thead>
                <tr>
                    <th width="5%" class="text-center column-check">
                        <div class="checkbox">
                            <input type="checkbox" data-toggle="checkbox">
                            <label class="check"></label>
                        </div>
                    </th>
                    <th width="20%">Name</th>
                    <th width="25%">Thread</th>
                    <th width="40%">Comment</th>
                    <th width="10%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($comments))
                {
                    foreach($comments as $comment):
                        ?>

                        <tr data-id="<?=$comment["comment_id"]?>" data-name="<?=$comment["name"]?>" data-comment="<?=$comment["comment"]?>">
                            <td class="text-center">
                                <div class="checkbox">
                                    <input type="checkbox" data-toggle="checkbox">
                                    <label class="check"></label>
                                </div>
                            </td>
                            <td>
                                <img src="<?=base_url()?>assets/img/avatar/<?=$comment["employee_avatar"]?>" class="img-responsive img-circle avatar-table">
                                <span class="pull-left mtxs"><?=$comment["name"]?></span>
                            </td>
                            <td><a href="<?=site_url()?>forum/thread/<?=permalink($comment["thread"], $comment["thread_id"])?>.html" target="_blank"><?=$comment["thread"]?></a></td>
                            <td>
                                <?php
                                $text = character_limiter(strip_tags($comment["comment"]),65);
                                echo $text;
                                if(strlen($text) > 65){
                                ?>
                                <a href="<?=site_url()?>comment/detail" class="comment-detail">Read More</a>
                                <?php } ?>
                            </td>
                            <td><a href="<?=site_url()?>comment/delete" class="btn-circle action comment-delete"><i class="fa fa-trash"></i></a></td>
                        </tr>

                    <?php
                    endforeach;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $(".comment-detail").click(function(e){
            e.preventDefault();
            var row = $(this).parent().parent();
            var message = row.data("comment");
            $(".modal-title").html("Comment Message");
            $(".modal-message").html(message);
            $("#modal-info").modal("show");
        });

        $(".comment-delete").click(function(e){
            e.preventDefault();
            var row = $(this).parent().parent();
            var id = row.data("id");
            var name = row.data("name");
            var link = "<?=site_url()?>comment/delete/"+id;
            $("#jm-delete-title").html("Comment");
            $("#jm-delete-message").html("Are sure want to delete this comment "+name+"?");
            $("#jm-form-delete").attr("action", link);
            $("#jm-delete-id").val(id);
            $("#modal-delete").modal("show");
        });
    });
</script>

<?php $this->load->view("administrator/modals/info") ?>
<?php $this->load->view("administrator/modals/delete") ?>