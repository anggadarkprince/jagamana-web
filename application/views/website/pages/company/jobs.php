<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php $this->load->view("website/elements/sidebar"); ?>
            </div>
            <div class="col-md-9">
                <div class="main-content">
                    <form class="form-horizontal" role="form">
                        <div class="form-section">
                            <div class="title">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3><i class="fa fa-briefcase"></i> Our Job</h3>
                                        <p>List of job your company have</p>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="<?=site_url()?>job/create.html" class="btn btn-primary pull-right"><i class="fa fa-briefcase"></i> CREATE JOB</a>
                                    </div>
                                </div>
                            </div>

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

                            <div class="mblg">
                                <table class="table table-striped table-hover table-responsive table-custom">
                                    <thead>
                                    <tr>
                                        <th width="8%" class="text-center"><i class="fa fa-circle-o"></i></th>
                                        <th width="25%" class="text-left">Job</th>
                                        <th width="27%" class="text-center">Field</th>
                                        <th width="20%" class="text-center">Level</th>
                                        <th width="20%" class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(isset($jobs))
                                    {
                                        foreach($jobs as $job):
                                            ?>

                                            <tr class="table-row">
                                                <td class="text-center"><i class="fa fa-circle-o"></i></td>
                                                <td><a href="<?=site_url()?>job/detail/<?=permalink($job["vacancy"],$job["job_id"])?>.html" target="_blank" class="row-title"><?=$job["vacancy"]?></a></td>
                                                <td><?=$job["field"]?></td>
                                                <td class="text-center"><a href="#"><?=$job["level"]?></a></td>
                                                <td class="text-center">
                                                    <ul class="control list-inline">
                                                        <li><a href="<?=site_url()?>job/create.html"><i class="fa fa-file"></i></a></li>
                                                        <li><a href="<?=site_url()?>job/edit/<?=permalink($job["vacancy"],$job["job_id"])?>.html"><i class="fa fa-pencil"></i></a></li>
                                                        <li><a href="<?=site_url()?>job/delete/<?=permalink($job["vacancy"],$job["job_id"])?>.html" class="delete" data-title="Job"><i class="fa fa-trash"></i></a></li>
                                                    </ul>
                                                </td>
                                            </tr>

                                            <?php
                                        endforeach;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <a href="<?=site_url()?>job/create.html" class="btn btn-dash btn-block"><i class="fa fa-plus-circle"></i> ADD NEW JOB</a>
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
        $(".table-row .delete").click(function(e){
            e.preventDefault();
            var link = $(this).attr("href");
            var title = $(this).data("title");
            var message = "Are You Sure Want To Delete <strong>'"+$(this).parent().parent().parent().parent().find(".row-title").text()+"'</strong> Job?";
            $("#jm-form-delete").attr("action", link);
            $("#jm-delete-title").html(title);
            $("#jm-delete-message").html(message);
            $("#confirm-delete").modal("show");
        });
    });
</script>

<?php $this->load->view("website/modals/confirm_delete"); ?>