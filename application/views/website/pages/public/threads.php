<section class="container mblg">
    <div class="forum-summary">
        <ol class="breadcrumb">
            <li><a href="<?=base_url()?>forum.html">Forum</a></li>
            <li><a href="<?=base_url()?>forum/categories.html">All Category</a></li>
        </ol>
        <div class="title">
            <h4 class="pull-left"><i class="fa fa-file mrsm"></i>All Threads</h4>
            <div class="clearfix"></div>
        </div>
        <hr>

        <?php
        if(isset($threads)){
            if(count($threads) > 0){
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
            else{
                echo "<p class='text-left'>No threads available</p>";
            }

        }
        ?>

    </div>
    <div class="text-center">
        <?php echo $this->pagination->create_links(); ?>
    </div>
</section>