<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php $this->load->view("website/elements/sidebar"); ?>
            </div>
            <div class="col-md-9">
                <div class="main-content">
                    <form action="<?=site_url()?>thread/save" method="post" class="form-horizontal" role="form" id="jm-form-thread">
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-comments"></i> Thread Form</h3>
                                <p>Your thread post in forum</p>
                            </div>
                            <!-- alert -->
                            <?php
                            if(isset($operation))
                            {
                                ?>
                                <div class="alert alert-<?=$operation?> alert-block alert-dismissible" role="alert">
                                    <?php echo $message; ?>
                                </div>
                            <?php
                            }
                            ?>
                            <!-- end of alert -->
                            <div class="form-group">
                                <label for="jm-thread-title" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10 col-md-6">
                                    <input type="text" class="form-control" id="jm-thread-title" name="jm-thread-title" placeholder="Your thread title" required="true" maxlength="100" value="<?=set_value('jm-thread-title', "");?>">
                                    <span class="text-muted">Eg. New Disease Founded</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-thread-category" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-10 col-md-6">
                                    <select class="form-control select select-primary mbl required" title="This field is required." id="jm-thread-category" name="jm-thread-category" required>
                                        <option value="" <?php echo set_select('jm-thread-category', '', TRUE); ?>>Select Category</option>
                                        <?php
                                            if(isset($categories))
                                            {
                                                foreach($categories as $category):
                                                    ?>

                                                    <option value="<?=$category["category_id"]?>" <?php echo set_select('jm-thread-category', $category["category_id"]); ?>><?=$category["category"]?></option>

                                                    <?php
                                                endforeach;
                                            }
                                        ?>
                                    </select>
                                    <span class="text-muted">Select related category for this thread</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-status-published" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10 col-md-6">
                                    <div class="mtxs">
                                        <div class="radio-inline">
                                            <label class="radio" for="jm-status-published">
                                                <input type="radio" value="PUBLISHED" id="jm-status-published" name="jm-thread-status" data-toggle="radio" class="custom-radio required" <?php echo set_radio('jm-thread-status', 'PUBLISHED', TRUE); ?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                PUBLISHED
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label class="radio" for="jm-status-draft">
                                                <input type="radio" value="DRAFT" id="jm-status-draft" name="jm-thread-status" data-toggle="radio" class="custom-radio" <?php echo set_radio('jm-thread-status', 'DRAFT'); ?>>
                                                    <span class="icons">
                                                        <span class="icon-unchecked"></span>
                                                        <span class="icon-checked"></span>
                                                    </span>
                                                DRAFT
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-thread-content" class="col-sm-2 control-label">Content</label>
                                <div class="col-sm-10">
                                    <textarea id="jm-thread-content" name="jm-thread-content" class="form-control wysiwyg height" placeholder="Put your article, news and content" required><?=set_value('jm-thread-content', "");?></textarea>
                                    <span class="text-muted">Thread content article</span>
                                </div>
                            </div>
                            <div class="form-group mtlg ptmd">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="reset" class="btn btn-default">RESET</button>
                                    <button type="submit" class="btn btn-primary">SAVE THREAD</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>