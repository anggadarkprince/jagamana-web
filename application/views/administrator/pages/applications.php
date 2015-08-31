<div class="title-section">
    <div class="title">
        <h1>Jobs Application</h1>
        <div class="pull-right mtxs">
            <a href="<?=site_url()?>applications.html" class="btn-circle btn-o"><i class="fa fa-refresh"></i></a>
        </div>
    </div>
    <p class="subtitle">Show all application had sent, you can manage like create new, see profile in details, edit or remove them. Do all action with carefully because will affect the users data.</p>
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
            <li class="active"><a href="<?=site_url()?>applications.html"><i class="fa fa-send"></i>SUBMITTED</a></li>
            <li><a href="<?=site_url()?>applications/approved.html"><i class="fa fa-check"></i>APPROVED</a></li>
            <li><a href="<?=site_url()?>applications/rejected.html"><i class="fa fa-remove"></i>REJECTED</a></li>
            <li><a href="<?=site_url()?>applications/statistic.html"><i class="fa fa-bar-chart"></i>STATISTIC</a></li>
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
                            <input type="checkbox" data-toggle="checkbox" value="1" id="check1">
                            <label class="check" for="check1"></label>
                        </div>
                    </th>
                    <th>Employee</th>
                    <th>Job</th>
                    <th>Company</th>
                    <th class="text-center">CV</th>
                    <th class="text-center">Resume</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($applications))
                {
                    foreach($applications as $application):
                    ?>

                        <tr data-id="<?=$application["application_id"]?>">
                            <td class="text-center">
                                <div class="checkbox">
                                    <input type="checkbox" data-toggle="checkbox">
                                    <label class="check"></label>
                                </div>
                            </td>
                            <td>
                                <a href="<?=site_url()?>account/<?=permalink($application["employee"],$application["employee_id"])?>.html" target="_blank">
                                    <img src="<?=base_url()?>assets/img/avatar/<?=$application["employee_avatar"]?>" class="img-responsive img-circle avatar-table">
                                    <span class="pull-left mtxs"><?=$application["employee"]?></span>
                                </a>
                            </td>
                            <td><a href="<?=site_url()?>job/detail/<?=permalink($application["vacancy"],$application["job_id"])?>.html" target="_blank"><?=$application["vacancy"]?></a></td>
                            <td><?=$application["company"]?></td>
                            <td class="text-center">
                                <?php
                                $file = "No File";
                                if($application["employee_resume"] != null){
                                    $file = "<a href='".base_url()."assets/data/".$application["employee_resume"]."'><i class='fa fa-file-o'></i> CV</a>";
                                }
                                ?>
                                <?=$file?>
                            </td>
                            <td class="text-center">
                                <a href="<?=site_url()?>applications/resume/<?=$application["employee_id"]?>.html"><i class="fa fa-file-pdf-o"></i> RESUME</a>
                            </td>
                            <td class="text-center">
                                <a href="<?=site_url()?>applications/confirm/<?=$application["application_id"]?>" class="btn btn-info btn-sm action"><i class="fa fa-check mrxs"></i>ACCEPT</a>
                                <a href="<?=site_url()?>applications/reject/<?=$application["application_id"]?>" class="btn btn-danger btn-sm action"><i class="fa fa-remove mrxs"></i>REJECT</a>
                                <a href="<?=site_url()?>applications/delete/<?=$application["application_id"]?>" class="btn btn-danger btn-sm action application-delete"><i class="fa fa-trash"></i></a>
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
        $(".application-delete").click(function(e){
            e.preventDefault();
            var row = $(this).parent().parent();
            var id = row.data("id");
            var link = "<?=site_url()?>applications/delete/"+id;
            $("#jm-delete-title").html("Application");
            $("#jm-delete-message").html("Are sure want to delete this application?");
            $("#jm-form-delete").attr("action", link);
            $("#jm-delete-id").val(id);
            $("#modal-delete").modal("show");
        });
    });
</script>
<?php $this->load->view("administrator/modals/delete") ?>