$(document).ready(function() {
    // alert auto close

    $(".alert").each(function(index){
        if($(this).find("button").length){
            $(this).delay(5000).slideUp(200,function(){
                $(this).alert('close');
            });
        }
    });

    $("select").select2({dropdownCssClass: 'dropdown-inverse'});

    // Switches
    $('[data-toggle="switch"]').bootstrapSwitch();

    // location prefer
    $("#jm-location-image, #jm-location-google").change(function(){
        checkLocationOption();
    });

    function checkLocationOption(){
        if($("#jm-location-image").is(":checked")){
            $(".image-location").hide(100);
            $(".google-location").show(100);
        }
        else{
            $(".google-location").hide(100);
            $(".image-location").show(100);
        }
    }

    // wysiwyg
    if($.isFunction($.fn.summernote)){
        var heighTextArea = 100;
        if($(".wysiwyg.height").length){
            heighTextArea = 200;
        }
        $(".wysiwyg").summernote({
            toolbar:[
                ['style', ['style']],
                ['style',['bold','italic','underline']],
                ['para',['ul','ol', 'paragraph']],
                ['insert',['picture','link', 'video', 'table']],
                ['misc',['fullscreen']]
            ],
            height:heighTextArea
        });
        $(".wysiwyg-mini").summernote({
            toolbar:[
                ['style', ['style']],
                ['style',['bold','italic','underline']],
                ['para',['ul','ol', 'paragraph']]
            ],
            height:heighTextArea
        });
    }

    $(".select-image-file").change(function(){
        var parent = $(this).parent();
        var preview = parent.find("img");
        var id = $(this).attr("id");
        var image = document.getElementById(id).files[0];
        if(image != null){
            preview.fadeOut();
            var oFReader = new FileReader();
            oFReader.readAsDataURL(image);
            oFReader.onload = function (oFREvent) {
                parent.removeClass("empty");
                preview.attr('src', oFREvent.target.result).fadeIn(100);
            };
        }
    });

    $(".skill-level").each(function () {
        var skillAcquired = parseInt($(this).data("skill"));
        var skillCircle = "";
        for(var i = 0; i < 5; i++){
            if(i < skillAcquired){
                skillCircle += "<i class='fa fa-circle text-primary mxs'></i>";
            }
            else{
                skillCircle += "<i class='fa fa-circle text-muted mxs'></i>";
            }
        }
        $(this).html(skillCircle);
    });

    $("#jm-resume-file").change(function(){
        $("#jm-form-file-resume").submit();
    });

    jQuery("time.timeago").timeago();
    $("abbr.timeago").timeago();

    $('.datepicker').datepicker({
        format: "d MM yyyy"
    });

    // validation
    $("#jm-form-feedback").validate({
        errorClass:"text-warning"
    });

    $("#jm-form-comment").validate({
        errorClass:"text-warning",
        ignore:":hidden:not(.wysiwyg)"
    });

    $("#jm-form-register").validate({
        errorClass:"text-mute",
        ignore:":hidden:not(.wysiwyg)"
    });

    $("#jm-form-login").validate({
        errorClass:"text-mute"
    });

    $("#jm-form-forgot").validate({
        errorClass:"text-warning"
    });

    $("#jm-form-recovery").validate({
        errorClass:"text-mute",
        rules:{
            "jm-reset-password":{
                required:true,
                maxlength:45
            },
            "jm-reset-confirm":{
                required:true,
                maxlength:45,
                equalTo:"#jm-reset-password"
            }
        }
    });

    $("#jm-form-thread").validate({
        errorClass:"text-warning"
    });

    $("#jm-form-setting").validate({
        errorClass:"text-warning",
        rules:{
            "jm-password-new":{
                maxlength:45
            },
            "jm-password-confirm":{
                maxlength:45,
                equalTo:"#jm-password-new"
            }
        }
    });

    $("#jm-form-detail").validate({
        errorClass:"text-warning"
    });
    $("#jm-form-profile").validate({
        errorClass:"text-warning"
    });
    $("#jm-form-education").validate({
        errorClass:"text-warning"
    });
    $("#jm-form-skill").validate({
        errorClass:"text-warning"
    });
    $("#jm-form-job").validate({
        errorClass:"text-warning"
    });
    $("#jm-form-about").validate({
        errorClass:"text-warning"
    });
    $("#jm-form-story").validate({
        errorClass:"text-warning"
    });
    $("#jm-form-task").validate({
        errorClass:"text-warning"
    });
    $("#jm-form-task-edit").validate({
        errorClass:"text-warning"
    });
    $("#jm-form-opinion, #jm-form-achievement").validate({
        errorClass:"text-warning"
    });
    $("#jm-form-achievement-edit").validate({
        errorClass:"text-warning"
    });

    $("#jm-form-office").validate({
        errorClass:"text-warning"
    });

    $("#jm-form-photo").validate({
        errorClass:"text-warning"
    });

    $("#jm-form-people").validate({
        errorClass:"text-warning"
    });

    $("#jm-form-subscribe").validate();

    $(".highcharts-legend-item rect").attr("rx",0).attr("ry",0).attr("width",18).attr("height",18);
    $(".highcharts-legend-item text").attr("y",18);
    $(".highcharts-legend-item text tspan").attr("x", 25);



    var modal = $("#modal-info");
    var title = modal.find(".modal-title");
    var message = modal.find(".modal-message");

    function show_info(t, m){
        title.text(t);
        message.text(m);
        modal.modal("show");
    }

    function following_state(button){
        button.addClass("active");
        button.addClass("btn-unfollow");
        button.removeClass("btn-follow");
        button.html("<i class='fa fa-star mrsm'></i>UNFOLLOW");
    }
    function unfollowing_state(button){
        button.removeClass("active");
        button.removeClass("btn-unfollow");
        button.addClass("btn-follow");
        button.html("<i class='fa fa-star-o mrsm'></i>FOLLOW");
    }

    // FOLLOW CONTROL
    $(document).on("click",".btn-follow-control",function(e){
        e.preventDefault();
        var company_id = $(this).data("company");
        var button = $(this);

        if($(this).hasClass("btn-unfollow"))
        {
            unfollowing_state(button);
            $.ajax({
                type:"POST",
                url:website_url+"follower/unfollow",
                data:{company_id:company_id},
                success:function(data){
                    if(data == "success"){

                    }
                    if(data == "failed"){
                        following_state(button);
                        show_info("Unfollow Failed", "We apologize, please try again");
                    }
                    if(data == "restrict"){
                        following_state(button);
                        show_info("Unfollow Restrict", "You don't have authorization to do this action");
                    }
                },
                error:function(e){
                    following_state(button);
                    show_info("Application Error", "Something is getting wrong");
                }
            });
        }
        else{
            following_state(button);
            $.ajax({
                type:"POST",
                url:website_url+"follower/follow",
                data:{company_id:company_id},
                success:function(data){
                    if(data == "success"){

                    }
                    if(data == "failed"){
                        unfollowing_state(button);
                        show_info("Following Failed", "We apologize, please try again");
                    }
                    if(data == "restrict"){
                        unfollowing_state(button);
                        show_info("Following Restrict", "You don't have authorization to do this action");
                    }
                },
                error:function(e){
                    unfollowing_state(button);
                    show_info("Application Error", "Something is getting wrong");
                }
            });
        }
    });

    function saved_state(button){
        button.addClass("active");
        button.addClass("btn-remove-bookmark");
        button.removeClass("btn-bookmark");
        button.html("<i class='fa fa-star mrsm'></i>SAVED");
    }
    function unsaved_state(button){
        button.removeClass("active");
        button.removeClass("btn-remove-bookmark");
        button.addClass("btn-bookmark");
        button.html("<i class='fa fa-star-o mrsm'></i>SAVE JOB");
    }

    // BOOKMARK CONTROL
    $(document).on("click",".btn-bookmark-control",function(e){
        e.preventDefault();
        var job_id = $(this).data("job");
        var button = $(this);

        if($(this).hasClass("btn-remove-bookmark"))
        {
            unsaved_state(button);
            $.ajax({
                type:"POST",
                url:website_url+"bookmark/delete",
                data:{job_id:job_id},
                success:function(data){
                    if(data == "success"){

                    }
                    if(data == "failed"){
                        saved_state(button);
                        show_info("Remove Bookmark Failed", "We apologize, please try again");
                    }
                    if(data == "restrict"){
                        saved_state(button);
                        show_info("Remove Bookmark Restrict", "You don't have authorization to do this action");
                    }
                },
                error:function(e){
                    saved_state(button);
                    show_info("Application Error", "Something is getting wrong");
                }
            });
        }
        else{
            saved_state(button);
            $.ajax({
                type:"POST",
                url:website_url+"bookmark/save",
                data:{job_id:job_id},
                success:function(data){
                    if(data == "success"){

                    }
                    if(data == "failed"){
                        unsaved_state(button);
                        show_info("Save Job Failed", "We apologize, please try again");
                    }
                    if(data == "restrict"){
                        unsaved_state(button);
                        show_info("Save Job Restrict", "You have not authorization to do this action");
                    }
                },
                error:function(e){
                    unsaved_state(button);
                    show_info("Application Error", "Something is getting wrong");
                }
            });
        }
    });



    function undo_state(button){
        button.removeClass("btn-primary");
        button.addClass("btn-warning");
        button.html("UNDO REMOVE");
    }
    function followed_state(button){
        button.addClass("btn-primary");
        button.removeClass("btn-warning");
        button.html("REMOVE FOLLOWER");
    }

    $(".btn-following-control").click(function(e){
        e.preventDefault();
        var employee_id = $(this).data("employee");
        var button = $(this);

        if($(this).hasClass("btn-primary"))
        {
            undo_state(button);
            $.ajax({
                type:"POST",
                url:website_url+"follower/delete",
                data:{employee_id:employee_id},
                success:function(data){
                    if(data == "success"){

                    }
                    if(data == "failed"){
                        followed_state(button);
                        show_info("Delete Follower Failed", "We apologize, please try again");
                    }
                    if(data == "restrict"){
                        followed_state(button);
                        show_info("Delete Follower Restrict", "You have not authorization to do this action");
                    }
                },
                error:function(e){
                    followed_state(button);
                    show_info("Application Error", "Something is getting wrong");
                }
            });
        }
        else{
            followed_state(button);
            $.ajax({
                type:"POST",
                url:website_url+"follower/undo",
                data:{employee_id:employee_id},
                success:function(data){
                    if(data == "success"){

                    }
                    if(data == "failed"){
                        undo_state(button);
                        show_info("Undo Delete Failed", "We apologize, please try again");
                    }
                    if(data == "restrict"){
                        undo_state(button);
                        show_info("Undo Delete Restrict", "You have not authorization to do this action");
                    }
                },
                error:function(e){
                    undo_state(button);
                    show_info("Application Error", "Something is getting wrong");
                }
            });
        }

    });



});
