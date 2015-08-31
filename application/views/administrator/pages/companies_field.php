<div class="title-section">
    <div class="title">
        <h1>Companies Field</h1>
        <div class="pull-right mtxs">
            <a href="<?=site_url()?>companies/create" class="btn-circle btn-o field-create"><i class="fa fa-file-o"></i></a>
            <a href="<?=site_url()?>companies/field.html" class="btn-circle btn-o"><i class="fa fa-refresh"></i></a>
            <a href="<?=site_url()?>field/delete/all.html" class="btn-circle  btn-o"><i class="fa fa-trash"></i></a>
        </div>
    </div>
    <p class="subtitle">This section shows the removed employee had registered, you can restore the status or delete permanently, keep in mind delete the proceed can not be undo.</p>
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
            <li><a href="<?=site_url()?>companies"><i class="fa fa-building"></i>COMPANY</a></li>
            <li><a href="<?=site_url()?>companies/suspended"><i class="fa fa-remove"></i>SUSPENDED</a></li>
            <li class="active"><a href="<?=site_url()?>companies/field"><i class="fa fa-hospital-o"></i>FIELD</a></li>
            <li><a href="<?=site_url()?>companies/size"><i class="fa fa-users"></i>SIZE</a></li>
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
                    <th>Field</th>
                    <th>Description</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($fields))
                {
                    foreach($fields as $field):
                        ?>

                        <tr data-id="<?=$field["cfd_id"]?>" data-field="<?=$field["cfd_field"]?>" data-description="<?=$field["cfd_description"]?>">
                            <td class="text-center">
                                <div class="checkbox">
                                    <input type="checkbox" data-toggle="checkbox">
                                    <label class="check"></label>
                                </div>
                            </td>
                            <td><?=$field["cfd_field"]?></span></td>
                            <td><?=$field["cfd_description"]?></td>
                            <td class="text-center">
                                <a href="<?=site_url()?>field/create" class="btn btn-success btn-sm action field-create"><i class="fa fa-file"></i></a>
                                <a href="<?=site_url()?>field/edit/<?=$field["cfd_id"]?>" class="btn btn-info btn-sm action field-edit"><i class="fa fa-edit"></i></a>
                                <a href="<?=site_url()?>field/delete/<?=$field["cfd_id"]?>" class="btn btn-danger btn-sm action field-delete"><i class="fa fa-trash"></i></a>
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
        $(".field-delete").click(function(e){
            e.preventDefault();
            var row = $(this).parent().parent();
            var id = row.data("id");
            var field = row.data("field");
            var link = "<?=site_url()?>field/delete/"+id;
            $("#jm-delete-title").html("Field");
            $("#jm-delete-message").html("Are sure want to delete field "+field+"?");
            $("#jm-form-delete").attr("action", link);
            $("#jm-delete-id").val(id);
            $("#modal-delete").modal("show");
        });

        $(".field-create").click(function(e){
            e.preventDefault();
            $("#modal-field-create").modal("show");
        });

        $(".field-edit").click(function(e){
            e.preventDefault();
            var row = $(this).parent().parent();
            var id = row.data("id");
            var field = row.data("field");
            var description = row.data("description");
            var link =  '<?=base_url()."field/update/"?>'+id;
            $("#jm-form-field-edit").attr("action", link);
            $("#jm-field-name").val(field);
            $("#jm-field-description").val(description);
            $("#modal-field-edit").modal("show");
        });
    });
</script>

<?php $this->load->view("administrator/modals/field/field_edit") ?>
<?php $this->load->view("administrator/modals/field/field_create") ?>
<?php $this->load->view("administrator/modals/delete") ?>