<div class="title-section">
    <div class="title">
        <h1>Threads</h1>
        <div class="pull-right mtxs">
            <a href="<?=site_url()?>threads" class="btn-circle btn-o"><i class="fa fa-refresh"></i></a>
            <a href="#modal-delete" data-toggle="modal" class="btn-circle btn-o" id="delete-all"><i class="fa fa-trash"></i></a>
        </div>
    </div>
    <p class="subtitle">Show all thread had written, you can manage like create new, see profile in details, edit or remove them. Do all action with carefully because will affect the users data.</p>
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
    <div class="tab-navigation">
        <ul class="list-inline">
            <li class="active"><a href="<?=site_url()?>threads.html"><i class="fa fa-file"></i>THREADS</a></li>
            <li><a href="<?=site_url()?>threads/categories.html"><i class="fa fa-list-ul"></i>CATEGORIES</a></li>
            <li><a href="<?=site_url()?>threads/comments.html"><i class="fa fa-comment"></i>COMMENTS</a></li>
        </ul>
    </div>
</div>
<div class="content-section container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <form action="<?=site_url()?>threads/delete_all" method="post" id="table-threads">
                <table class="table table-responsive table-striped table-hover" id="datatable">
                    <thead>
                    <tr>
                        <th class="text-center column-check">
                            <div class="checkbox">
                                <input type="checkbox" data-toggle="checkbox">
                                <label class="check"></label>
                            </div>
                        </th>
                        <th>Thread</th>
                        <th>Category</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Commented</th>
                        <th class="text-center">Published At</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($threads))
                    {
                        foreach($threads as $thread):
                            ?>

                            <tr data-id="<?=$thread["thread_id"]?>">
                                <td class="text-center">
                                    <div class="checkbox">
                                        <input type="checkbox" name="checkid[]" value="<?=$thread["thread_id"]?>" data-toggle="checkbox">
                                        <label class="check"></label>
                                    </div>
                                </td>
                                <td><a href="<?=site_url()?>forum/thread/<?=permalink($thread["title"], $thread["thread_id"])?>.html" target="_blank"><?=$thread["title"]?></a></td>
                                <td><a href="<?=site_url()?>forum/category/<?=permalink($thread["category"], $thread["category_id"], false, true)?>.html" target="_blank"><?=$thread["category"]?></a></td>
                                <td class="text-center">
                                    <?php
                                    $label = "label-warning";
                                    if($thread["status"] == "PUBLISHED"){
                                        $label = "label-success";
                                    }
                                    ?>
                                    <label class="label <?=$label?>"><?=$thread["status"]?></label>
                                </td>
                                <td class="text-center"><?=$thread["comment"]?></td>
                                <td class="text-center"><?=date_format(date_create($thread["created_at"]),"d F Y")?></td>
                            </tr>

                        <?php
                        endforeach;
                    }
                    ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).on("click","#submit-delete", function(e){
        e.preventDefault();
        $("#table-threads").submit();
    });
</script>

<!-- Delete Modal -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="myModalLabel"><i class="fa fa-trash"></i> Delete <span  id="jm-delete-title"></span></h3>
            </div>
            <div class="modal-body">
                <input type="hidden" name="jm-delete-id" id="jm-delete-id">
                <p id="jm-delete-message">Are You Sure Delete All Selected Items?</p>
                <span class="text-muted">All related record will be deleted</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger" id="submit-delete">Delete Now</a>
            </div>
        </div>
    </div>
</div>