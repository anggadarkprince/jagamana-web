<div class="title-section">
    <div class="title">
        <h1>Application Statistic</h1>
        <div class="pull-right mtxs">
            <a href="<?=site_url()?>applications/statistic.html" class="btn-circle btn-o"><i class="fa fa-refresh"></i></a>
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
            <li><a href="<?=site_url()?>applications.html"><i class="fa fa-send"></i>SUBMITTED</a></li>
            <li><a href="<?=site_url()?>applications/approved.html"><i class="fa fa-check"></i>APPROVED</a></li>
            <li><a href="<?=site_url()?>applications/rejected.html"><i class="fa fa-remove"></i>REJECTED</a></li>
            <li class="active"><a href="<?=site_url()?>applications/statistic.html"><i class="fa fa-bar-chart"></i>STATISTIC</a></li>
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
                    <th>Date</th>
                    <th>Total Application</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($applications))
                {
                    foreach($applications as $application):
                        ?>

                        <tr>
                            <td class="text-center">
                                <div class="checkbox">
                                    <input type="checkbox" data-toggle="checkbox">
                                    <label class="check"></label>
                                </div>
                            </td>
                            <td><?=date_format(date_create($application["created_at"]),"d F Y")?></td>
                            <td><?=$application["application"]?></td>
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