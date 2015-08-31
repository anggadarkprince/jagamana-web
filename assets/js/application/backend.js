$(document).ready(function() {
    // alert auto close
    $(".alert").delay(3000).slideUp(200,function(){
        $(this).alert('close');
    });

    // Toggle script
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    // data tables
    if($.isFunction($.fn.DataTable)){
        $('#datatable').DataTable({
            responsive: true
        });
    }

    $('#datatable td input[type=checkbox]').each(function(counter,element){
        if($(this).hasClass('checked') || $(this).is(":checked")){
            $(this).addClass('checked');
            $(this).parent().parent().parent().addClass('success');
        }
        else{
            $(this).removeClass('checked');
            $(this).parent().parent().parent().removeClass('success');
        }
    });

    $('#datatable input[type=checkbox]').click( function() {
        if($(this).hasClass('checked')){
            $(this).removeClass('checked')
        }
        else{
            $(this).addClass('checked')
        }
        $(this).parent().parent().not("th").parent().toggleClass('success');
    });

    $('#datatable th .checkbox').on('click', function () {
        if($(this).find("input").is(':checked')){
            $(this).closest('table').find('tbody tr input[type="checkbox"]').addClass('checked');
            $(this).closest('table').find('tbody tr').addClass('success');
        }
        else{
            $(this).closest('table').find('tbody tr input[type="checkbox"]').removeClass('checked');
            $(this).closest('table').find('tbody tr').removeClass('success');
        }
    });

    $('#help-tab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    //$("select").select2({dropdownCssClass: 'dropdown-inverse'});

    // Switches
    //$('[data-toggle="switch"]').bootstrapSwitch();

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
    $(".wysiwyg").summernote({
        toolbar:[
            ['style', ['style']],
            ['style',['bold','italic','underline']],
            ['para',['ul','ol', 'paragraph']],
            ['insert',['picture','link', 'video', 'table']],
            ['misc',['fullscreen']]
        ],
        height:100
    });

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

    $("#jm-form-setting").validate({
        errorClass:"text-danger",
        rules:{
            "jm-setting-new":{
                maxlength:45
            },
            "jm-setting-confirm":{
                maxlength:45,
                equalTo:"#jm-setting-new"
            }
        }
    });



});
