<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php $this->load->view("website/elements/sidebar"); ?>
            </div>
            <div class="col-md-9">
                <div class="main-content">
                    <div class="form-section">
                        <div class="title">
                            <h3><i class="fa fa-building"></i> Following</h3>
                            <p>Company list you're following</p>
                        </div>
                        <?php
                            if(isset($following))
                            {
                                if(count($following) == 0){
                                    echo "<hr><p class='text-center'>No companies followed</p><hr>";
                                }
                                foreach($following as $follow):
                                    $permalink = permalink($follow["company"],$follow["company_id"]);
                                    ?>

                                    <div class="featured-company detail">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="featured-image">
                                                    <div class="image-wrapper">
                                                        <img src="<?=base_url()?>assets/img/office/<?=$follow["featured"]?>" class="img-responsive center-block">
                                                    </div>
                                                    <div class="featured-info">
                                                        <div class="wrapper">
                                                            <p>See Inside the Office of</p>
                                                            <h1><?=strtoupper($follow["company"])?></h1>
                                                        </div>
                                                    </div>
                                                    <div class="featured-label">
                                                        <a href="<?=site_url()?>company/office/<?=$permalink?>.html" class="more">SEE OUR OFFICE</a>|<a href="<?=site_url()?>company/follower/<?=$permalink?>.html" class="follower"><?=$follow["follower"]?> FOLLOWER</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="featured-body">
                                                    <h2 class="mtn mbxs"><a href="<?=site_url()?>company/about/<?=$permalink?>.html"><?=$follow["company"]?></a></h2>
                                                    <ul class="list-inline mbxs">
                                                        <li><i class="fa fa-hospital-o mrsm"></i><?=$follow["field"]?></li>
                                                        <li><i class="fa fa-map-marker mrsm"></i><?=$follow["city"].", ".$follow["country"]?></li>
                                                        <li><i class="fa fa-group mrsm"></i><?=$follow["size"]?></li>
                                                    </ul>
                                                    <p class="mbxs"><?=character_limiter($follow["description"],180)?></p>
                                                </div>
                                                <div class="featured-control">
                                                    <a href="#" class="btn btn-invert active btn-follow-control btn-unfollow" data-company="<?=$follow["company_id"]?>"><i class="fa fa-star mrsm"></i>UNFOLLOW</a>
                                                    <a href="<?=site_url()?>company/jobs/<?=$permalink?>.html" class="btn btn-primary"><i class="fa fa-navicon mrsm"></i>JOBS</a>
                                                    <a href="<?=site_url()?>company/detail/<?=$permalink?>.html" class="btn btn-warning"><i class="fa fa-search mrsm"></i>INFO</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end of featured company -->

                                    <?php
                                endforeach;
                            }
                        ?>

                        <a href="<?=base_url()?>company" class="btn btn-dash btn-block"><i class="fa fa-plus-circle"></i> MORE COMPANIES</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        var modal = $("#modal-info");
        var title = modal.find(".modal-title");
        var message = modal.find(".modal-message");

        $(".btn-follow-control").click(function(e){
            e.preventDefault();
            var company_id = $(this).data("company");
            var button = $(this);

            if($(this).hasClass("btn-unfollow"))
            {
                $.ajax({
                    type:"POST",
                    url:"<?=site_url()?>follower/unfollow",
                    data:{company_id:company_id},
                    success:function(data){
                        if(data == "success"){
                            button.removeClass("active");
                            button.removeClass("btn-unfollow");
                            button.addClass("btn-follow");
                            button.html("<i class='fa fa-star-o mrsm'></i>FOLLOW");
                        }
                        if(data == "failed"){
                            title.text("Unfollow Failed");
                            message.text("We apologize, please try again");
                            modal.modal("show");
                        }
                        if(data == "restrict"){
                            title.text("Unfollow Restrict");
                            message.text("You have not authorization to do this action");
                            modal.modal("show");
                        }
                    },
                    error:function(e){
                        title.text("Application Error");
                        message.text("Something is getting wrong");
                        modal.modal("show");
                    }
                });
            }
            else{
                $.ajax({
                    type:"POST",
                    url:"<?=site_url()?>follower/follow",
                    data:{company_id:company_id},
                    success:function(data){
                        if(data == "success"){
                            button.addClass("active");
                            button.addClass("btn-unfollow");
                            button.removeClass("btn-follow");
                            button.html("<i class='fa fa-star mrsm'></i>UNFOLLOW");
                        }
                        if(data == "failed"){
                            title.text("Following Failed");
                            message.text("We apologize, please try again");
                            modal.modal("show");
                        }
                        if(data == "restrict"){
                            title.text("Following Restrict");
                            message.text("You have not authorization to do this action");
                            modal.modal("show");
                        }
                    },
                    error:function(e){
                        title.text("Application Error");
                        message.text("Something is getting wrong");
                        modal.modal("show");
                    }
                });

            }

        });

    });
</script>

<?php $this->load->view("website/modals/info"); ?>