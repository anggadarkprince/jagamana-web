<!-- Field Modal -->
<?php
$prefix = "cfd_";
$column = "col-md-4";
if($this->uri->segment(1) == "job"){
    $prefix = "jfd_";
    $column = "col-md-6";
}
?>
<div class="modal fade" id="modal-field" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Filter Field</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php
                    if(isset($fields))
                    {
                        $field_count = 0;
                        foreach($fields as $field):
                            if($field_count++ >= 5)
                            {
                                $check_status = "";
                                if(isset($_GET["field"])){
                                    $field_get = explode(",",$_GET["field"]);
                                    foreach($field_get as $field_label):
                                        if($field[$prefix."field"] == $field_label){
                                            $check_status = "checked";
                                        }
                                    endforeach;
                                }
                            ?>

                            <div class="<?=$column?>">
                                <label class="checkbox" for="jm-field-<?=$field[$prefix."id"]?>">
                                    <input type="checkbox" value="<?=$field[$prefix."id"]?>" id="jm-field-<?=$field[$prefix."id"]?>" name="jm-field[]" data-toggle="checkbox" class="custom-checkbox filter-field" <?=$check_status?>>
                                        <span class="icons">
                                            <span class="icon-unchecked"></span>
                                            <span class="icon-checked"></span>
                                        </span>
                                    <span class="filter-label"><?=$field[$prefix."field"]?></span>
                                </label>
                            </div>

                            <?php
                            }
                        endforeach;
                    }
                    ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Search By Field</button>
            </div>
        </div>
    </div>
</div>