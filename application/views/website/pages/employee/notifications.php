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
                            <h3><i class="fa fa-comments"></i> Notification</h3>
                            <p>Your update account status</p>
                        </div>

                        <div class="mblg">
                            <table class="table table-striped table-hover table-responsive table-custom">
                                <thead>
                                </thead>
                                <tbody>
                                <?php
                                    if(isset($notifications))
                                    {
                                        if(count($notifications) == 0){
                                            echo "<tr><td colspan='3' class='text-center'>No notifications available</td><tr>";
                                        }
                                        foreach($notifications as $notification):
                                            ?>

                                            <tr>
                                                <td class="text-center"><i class="fa fa-circle-o"></i></td>
                                                <td><?=date_format(date_create($notification["eac_created_at"]),"d F, Y")?></td>
                                                <td><?=$notification["eac_message"]?></td>
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
            </div>
        </div>
    </div>
</section>

