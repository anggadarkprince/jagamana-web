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
                            <li class="active"><a href="<?=site_url()?>profile/task.html">TASK</a></li>
                            <li><a href="<?=site_url()?>profile/opinion.html">OPINION</a></li>
                            <li><a href="<?=site_url()?>profile/achievement.html">ACHIEVEMENT</a></li>
                        </ul>
                    </div>
                    <form class="form-horizontal" role="form">
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-tasks"></i> What Do You Do</h3>
                                <p>Tell the story about business task and objective</p>
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
                                        <th width="40%" class="text-left">Activity</th>
                                        <th width="30%" class="text-center">Details</th>
                                        <th width="20%" class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(isset($tasks))
                                    {
                                        foreach($tasks as $task):
                                            ?>

                                            <tr>
                                                <td class="text-center"><i class="fa fa-circle-o"></i></td>
                                                <td class="row-title"><?=$task["cts_task"]?></td>
                                                <td class="text-center"><a href="<?=site_url()?>task/detail" class="task-detail">DETAIL</a></td>
                                                <td class="text-center">
                                                    <ul class="control list-inline" data-id="<?=$task["cts_id"]?>" data-task="<?=$task["cts_task"]?>" data-description="<?=$task["cts_description"]?>" data-featured="<?=$task["cts_featured"]?>">
                                                        <li><a href="<?=site_url()?>task/create" class="create"><i class="fa fa-file"></i></a></li>
                                                        <li><a href="<?=site_url()?>task/edit" class="edit"><i class="fa fa-pencil"></i></a></li>
                                                        <li><a href="<?=site_url()?>task/delete" class="delete"><i class="fa fa-trash"></i></a></li>
                                                    </ul>
                                                </td>
                                            </tr>

                                            <?php
                                        endforeach;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-dash btn-block" data-toggle="modal" data-target="#modal-task-create"><i class="fa fa-plus-circle"></i> ADD NEW TASK</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){

        $(".delete").click(function(e){
            e.preventDefault();
            var id = $(this).parent().parent().data("id");
            var link = $(this).attr("href")+"/"+id;
            var title = "Task";
            var message = "Are You Sure Want To Delete <strong>'"+$(this).parent().parent().parent().parent().find(".row-title").text()+"'</strong>?";
            $("#jm-form-delete").attr("action", link);
            $("#jm-delete-title").html(title);
            $("#jm-delete-message").html(message);
            $("#confirm-delete").modal("show");
        });

        $(".create").click(function(e) {
            e.preventDefault();
            $("#modal-task-create").modal("show");
        });

        $(".task-detail").click(function(e) {
            e.preventDefault();

            var row = $(this).parent().parent().find("ul");
            var task = row.data("task");
            var description = row.data("description");
            var featured = row.data("featured");

            var image = $(".task-detail-featured");
            if(featured == null || featured == ""){
                image.hide();
            }
            else{
                image.show();
            }
            image.attr("src", '<?=base_url()."assets/img/office/"?>'+featured);
            $(".task-detail-title").html(task);
            $(".task-detail-description").html(description);

            $("#modal-task-detail").modal("show");
        });

        $(".edit").click(function(e){
            e.preventDefault();
            var row = $(this).parent().parent();
            var id = row.data("id");
            var task = row.data("task");
            var description = row.data("description");
            var featured = row.data("featured");
            var link =  '<?=base_url()."task/update/"?>'+id;

            var image = $("#jm-task-image");
            if(featured == null || featured == ""){
                image.hide();
            }
            else{
                image.show();
            }
            $("#jm-form-task-edit").attr("action", link);
            $(".task-title").val(task);
            $(".task-description, #jm-form-task-edit .note-editable").html(description);
            image.attr("src", '<?=base_url()."assets/img/office/"?>'+featured);

            $("#modal-task-edit").modal("show");
        });
    });
</script>

<?php $this->load->view("website/modals/confirm_delete"); ?>
<?php $this->load->view("website/modals/task/task_create"); ?>
<?php $this->load->view("website/modals/task/task_edit"); ?>
<?php $this->load->view("website/modals/task/task_detail"); ?>