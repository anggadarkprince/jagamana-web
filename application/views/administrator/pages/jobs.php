<div class="title-section">
    <div class="title">
        <h1>Jobs List</h1>
        <div class="pull-right mtxs">
            <a href="<?=site_url()?>jobs" class="btn-circle btn-o"><i class="fa fa-refresh"></i></a>
            <a href="#modal-delete" data-toggle="modal" class="btn-circle btn-o"><i class="fa fa-trash"></i></a>
        </div>
    </div>
    <p class="subtitle">Show all companies had registered, you can manage like create new, see profile in details, edit or remove them. Do all action with carefully because will affect the users data.</p>
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
            <li class="active"><a href="<?=site_url()?>jobs"><i class="fa fa-briefcase"></i>JOB</a></li>
            <li><a href="<?=site_url()?>jobs/field"><i class="fa fa-pencil"></i>FIELD</a></li>
            <li><a href="<?=site_url()?>jobs/level"><i class="fa fa-tasks"></i>LEVEL</a></li>
        </ul>
    </div>
</div>
<div class="content-section container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <form action="<?=site_url()?>threads/delete_all" method="post" id="table-jobs">
                <table class="table table-responsive table-striped table-hover" id="datatable">
                    <thead>
                    <tr>
                        <th class="text-center column-check">
                            <div class="checkbox">
                                <input type="checkbox" data-toggle="checkbox">
                                <label class="check"></label>
                            </div>
                        </th>
                        <th>Job</th>
                        <th>Type</th>
                        <th>Field</th>
                        <th>Level</th>
                        <th>Location</th>
                        <th>Company</th>
                        <th class="text-center">Applicant</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($jobs))
                    {
                        foreach($jobs as $job):
                            ?>

                            <tr>
                                <td class="text-center">
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="checkbox" name="checkid[]" value="<?=$job["job_id"]?>">
                                        <label class="check"></label>
                                    </div>
                                </td>
                                <td><a href="<?=site_url()?>job/detail/<?=permalink($job["vacancy"],$job["job_id"])?>.html" target="_blank"><?=$job["vacancy"]?></a></td>
                                <td><?=$job["type"]?></td>
                                <td><?=$job["field"]?></td>
                                <td><?=$job["level"]?></td>
                                <td><?=$job["city"]?>, <?=$job["country"]?></td>
                                <td><a href="<?=site_url()?>company/about/<?=permalink($job["company"],$job["company_id"])?>.html" target="_blank"><?=$job["company"]?></a></td>
                                <td class="text-center"><?=$job["applicant"]?></td>
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
        $("#table-jobs").submit();
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