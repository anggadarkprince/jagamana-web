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
                                <h3><i class="fa fa-reply-all"></i> Follower (234)</h3>
                                <p>People who follow your company</p>
                            </div>

                            <div class="mblg">
                                <div class="row">
                                    <?php
                                    if(isset($followers))
                                    {
                                        if(count($followers) == 0){
                                            echo "<hr><p class='text-center'>No employees are following</p><hr>";
                                        }
                                        foreach($followers as $follower):
                                        ?>

                                            <div class="col-md-6">
                                                <div class="follower-box">
                                                    <div class="row">
                                                        <div class="col-md-5 col-lg-4">
                                                            <div class="image-wrapper">
                                                                <img src="<?=base_url()?>assets/img/avatar/<?=$follower["avatar"]?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7 col-lg-8">
                                                            <div class="detail">
                                                                <p class="name"><?=$follower["employee"]?></p>
                                                                <p class="email hidden-md"><?=$follower["email"]?></p>
                                                                <button type="button" class="btn btn-sm btn-primary ptxs pbxs mtsm btn-following-control" data-employee="<?=$follower["employee_id"]?>">REMOVE FOLLOWER</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                        endforeach;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $this->load->view("website/modals/info"); ?>