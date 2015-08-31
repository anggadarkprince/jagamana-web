<section class="section">
    <div class="container">
        <div class="main-content">
            <section class="about-section people">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="image-wrapper people-avatar center-block">
                            <img src="<?=base_url()?>assets/img/avatar/<?=$employee["emp_avatar"]?>" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-9">
                        <h1 class="name"><?=$employee["emp_name"]?></h1>
                        <p class="lead">Hello There,</p>
                        <p><?=$employee["emp_about"]?></p>
                    </div>
                </div>
            </section>

            <div class="tab-navigation">
                <ul class="list-inline">
                    <li><a href="<?=site_url()?>account/detail/<?=permalink($employee["emp_name"], $employee["emp_id"])?>.html">RESUME</a></li>
                    <li><a href="<?=site_url()?>account/following/<?=permalink($employee["emp_name"], $employee["emp_id"])?>.html">FOLLOWING</a></li>
                    <li class="active"><a href="<?=site_url()?>account/thread/<?=permalink($employee["emp_name"], $employee["emp_id"])?>.html">THREAD</a></li>
                </ul>
            </div>

            <div class="mtlg">
                <table class="table table-striped table-hover table-responsive table-custom">
                    <tbody>
                    <?php
                    if(isset($threads))
                    {
                        foreach($threads as $thread):
                        ?>

                            <tr>
                                <td class="text-center"><i class="fa fa-circle-o"></i></td>
                                <td><a href="<?=site_url()?>forum/thread/<?=permalink($thread["title"], $thread["thread_id"])?>.html"><?=$thread["title"]?></a></td>
                                <td class="text-center"><?=$thread["category"]?></td>
                                <td class="text-center"><?=date_format(date_create($thread["created_at"]),"d F, Y h:m A")?></td>
                                <td class="text-center"><?=$thread["comment"]?></td>
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
</section>