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
                                <h4 class="title"><i class="fa fa-check mrsm"></i>Choose a Level</h4>
                                <?php
                                if(isset($levels))
                                {
                                    foreach($levels as $level):
                                        $check_status = "";
                                        if(isset($_GET["size"])){
                                            $size_get = explode(",",$_GET["size"]);
                                            foreach($size_get as $size_label):
                                                if($level["jlv_level"] == $size_label){
                                                    $check_status = "checked";
                                                }
                                            endforeach;
                                        }
                                        ?>

                                        <label class="checkbox" for="jm-size-<?=$level["jlv_id"]?>">
                                            <input type="checkbox" value="<?=$level["jlv_id"]?>" id="jm-size-<?=$level["jlv_id"]?>" name="jm-level[]" data-toggle="checkbox" class="custom-checkbox filter-level" <?=$check_status?>>
                                            <span class="icons">
                                                <span class="icon-unchecked"></span>
                                                <span class="icon-checked"></span>
                                            </span>
                                            <span class="filter-label"><?=$level["jlv_level"]?></span>
                                        </label>

                                    <?php
                                    endforeach;
                                    if(count($levels) == 0){
                                        echo "<p class='text-left'>No levels available</p>";
                                    }
                                }
                                ?>
                            </section>
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <section>
                                <h4 class="title"><i class="fa fa-pencil mrsm"></i>Choose a Field</h4>
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
                                                    if($field["jfd_field"] == $field_label){
                                                        $check_status = "checked";
                                                    }
                                                endforeach;
                                            }
                                            ?>

                                            <label class="checkbox" for="jm-field-<?=$field["jfd_id"]?>">
                                                <input type="checkbox" value="<?=$field["jfd_id"]?>" id="jm-field-<?=$field["jfd_id"]?>" name="jm-field[]" data-toggle="checkbox" class="custom-checkbox filter-field" <?=$check_status?>>
                                                <span class="icons">
                                                    <span class="icon-unchecked"></span>
                                                    <span class="icon-checked"></span>
                                                </span>
                                                <span class="filter-label"><?=$field["jfd_field"]?></span>
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
                    <h2 class="title-section">Jobs List</h2>
                    <p class="description-section">Temukan pekerjaan yang cocok untuk membangun karirmu.</p>
                </header>
                <div class="jobs-list">

                </div>

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

        var type = "voluntary";
        var base_url = "<?=site_url()?>"+"job/"+type+".html";
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
            $(".jobs-list").html("<hr><p class='center-block text-center'>Searching, please wait...</p><hr>");

            filter_url = "";
            var data_field = update_attributes(".filter-field:checked","field");
            var data_level = update_attributes(".filter-level:checked","size");
            var data_city = update_attributes(".filter-city:checked","city");
            var data_company = update_company();
            var data_link = "<?=site_url()?>"+"job/filter/"+type;

            if(reset){
                page = 0;
                data_link = "<?=site_url()?>"+"job/filter/"+type;
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

            change_url("<?=get_setting("Website Name")?> | Job", base_url+filter_url);

            $.ajax({
                type:"post",
                url:data_link,
                data:{field:data_field, level:data_level, city:data_city, company:data_company},
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
            var job = json.job;
            var pagination = json.pagination;
            var content = "";

            if(pagination == ""){
                page = 0;
            }
            else{
                update_page();
            }

            if(job.length == 0){
                $(".jobs-list").html("<hr><p class='center-block text-center'>No results found</p><hr>");
            }
            else{
                $.each(job, function(index, row){
                    var bookmark_text = "SAVE JOB";
                    var bookmark_icon = "fa-star-o";
                    var bookmark_class = "btn-bookmark-control btn-bookmark";
                    var bookmark_link = "#";
                    var is_authorize = "<?=UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE)?>";
                    if(!is_authorize){
                        bookmark_class = "btn-bookmark";
                        bookmark_link = "<?=site_url()?>page/login.html";
                    }

                    if(row.is_bookmarked == 1){
                        bookmark_text = "SAVED";
                        bookmark_icon = "fa-star";
                        bookmark_class = "btn-bookmark-control active btn-remove-bookmark";
                    }

                    content += '' +
                    '<div class="featured-job detail">' +
                    '   <div class="row">' +
                    '       <div class="col-md-4">' +
                    '           <div class="featured-image">' +
                    '               <div class="image-wrapper">' +
                    '                   <img src="<?=base_url()?>assets/img/office/'+row.featured+'" class="center-block"/>' +
                    '               </div>' +
                    '               <p class="company-title text-uppercase">'+row.company+'</p>' +
                    '               <small class="info">'+row.applicant+' APPLIED THIS JOB</small>' +
                    '               <label class="job-label '+row.type.toLowerCase()+'"><i class="fa fa-clock-o mrsm"></i>'+row.type+'</label>' +
                    '           </div>' +
                    '       </div>' +
                    '       <div class="col-md-8">' +
                    '           <div class="featured-body">' +
                    '               <h2><a href="<?=site_url()?>job/detail/'+row.permalink+'.html">'+row.vacancy+'</a></h2>' +
                    '               <p>'+row.description+' <a href="<?=site_url()?>job/detail/'+row.permalink+'.html">Details</a></p>' +
                    '           </div>' +
                    '           <div class="featured-control">' +
                    '               <div class="row">' +
                    '                   <div class="col-sm-12">' +
                    '                       <ul class="list-inline">' +
                    '                           <li><i class="fa fa-map-marker mrsm"></i>'+row.city+', '+row.country+'</li>' +
                    '                           <li><i class="fa fa-pencil mrsm"></i>'+row.field+'</li>' +
                    '                           <li><i class="fa fa-check mrsm"></i>'+row.level+'</li>' +
                    '                       </ul>' +
                    '                   </div>' +
                    '                   <div class="col-sm-12">' +
                    '                       <a href="'+bookmark_link+'" class="btn btn-invert '+bookmark_class+'" data-job="'+row.job_id+'"><i class="fa '+bookmark_icon+' mrsm"></i>'+bookmark_text+'</a>' +
                    '                       <a href="<?=site_url()?>job/detail/'+row.permalink+'.html" class="btn btn-danger"><i class="fa fa-search mrsm"></i>SEE JOB</a>' +
                    '                   </div>' +
                    '               </div>' +
                    '           </div>' +
                    '       </div>' +
                    '   </div>' +
                    '</div>';
                });
                $(".jobs-list").html(content);
            }
            $(".pagination-wrapper").html(pagination);
        }

        $(".filter-field, .filter-level, .filter-city, .filter-company").change(function(){
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