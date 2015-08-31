<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="sidebar sidebar-search">
                    <header>
                        <h3 class="text-primary"><i class="fa fa-search mrsm"></i> Your Search Detail</h3>
                    </header>

                    <div class="row">
                        <div class="col-md-12 col-sm-6">
                            <section>
                                <h4 class="title"><i class="fa fa-building mrsm"></i>Choose a Field</h4>
                                <?php
                                if(isset($fields))
                                {
                                    $field_count = 0;
                                    foreach($fields as $field):
                                        if($field_count++ < 5)
                                        {
                                            $check_status = "";
                                            if(isset($_GET["field"])){
                                                $field_get = explode(",",$_GET["field"]);
                                                foreach($field_get as $field_label):
                                                    if($field["cfd_field"] == $field_label){
                                                        $check_status = "checked";
                                                    }
                                                endforeach;
                                            }
                                            ?>

                                            <label class="checkbox" for="jm-field-<?=$field["cfd_id"]?>">
                                                <input type="checkbox" value="<?=$field["cfd_id"]?>" id="jm-field-<?=$field["cfd_id"]?>" name="jm-field[]" data-toggle="checkbox" class="custom-checkbox filter-field" <?=$check_status?>>
                                                <span class="icons">
                                                    <span class="icon-unchecked"></span>
                                                    <span class="icon-checked"></span>
                                                </span>
                                                <span class="filter-label"><?=$field["cfd_field"]?></span>
                                            </label>

                                            <?php
                                        }
                                    endforeach;

                                    if(count($fields) == 0){
                                        echo "<p class='text-left'>No fields available</p>";
                                    }
                                    else{
                                        ?>
                                        <a href="#modal-field" data-toggle="modal">+ SEE MORE</a>
                                    <?php
                                    }
                                }
                                ?>

                            </section>
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <section>
                                <h4 class="title"><i class="fa fa-bookmark mrsm"></i>Choose a Size</h4>
                                <?php
                                if(isset($sizes))
                                {
                                    foreach($sizes as $size):
                                        $check_status = "";
                                        if(isset($_GET["size"])){
                                            $size_get = explode(",",$_GET["size"]);
                                            foreach($size_get as $size_label):
                                                if($size["csz_size"] == $size_label){
                                                    $check_status = "checked";
                                                }
                                            endforeach;
                                        }
                                    ?>

                                        <label class="checkbox" for="jm-size-<?=$size["csz_id"]?>">
                                            <input type="checkbox" value="<?=$size["csz_id"]?>" id="jm-size-<?=$size["csz_id"]?>" name="jm-size[]" data-toggle="checkbox" class="custom-checkbox filter-size" <?=$check_status?>>
                                            <span class="icons">
                                                <span class="icon-unchecked"></span>
                                                <span class="icon-checked"></span>
                                            </span>
                                            <span class="filter-label"><?=$size["csz_size"]?></span>
                                        </label>

                                    <?php
                                    endforeach;

                                    if(count($sizes) == 0){
                                        echo "<p class='text-left'>No sizes available</p>";
                                    }
                                }
                                ?>
                            </section>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-6">
                            <section>
                                <h4 class="title"><i class="fa fa-map-marker mrsm"></i>Choose a Location</h4>
                                <?php
                                if(isset($cities))
                                {
                                    $city_count = 0;
                                    foreach($cities as $city):
                                        if($city_count++ < 8)
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

                                            <label class="checkbox" for="jm-city-<?=$city["cty_id"]?>">
                                                <input type="checkbox" value="<?=$city["cty_id"]?>" id="jm-city-<?=$city["cty_id"]?>" name="jm-city[]" data-toggle="checkbox" class="custom-checkbox filter-city" <?=$check_status?>>
                                                <span class="icons">
                                                    <span class="icon-unchecked"></span>
                                                    <span class="icon-checked"></span>
                                                </span>
                                                <span class="filter-label"><?=$city["cty_city"]?></span>
                                            </label>

                                        <?php
                                        }
                                    endforeach;
                                    if(count($cities) == 0){
                                        echo "<p class='text-left'>No city available</p>";
                                    }
                                    else{
                                        ?>
                                        <a href="#modal-city" data-toggle="modal">+ SEE MORE</a>
                                    <?php
                                    }
                                }
                                ?>
                            </section>
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <section>
                                <h4 class="title"><i class="fa fa-briefcase mrsm"></i>Choose a Company</h4>
                                <?php
                                $city_list = "";
                                if(isset($_GET["company"])){
                                    $city_list = $_GET["company"];
                                }
                                ?>
                                <input name="jm-company" value="<?=$city_list?>" class="tagsinput filter-company" data-role="tagsinput" placeholder="Type company filter.." />
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <header class="text-center visible-sm visible-xs">
                    <h2 class="title-section">Company Profile List</h2>
                    <p class="description-section">Temukan perusahaan yang cocok untuk membangun karirmu.</p>
                </header>
                <div class="row companies-list">

                </div> <!-- end of row -->

                <div class="text-center pagination-wrapper"></div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        var modal = $("#modal-info");
        var title = modal.find(".modal-title");
        var message = modal.find(".modal-message");

        var base_url = "<?=site_url()."company.html"?>";
        var filter_url = "";
        var page = 0;

        $.url_param = function(name){
            var result = new RegExp('[\?&]'+name+'=([^&#]*)').exec(window.location.href);
            if(result == null){
                return null;
            }
            else{
                return result[1] || 0;
            }
        };

        function change_url(page, url) {
            if (typeof (history.pushState) != "undefined") {
                var obj = { Page: page, Url: url };
                history.pushState(obj, obj.Page, obj.Url);
            } else {
                title.text("Application Error");
                message.text("Browser does not support HTML5.");
                modal.modal("show");
            }
        }

        function update_attributes(selector, label){
            var attrs = [];
            var attrs_label = [];
            var attrs_url = "";
            $(selector).each(function(){
                attrs.push($(this).val());
                attrs_label.push($(this).parent().find(".filter-label").text());
            });

            if(attrs.length > 0){
                attrs_url = label+"="+attrs_label.join();
                if(filter_url == ""){
                    filter_url += "?"+attrs_url;
                }
                else{
                    filter_url += "&"+attrs_url;
                }
            }

            return attrs.join();
        }

        function update_company()
        {
            var company = $(".filter-company").val();
            if(company != "" && company != null){
                if(filter_url == ""){
                    filter_url += "?company="+company;
                }
                else{
                    filter_url += "&company="+company;
                }
            }
            return company;
        }

        function update_page()
        {
            if(page > 0){
                if(filter_url == ""){
                    filter_url += "?page="+page;
                }
                else{
                    filter_url += "&page="+page;
                }
            }
        }

        function update_data(link, reset){
            $(".companies-list").html("<hr><p class='center-block text-center'>Searching, please wait...</p><hr>");

            filter_url = "";
            var data_field = update_attributes(".filter-field:checked","field");
            var data_size = update_attributes(".filter-size:checked","size");
            var data_city = update_attributes(".filter-city:checked","city");
            var data_company = update_company();
            var data_link = "<?=site_url()?>company/filter";

            if(reset){
                page = 0;
                data_link = "<?=site_url()?>company/filter";
            }
            else{
                if($.url_param("page") != null && link == null){
                    page = $.url_param("page");
                    data_link+="/"+(($.url_param("page")*10)-10);
                    update_page();
                }

                if(link != null){
                    data_link = link;
                    update_page();
                }
            }

            change_url("<?=get_setting("Website Name")?> | Company", base_url+filter_url);

            $.ajax({
                type:"post",
                url:data_link,
                data:{field:data_field, size:data_size, city:data_city, company:data_company},
                success:function(data){
                    generate_list(data);
                },
                error:function(e){
                    title.text("Application Error");
                    message.text("Something is getting wrong");
                    modal.modal("show");
                }
            });
        }

        function generate_list(data){
            var json = JSON.parse(data);
            var company = json.company;
            var pagination = json.pagination;
            var content = "";

            if(pagination == ""){
                page = 0;
            }
            else{
                update_page();
            }

            if(company.length == 0){
                $(".companies-list").html("<hr><p class='center-block text-center'>No results found</p><hr>");
            }
            else{
                $.each(company, function(index, row){
                    var follow_text = "FOLLOW";
                    var follow_icon = "fa-star-o";
                    var follow_class = "btn-follow-control btn-follow";
                    var follow_link = "#";
                    var is_authorize = "<?=UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE)?>";
                    if(!is_authorize){
                        follow_class = "btn-follow";
                        follow_link = "<?=site_url()?>page/login.html";
                    }

                    if(row.is_followed == 1){
                        follow_text = "UNFOLLOW";
                        follow_icon = "fa-star";
                        follow_class = "btn-follow-control active btn-unfollow";
                    }

                    content += '' +
                    '<div class="col-md-6 col-sm-6">' +
                    '   <div class="featured-company detail">' +
                    '       <div class="featured-image">' +
                    '           <div class="image-wrapper">' +
                    '               <img src="<?=base_url()?>assets/img/office/'+row.featured+'" class="img-responsive center-block">' +
                    '           </div>' +
                    '           <div class="featured-info">' +
                    '               <div class="wrapper">' +
                    '                   <p>See Inside the Office of</p>' +
                    '                   <h1>'+row.company+'</h1>' +
                    '               </div>' +
                    '           </div>' +
                    '           <div class="featured-label">' +
                    '               <a href="<?=site_url()?>company/office/'+row.permalink+'.html" class="more">SEE OUR OFFICE</a>|<a href="<?=site_url()?>company/follower/'+row.permalink+'.html" class="follower">'+row.follower+' FOLLOWER</a>' +
                    '           </div>' +
                    '       </div>' +
                    '       <div class="featured-body">' +
                    '           <h2><a href="<?=site_url()?>company/about/'+row.permalink+'.html">'+row.company+'</a></h2>' +
                    '           <ul class="list-inline">' +
                    '               <li><i class="fa fa-hospital-o mrsm"></i>'+row.field+'</li>' +
                    '               <li><i class="fa fa-map-marker mrsm"></i>'+row.city+', '+row.country+'</li>' +
                    '               <li><i class="fa fa-group mrsm"></i>'+row.size+'</li>' +
                    '           </ul>' +
                    '           <p>'+row.description+'</p>' +
                    '       </div>' +
                    '       <div class="featured-control">' +
                    '           <a href="'+follow_link+'" class="btn btn-invert '+follow_class+'" data-company="'+row.company_id+'"><i class="fa '+follow_icon+' mrsm"></i>'+follow_text+'</a>' +
                    '           <a href="<?=site_url()?>company/job/'+row.permalink+'.html" class="btn btn-primary"><i class="fa fa-navicon mrsm"></i>JOBS</a>' +
                    '           <a href="<?=site_url()?>company/about/'+row.permalink+'.html" class="btn btn-warning"><i class="fa fa-search mrsm"></i>INFO</a>' +
                    '       </div>' +
                    '   </div>' +
                    '</div>';
                });
                $(".companies-list").html(content);
            }
            $(".pagination-wrapper").html(pagination);
        }

        $(".filter-field, .filter-size, .filter-city, .filter-company").change(function(){
            update_data(null, true);
        });

        $(document).on("click",".pagination-wrapper a", function(e){
            e.preventDefault();
            page = $(this).text();
            update_data($(this).attr("href"), false);
            return false;
        });

        update_data(null, false);
    });
</script>

<?php $this->load->view("website/modals/filter_field") ?>
<?php $this->load->view("website/modals/filter_city") ?>
<?php $this->load->view("website/modals/info"); ?>




