<div class="container">
    <div class="forum-summary">
        <ol class="breadcrumb">
            <li><a href="<?=site_url()?>forum">Forum</a></li>
            <li><a href="<?=site_url()?>forum/categories">All Category</a></li>
            <li><a href="<?=site_url()?>forum/category/<?=permalink($thread["category"],$thread["category_id"], false, true)?>.html"><?=$thread["category"]?></a></li>
            <li class="active"><?=$thread["title"]?></li>
        </ol>
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
        <div class="thread">
            <h1 class="title"><a href="<?=site_url()?>forum/thread/<?=$thread["permalink"]?>.html"><?=$thread["title"]?></a></h1>
            <div class="info">
                <ul class="list-inline text-muted">
                    <li><i class="fa fa-user mrsm"></i>Author : <?=$thread["author"]?></li>
                    <li><i class="fa fa-clock-o mrsm"></i><?=date_format(date_create($thread["created_at"]),"h:m A d F, Y")?></li>
                    <li><i class="fa fa-comment mrsm"></i><?=$thread["comment"]?></li>
                </ul>
            </div>
            <p>
                <?=$thread["content"]?>
            </p>

            <div class="mtmd">
                <p>Share to:</p>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?=htmlentities(urlencode(site_url()."forum/thread/".$thread["permalink"].".html"))?>" target="_blank" class="mrxs"><img src="<?=base_url()?>assets/img/layout/social-facebook.png"></a>
                <a href="https://www.twitter.com/home?status=<?=htmlentities(urlencode($thread["title"]." - Check this article at ".site_url()."forum/thread/".$thread["permalink"].".html via ".get_setting("Twitter")))?>" target="_blank" class="mrxs"><img src="<?=base_url()?>assets/img/layout/social-twitter.png"></a>
                <a href="https://plus.google.com/share?url=<?=htmlentities(urlencode(site_url()."forum/thread/".$thread["permalink"].".html"))?>" target="_blank"><img src="<?=base_url()?>assets/img/layout/social-google.png"></a>
            </div>
        </div>

        <div class="comment">
            <h4>Leave a Comment</h4>
            <form action="<?=site_url()?>comment/submit" role="form" method="post" class="form-horizontal mblg" id="jm-form-comment">
                <input type="hidden" name="jm-comment-thread" value="<?=$thread["thread_id"]?>">
                <input type="hidden" name="jm-comment-permalink" value="<?=$this->uri->segment(3)?>">
                <div class="form-group">
                    <label class="col-sm-2 col-md-2 control-label" for="jm-comment-name">Name</label>
                    <div class="col-sm-10 col-md-8">
                        <input type="text" class="form-control" id="jm-comment-name" name="jm-comment-name" placeholder="Enter your name" required maxlength="45" value="<?php echo set_value('jm-comment-name', '');?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-md-2 control-label" for="jm-comment-email">Email Address</label>
                    <div class="col-sm-10 col-md-8">
                        <input type="email" class="form-control" id="jm-comment-email" name="jm-comment-email" placeholder="Enter your email" required maxlength="45" value="<?php echo set_value('jm-comment-email', '');?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-md-2 control-label" for="jm-comment-content">Message</label>
                    <div class="col-sm-10 col-md-8">
                        <textarea class="form-control" id="jm-comment-content" name="jm-comment-content" rows="5" placeholder="Put comment here" required><?php echo set_value('jm-comment-content', '');?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-push-2 col-sm-10 col-md-8">
                        <button type="reset" class="btn btn-default">RESET</button>
                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                    </div>
                </div>
            </form>
            <h4 class="mtlg">Comments:</h4>
            <?php
            if(isset($comments)){
                if(count($comments) > 0){
                    foreach($comments as $comment):
                        ?>

                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object mrmd" src="<?=base_url()?>assets/img/avatar/<?=$comment["employee_avatar"]?>" style="width: 64px; height: 64px;">
                            </a>

                            <div class="media-body">
                                <h6 class="media-heading"><?=$comment["name"]?></h6>
                                <?=$comment["comment"]?><br>
                            <span class="text-muted">
                                <i class="fa fa-clock-o mrsm"></i><?=$comment["created_at"]?><span class="mrxs mlsm">|</span>
                                <time class="timeago" datetime="<?=$comment["created_at"]?>"><?=$comment["created_at"]?></time>
                            </span>
                            </div>
                        </div>

                    <?php
                    endforeach;
                }
                else{
                    echo "No Comment Available";
                }
            }
            ?>

        </div>
    </div>
</div>