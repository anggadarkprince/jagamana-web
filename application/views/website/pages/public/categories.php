<section class="container">
    <div class="row forum-summary">
        <ol class="breadcrumb">
            <li><a href="<?=base_url()?>forum.html">Forum</a></li>
            <li class="active">All Category</li>
        </ol>
        <div class="title">
            <h4 class="pull-left"><i class="fa fa-list mrsm"></i>All Categories</h4>
            <div class="clearfix"></div>
        </div>
        <hr>
        <?php
        $counter = 0;
        $total = 0;
        $limit = 0;
        $category_left = "";
        $category_right = "";
        if(isset($categories)){
            if(count($categories) == 0){
                echo "<p class='text-left'>No categories available</p>";
            }
            $total = count($categories);
            $limit = ceil($total / 2);
            foreach($categories as $category):
                $permalink = base_url().'forum/category/'.$category["permalink"].'.html';
                $category_text = '<li><a href="'.$permalink.'">'.$category["category"].'<span class="counter">['.$category["thread"].']</span></a></li>';
                if($counter++ < $limit){
                    $category_left .= $category_text;
                }
                else{
                    $category_right .= $category_text;
                }
            endforeach;
        }
        ?>
        <div class="col-md-12 categories last-thread plsm prsm">
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