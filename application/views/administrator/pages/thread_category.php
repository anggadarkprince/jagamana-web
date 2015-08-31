<div class="title-section">
    <div class="title">
        <h1>Thread Categories</h1>
        <div class="pull-right mtxs">
            <a href="<?=site_url()?>category/create" class="btn-circle btn-o category-create"><i class="fa fa-file-o"></i></a>
            <a href="<?=site_url()?>thread/categories" class="btn-circle btn-o"><i class="fa fa-refresh"></i></a>
        </div>
    </div>
    <p class="subtitle">Show all category had written, you can manage like create new, see profile in details, edit or remove them. Do all action with carefully because will affect the users data.</p>
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
    <div class="tab-navigation">
        <ul class="list-inline">
            <li><a href="<?=site_url()?>threads.html"><i class="fa fa-file"></i>THREADS</a></li>
            <li class="active"><a href="<?=site_url()?>threads/categories.html"><i class="fa fa-list-ul"></i>CATEGORIES</a></li>
            <li><a href="<?=site_url()?>threads/comments.html"><i class="fa fa-comment"></i>COMMENTS</a></li>
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
                    <th width="25%">Category</th>
                    <th width="40%">Description</th>
                    <th width="15%" class="text-center">Thread</th>
                    <th width="15%" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($categories)){
                    foreach($categories as $category):
                        ?>

                        <tr data-id="<?=$category["category_id"]?>" data-category="<?=$category["category"]?>" data-description="<?=$category["description"]?>">
                            <td class="text-center">
                                <div class="checkbox">
                                    <input type="checkbox" data-toggle="checkbox">
                                    <label class="check" for="check2"></label>
                                </div>
                            </td>
                            <td><a href="<?=site_url()?>forum/category/<?=permalink($category["category"], $category["category_id"], false, true)?>.html" target="_blank"><?=$category["category"]?></a></td>
                            <td>
                                <?php
                                $text = character_limiter(strip_tags($category["description"]),65);
                                echo $text;
                                if(strlen($text) > 65){
                                    ?>
                                    <a href="<?=site_url()?>category/detail" class="category-detail">Read More</a>
                                <?php } ?>
                            </td>
                            <td class="text-center"><?=$category["thread"]?></td>
                            <td class="text-center">
                                <a href="<?=site_url()?>category/edit" class="btn-circle action category-edit"><i class="fa fa-edit"></i></a>
                                <a href="<?=site_url()?>category/delete" class="btn-circle action category-delete"><i class="fa fa-trash"></i></a>
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
</div>

<script>
    $(document).ready(function(){
        $(".category-detail").click(function(e){
            e.preventDefault();
            var row = $(this).parent().parent();
            var message = row.data("description");
            $(".modal-title").html("Category Description");
            $(".modal-message").html(message);
            $("#modal-info").modal("show");
        });

        $(".category-delete").click(function(e){
            e.preventDefault();
            var row = $(this).parent().parent();
            var id = row.data("id");
            var category = row.data("category");
            var link = "<?=site_url()?>category/delete/"+id;
            $("#jm-delete-title").html("Category");
            $("#jm-delete-message").html("Are sure want to delete category "+category+"?");
            $("#jm-form-delete").attr("action", link);
            $("#jm-delete-id").val(id);
            $("#modal-delete").modal("show");
        });

        $(".category-create").click(function(e){
            e.preventDefault();
            $("#modal-category-create").modal("show");
        });

        $(".category-edit").click(function(e){
            e.preventDefault();
            var row = $(this).parent().parent();
            var id = row.data("id");
            var category = row.data("category");
            var description = row.data("description");
            var link =  '<?=base_url()."category/update/"?>'+id;
            $("#jm-form-category-edit").attr("action", link);
            $("#jm-category-name").val(category);
            $("#jm-category-description").val(description);
            $("#modal-category-edit").modal("show");
        });
    });
</script>

<?php $this->load->view("administrator/modals/category/category_edit") ?>
<?php $this->load->view("administrator/modals/category/category_create") ?>
<?php $this->load->view("administrator/modals/info") ?>
<?php $this->load->view("administrator/modals/delete") ?>