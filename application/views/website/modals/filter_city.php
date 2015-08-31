<!-- Info Modal -->
<div class="modal fade" id="modal-city" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Filter Field</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php
                    if(isset($cities))
                    {
                        $city_count = 0;
                        foreach($cities as $city):
                            if($city_count++ >= 8)
                            {
                                $check_status = "";
                                if(isset($_GET["city"])){
                                    $city_get = explode(",",$_GET["city"]);
                                    foreach($city_get as $city_label):
                                        if($city["cty_city"] == $city_label){
                                            $check_status = "checked";
                                        }
                                    endforeach;
                                }
                            ?>

                            <div class="col-md-4">
                                <label class="checkbox" for="jm-city-<?=$city["cty_id"]?>">
                                    <input type="checkbox" value="<?=$city["cty_id"]?>" id="jm-city-<?=$city["cty_id"]?>" name="jm-city[]" data-toggle="checkbox" class="custom-checkbox filter-city" <?=$check_status?>>
                                            <span class="icons">
                                                <span class="icon-unchecked"></span>
                                                <span class="icon-checked"></span>
                                            </span>
                                    <span class="filter-label"><?=$city["cty_city"]?></span>
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
                <button type="button" class="btn btn-primary" data-dismiss="modal">Search By Location</button>
            </div>
        </div>
    </div>
</div>