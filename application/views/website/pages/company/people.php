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
                                <h3><i class="fa fa-user-md"></i> Our People</h3>
                                <p>List of people you want applicants meet</p>
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

                            <div class="mblg">
                                <table class="table table-striped table-hover table-responsive table-custom">
                                    <thead>
                                    <tr>
                                        <th width="10%" class="text-center"><i class="fa fa-circle-o"></i></th>
                                        <th width="30%" class="text-left">Name</th>
                                        <th width="25%" class="text-center">Position</th>
                                        <th width="15%" class="text-center">Details</th>
                                        <th width="20%" class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(isset($people))
                                    {
                                        foreach($people as $person):
                                        ?>

                                            <tr data-id="<?=$person["plp_id"]?>" data-name="<?=$person["plp_name"]?>">
                                                <td class="text-center"><i class="fa fa-circle-o"></i></td>
                                                <td>
                                                    <img src="<?=base_url()?>assets/img/people/<?=$person["plp_avatar"]?>" class="img-responsive avatar-table table-bordered">
                                                    <span style="line-height: 30px"><?=ucwords(strtolower($person["plp_name"]))?></span>
                                                </td>
                                                <td class="text-center"><?=$person["plp_position"]?></td>
                                                <td class="text-center"><a href="<?=site_url()?>people/profile/<?=permalink($person["plp_name"], $person["plp_id"])?>.html">DETAIL</a></td>
                                                <td class="text-center">
                                                    <ul class="control list-inline">
                                                        <li><a href="<?=site_url()?>people/create" class="people-create"><i class="fa fa-file"></i></a></li>
                                                        <li><a href="<?=site_url()?>people/profile/<?=permalink($person["plp_name"], $person["plp_id"])?>" class="people-edit"><i class="fa fa-pencil"></i></a></li>
                                                        <li><a href="<?=site_url()?>people/delete/<?=permalink($person["plp_name"], $person["plp_id"])?>" class="people-delete"><i class="fa fa-trash"></i></a></li>
                                                    </ul>
                                                </td>
                                            </tr>

                                        <?php
                                        endforeach;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <a href="<?=site_url()?>people/create" class="btn btn-dash btn-block people-create"><i class="fa fa-plus-circle"></i> ADD NEW PEOPLE</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(".people-delete").click(function(e){
        e.preventDefault();
        var row = $(this).parent().parent().parent().parent();
        var id = row.data("id");
        var title = row.data("name");
        var link = "<?=site_url()?>people/delete/"+id;
        var module = "Photo";
        var message = "Are You Sure Want To Delete <strong>'"+title+"'</strong>?";
        $("#jm-delete-id").val(id);
        $("#jm-form-delete").attr("action", link);
        $("#jm-delete-title").html(module);
        $("#jm-delete-message").html(message);
        $("#confirm-delete").modal("show");
    });
    $(".people-create").click(function(e){
        e.preventDefault();
        $("#modal-people-create").modal("show");
    });
</script>

<?php $this->load->view("website/modals/confirm_delete"); ?>
<?php $this->load->view("website/modals/people/people_create"); ?>