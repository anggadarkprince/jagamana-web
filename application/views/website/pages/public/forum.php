<!-- BANNER -->
<section class="forum-section hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-7 col-sm-7">
                <div class="featured-forum">
                    <img src="<?=site_url()?>assets/img/layout/featured-block-doctors.png" class="img-responsive">
                    <div class="label">
                        <h3>Medical Forum Guidance</h3>
                        <p>Discover new knowledge and research</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-5 col-sm-5">
                <div class="title">
                    <h3>Join The Most Comprehensive</h3>
                    <p>Health Discussion Forums</p>
                </div>
                <img src="<?=site_url()?>assets/img/layout/featured-illustration-forum.png" class="img-responsive illustration">
            </div>
        </div>
    </div> <!-- end of container -->
</section>

<section class="container">
    <div class="row forum-summary">
        <div class="col-md-6 last-thread">
            <div class="title">
                <h4 class="pull-left"><i class="fa fa-file-text-o mrsm"></i>Last Thread</h4>
                <a href="<?=site_url()?>forum/threads.html" class="pull-right">Browse All</a>
                <div class="clearfix"></div>
            </div>
            <div class="content">
                <ul class="list-unstyled">
                    <?php
                    if(isset($threads))
                    {
                        if(count($threads) == 0){
                            echo "<p class='text-left'>No threads available</p>";
                        }
                        foreach($threads as $thread):
                            $permalink = $thread["permalink"];
                            ?>

                            <li>
                                <a href="<?=site_url()?>forum/thread/<?=$permalink?>.html"><i class="fa fa-check-square-o"></i><?=character_limiter($thread["title"],40)?></a>
                                <time class="pull-right timeago" datetime="<?=$thread["created_at"]?>"><?=$thread["created_at"]?></time>
                            </li>

                        <?php
                        endforeach;
                    }
                    ?>
                </ul>
            </div>
        </div>  <!-- end of last thread -->
        <div class="col-md-6 categories">
            <div class="title">
                <h4 class="pull-left"><i class="fa fa-list mrsm"></i>Categories</h4>
                <a href="<?=site_url()?>forum/categories.html" class="pull-right">All Category</a>
                <div class="clearfix"></div>
            </div>
            <?php
            $counter = 0;
            $category_left = "";
            $category_right = "";
            if(isset($categories))
            {
                if(count($categories) == 0){
                    echo "<p class='text-left'>No categories available</p>";
                }
                foreach($categories as $category):
                    $permalink = site_url().'forum/category/'.$category["permalink"].'.html';
                    $category_text = '<li><a href="'.$permalink.'">'.$category["category"].'<span class="counter">['.$category["thread"].']</span></a></li>';
                    if($counter++ < 13){
                        $category_left.=$category_text;
                    }
                    else{
                        $category_right.=$category_text;
                    }
                endforeach;
            }
            ?>
            <div class="row content">
                <div class="col-sm-6">
                    <ul class="list-unstyled">
                        <?=$category_left?>
                    </ul>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <ul class="list-unstyled">
                        <?=$category_right?>
                    </ul>
                </div>
            </div>
        </div> <!-- end of category -->
    </div>
</section>

<section>
    <img src="<?=site_url()?>assets/img/layout/section-header-bg.png" class="img-responsive">
</section>

<!-- THREADS -->
<section class="section overlay">
    <div class="container">
        <div class="forum-summary">
            <div class="last-thread">
                <div class="title">
                    <h4 class="pull-left"><i class="fa fa-file-text mrsm"></i>Latest Thread</h4>
                    <a href="<?=site_url()?>forum/threads.html" class="pull-right">Browse All</a>
                    <div class="clearfix"></div>
                </div>
            </div>

            <?php
            if(isset($threads))
            {
                if(count($threads) == 0){
                    echo "<p class='text-left'>No threads available</p>";
                }
                foreach($threads as $thread):
                    $permalink = site_url().'forum/thread/'.$thread["permalink"].'.html';
                    ?>

                    <div class="thread">
                        <h1 class="title"><a href="<?=$permalink?>"><?=$thread["title"]?></a></h1>
                        <div class="info">
                            <ul class="list-inline text-muted">
                                <li><i class="fa fa-user mrsm"></i>Author : <?=$thread["author"]?></li>
                                <li><i class="fa fa-clock-o mrsm"></i><?=date_format(date_create($thread["created_at"]),"h:m A d F, Y")?></li>
                                <li><i class="fa fa-comment mrsm"></i><?=$thread["comment"]?></li>
                            </ul>
                        </div>
                        <p>
                            <?=character_limiter(strip_tags($thread["content"]),450)?>
                        </p>
                        <p class="readmore"><a href="<?=$permalink?>" class="text-primary">Read More</a></p>
                    </div>

                <?php
                endforeach;
            }
            ?>
        </div>
        <div class="text-center">
            <a href="<?=site_url()?>forum/threads.html" class="btn btn-lg btn-invert"><i class="fa fa-file mrsm"></i>BROWSE ALL THREADS</a>
        </div>
    </div>
</section>