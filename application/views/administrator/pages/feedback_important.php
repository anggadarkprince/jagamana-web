<div class="title-section">
    <div class="title">
        <h1>Important</h1>
        <div class="pull-right mtxs">
            <a href="<?=site_url()?>feedback/important.html" class="btn-circle btn-o"><i class="fa fa-refresh"></i></a>
            <a href="#" class="btn-circle  btn-o"><i class="fa fa-trash"></i></a>
        </div>
    </div>
    <p class="subtitle">We collect feedback data, so your website could improved by user experiences and know your problem. Split useful feedback on important section.</p>
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
            <li><a href="<?=site_url()?>feedback/general.html"><i class="fa fa-comments"></i>FEEDBACK</a></li>
            <li class="active"><a href="<?=site_url()?>feedback/important.html"><i class="fa fa-exclamation-circle"></i>IMPORTANT</a></li>
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
                            <input type="checkbox" data-toggle="checkbox" id="header-check" value="1">
                            <label class="check" for="header-check"></label>
                        </div>
                    </th>
                    <th width="20%">Name</th>
                    <th width="20%">Subject</th>
                    <th width="15%">Email</th>
                    <th width="15%" class="text-center">Detail</th>
                    <th width="15%" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($feedback)){
                    $count = 0;
                    foreach($feedback as $row):
                        $count++;
                    ?>

                        <tr data-id="<?=$row["fdb_id"]?>" data-message="<?=$row["fdb_message"]?>">
                            <td class="text-center">
                                <div class="checkbox">
                                    <input type="checkbox" id="record-check<?=$count?>" data-toggle="checkbox" value="2">
                                    <label class="check" for="record-check<?=$count?>"></label>
                                </div>
                            </td>
                            <td><?=$row["fdb_name"]?></td>
                            <td><?=character_limiter($row["fdb_message"], 30)?></td>
                            <td><a href="mailto:<?=$row["fdb_email"]?>"><?=$row["fdb_email"]?></a></td>
                            <td class="text-center"><a href="<?=site_url()?>feedback/detail" class="feedback-detail">View Details</a></td>
                            <td class="text-center">
                                <a href="<?=site_url()?>feedback/archive/important/<?=$row["fdb_id"]?>" class="btn-circle action feedback-archive"><i class="fa fa-archive"></i></a>
                                <a href="<?=site_url()?>feedback/delete" class="btn-circle action feedback-delete"><i class="fa fa-trash"></i></a>
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
        $(".feedback-detail").click(function(e){
            e.preventDefault();
            var row = $(this).parent().parent();
            var message = row.data("message");
            $(".modal-title").html("Feedback Message");
            $(".modal-message").html(message);
            $("#modal-info").modal("show");
        });

        $(".feedback-delete").click(function(e){
            e.preventDefault();
            var row = $(this).parent().parent();
            var id = row.data("id");
            var link = "<?=site_url()?>feedback/delete/important/"+id;
            $("#jm-delete-title").html("Feedback");
            $("#jm-delete-message").html("Are sure want to delete this feedback?");
            $("#jm-form-delete").attr("action", link);
            $("#jm-delete-id").val(id);
            $("#modal-delete").modal("show");
        });
    });
</script>

<?php $this->load->view("administrator/modals/info") ?>
<?php $this->load->view("administrator/modals/delete") ?>