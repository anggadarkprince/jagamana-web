<div class="title-section">
    <div class="title">
        <h1>Jobs Level</h1>
        <div class="pull-right mtxs">
            <a href="<?=site_url()?>level/create" class="btn-circle btn-o level-create"><i class="fa fa-file-o"></i></a>
            <a href="<?=site_url()?>jobs/level" class="btn-circle btn-o"><i class="fa fa-refresh"></i></a>
            <a href="<?=site_url()?>level/delete/all" class="btn-circle  btn-o"><i class="fa fa-trash"></i></a>
        </div>
    </div>
    <p class="subtitle">Show all companies had registered, you can manage like create new, see profile in details, edit or remove them. Do all action with carefully because will affect the users data.</p>
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
            <li><a href="<?=site_url()?>jobs"><i class="fa fa-briefcase"></i>JOB</a></li>
            <li><a href="<?=site_url()?>jobs/field"><i class="fa fa-pencil"></i>FIELD</a></li>
            <li class="active"><a href="<?=site_url()?>jobs/level"><i class="fa fa-tasks"></i>LEVEL</a></li>
        </ul>
    </div>
</div>
<div class="content-section container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-responsive table-striped table-hover" id="datatable">
                <thead>
                <tr>
                    <th class="text-center column-check">
                        <div class="checkbox">
                            <input type="checkbox" data-toggle="checkbox">
                            <label class="check"></label>
                        </div>
                    </th>
                    <th>Level</th>
                    <th>Description</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($levels))
                {
                    foreach($levels as $level):
                        ?>

                        <tr data-id="<?=$level["jlv_id"]?>" data-level="<?=$level["jlv_level"]?>" data-description="<?=$level["jlv_description"]?>">
                            <td class="text-center">
                                <div class="checkbox">
                                    <input type="checkbox" data-toggle="checkbox">
                                    <label class="check"></label>
                                </div>
                            </td>
                            <td><?=$level["jlv_level"]?></span></td>
                            <td><?=$level["jlv_description"]?></td>
                            <td class="text-center">
                                <a href="<?=site_url()?>level/create" class="btn btn-success btn-sm action level-create"><i class="fa fa-file"></i></a>
                                <a href="<?=site_url()?>level/edit/<?=$level["jlv_id"]?>" class="btn btn-info btn-sm action level-edit"><i class="fa fa-edit"></i></a>
                                <a href="<?=site_url()?>level/delete/<?=$level["jlv_id"]?>" class="btn btn-danger btn-sm action level-delete"><i class="fa fa-trash"></i></a>
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
        $(".level-delete").click(function(e){
            e.preventDefault();
            var row = $(this).parent().parent();
            var id = row.data("id");
            var level = row.data("level");
            var link = "<?=site_url()?>level/delete/"+id;
            $("#jm-delete-title").html("Level");
            $("#jm-delete-message").html("Are sure want to delete level "+level+"?");
            $("#jm-form-delete").attr("action", link);
            $("#jm-delete-id").val(id);
            $("#modal-delete").modal("show");
        });

        $(".level-create").click(function(e){
            e.preventDefault();
            $("#modal-level-create").modal("show");
        });

        $(".level-edit").click(function(e){
            e.preventDefault();
            var row = $(this).parent().parent();
            var id = row.data("id");
            var level = row.data("level");
            var description = row.data("description");
            var link =  '<?=base_url()."level/update/"?>'+id;
            $("#jm-form-level-edit").attr("action", link);
            $("#jm-level-name").val(level);
            $("#jm-level-description").val(description);
            $("#modal-level-edit").modal("show");
        });
    });
</script>

<?php $this->load->view("administrator/modals/level/level_edit") ?>
<?php $this->load->view("administrator/modals/level/level_create") ?>
<?php $this->load->view("administrator/modals/delete") ?>