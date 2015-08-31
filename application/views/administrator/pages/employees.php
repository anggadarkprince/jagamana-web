<div class="title-section">
    <div class="title">
        <h1>Registered Employees</h1>
        <div class="pull-right mtxs">
            <a href="<?=site_url()?>employee.html" class="btn-circle btn-o"><i class="fa fa-refresh"></i></a>
            <a href="<?=site_url()?>employee/delete/all.html" class="btn-circle  btn-o"><i class="fa fa-trash"></i></a>
        </div>
    </div>
    <p class="subtitle">Show all employee had registered, you can manage like create new, see profile in details, edit or remove them. Do all action with carefully because will affect the users data.</p>
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
            <li class="active"><a href="<?=site_url()?>employee"><i class="fa fa-user"></i>EMPLOYEE</a></li>
            <li><a href="<?=site_url()?>employee/suspended"><i class="fa fa-remove"></i>SUSPENDED</a></li>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th class="text-center">Detail</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($employees))
                {
                    foreach($employees as $employee):
                    ?>

                        <tr data-id="<?=$employee["emp_id"]?>" data-name="<?=$employee["emp_name"]?>">
                            <td class="text-center">
                                <div class="checkbox">
                                    <input type="checkbox" data-toggle="checkbox">
                                    <label class="check"></label>
                                </div>
                            </td>
                            <td><img src="<?=base_url()?>assets/img/avatar/<?=$employee["emp_avatar"]?>" class="img-responsive img-circle avatar-table"><span class="pull-left mtxs"><?=$employee["emp_name"]?></span></td>
                            <td><?=$employee["emp_email"]?></td>
                            <td class="text-center"><a href="<?=site_url()?>account/detail/<?=permalink($employee["emp_name"], $employee["emp_id"])?>">View Details</a></td>
                            <td class="text-center">
                                <a href="<?=site_url()?>employee/suspend/<?=permalink($employee["emp_name"], $employee["emp_id"])?>" class="btn btn-warning btn-sm action"><i class="fa fa-remove mrxs"></i>SUSPEND</a>
                                <a href="<?=site_url()?>employee/delete/<?=permalink($employee["emp_name"], $employee["emp_id"])?>" class="btn btn-danger btn-sm action employee-delete"><i class="fa fa-trash"></i></a>
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
        $(".employee-delete").click(function(e){
            e.preventDefault();
            var row = $(this).parent().parent();
            var id = row.data("id");
            var name = row.data("name");
            var link = "<?=site_url()?>employee/delete/"+id;
            $("#jm-delete-title").html("Employee");
            $("#jm-delete-message").html("Are sure want to delete employee "+name+"?");
            $("#jm-form-delete").attr("action", link);
            $("#jm-delete-id").val(id);
            $("#modal-delete").modal("show");
        });
    });
</script>

<?php $this->load->view("administrator/modals/delete") ?>