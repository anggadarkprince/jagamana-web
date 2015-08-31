<div class="title-section">
    <div class="title">
        <h1>Registered Companies</h1>
        <div class="pull-right mtxs">
            <a href="<?=site_url()?>companies.html" class="btn-circle btn-o"><i class="fa fa-refresh"></i></a>
            <a href="#modal-delete-all" data-toggle="modal" class="btn-circle  btn-o"><i class="fa fa-trash"></i></a>
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
            <li class="active"><a href="<?=site_url()?>companies"><i class="fa fa-building"></i>COMPANY</a></li>
            <li><a href="<?=site_url()?>companies/suspended"><i class="fa fa-remove"></i>SUSPENDED</a></li>
            <li><a href="<?=site_url()?>companies/field"><i class="fa fa-hospital-o"></i>FIELD</a></li>
            <li><a href="<?=site_url()?>companies/size"><i class="fa fa-users"></i>SIZE</a></li>
        </ul>
    </div>
</div>
<div class="content-section container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <form action="<?=site_url()?>companies/delete_all" method="post" id="table-companies">
                <table class="table table-responsive table-striped table-hover" id="datatable">
                    <thead>
                    <tr>
                        <th class="text-center column-check">
                            <div class="checkbox">
                                <input type="checkbox" data-toggle="checkbox">
                                <label class="check"></label>
                            </div>
                        </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="text-center">Detail</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($companies))
                    {
                        foreach($companies as $company):
                            ?>

                            <tr data-id="<?=$company["cmp_id"]?>" data-name="<?=$company["cmp_name"]?>">
                                <td class="text-center">
                                    <div class="checkbox">
                                        <input type="checkbox" name="checkid[]" value="<?=$company["company_id"]?>" data-toggle="checkbox">
                                        <label class="check"></label>
                                    </div>
                                </td>
                                <td><img src="<?=base_url()?>assets/img/avatar/<?=$company["cmp_logo"]?>" class="img-responsive img-circle avatar-table"><span class="pull-left mtxs"><?=$company["cmp_name"]?></span></td>
                                <td><?=$company["cmp_email"]?></td>
                                <td class="text-center"><a href="<?=site_url()?>company/about/<?=permalink($company["cmp_name"], $company["cmp_id"])?>">View Details</a></td>
                                <td class="text-center">
                                    <a href="<?=site_url()?>companies/suspend/<?=permalink($company["cmp_name"], $company["cmp_id"])?>" class="btn btn-warning btn-sm action"><i class="fa fa-remove mrxs"></i>SUSPEND</a>
                                    <a href="<?=site_url()?>companies/delete/<?=permalink($company["cmp_name"], $company["cmp_id"])?>" class="btn btn-danger btn-sm action company-delete"><i class="fa fa-trash"></i></a>
                                </td>
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
    $(document).ready(function(){
        $(".company-delete").click(function(e){
            e.preventDefault();
            var row = $(this).parent().parent();
            var id = row.data("id");
            var name = row.data("name");
            var link = "<?=site_url()?>companies/delete/"+id;
            $("#jm-delete-title").html("Employee");
            $("#jm-delete-message").html("Are sure want to delete company "+name+"?");
            $("#jm-form-delete").attr("action", link);
            $("#jm-delete-id").val(id);
            $("#modal-delete").modal("show");
        });

        $(document).on("click","#submit-delete", function(e){
            e.preventDefault();
            $("#table-companies").submit();
        });
    });
</script>

<!-- Delete Modal -->
<div class="modal fade" id="modal-delete-all" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

<?php $this->load->view("administrator/modals/delete") ?>