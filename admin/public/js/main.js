$(document).ready(function () {
//  SET HEIGHT CONTENT
    var height = $(window).height() - $('#footer-wp').outerHeight(true) - $('#header-wp').outerHeight(true) - $('#title-page').outerHeight(true);
    $('#content').css('min-height', height);


//  CHECK ALL
    $('input[name="checkAll"]').click(function () {
        var status = $(this).prop('checked');
        $('.list-table-wp tbody tr td input[type="checkbox"]').prop("checked", status);
    });  
// Tắt thông báo    
 $('body').on('click','div#notifice i.fa-times-circle',function(){
     $(this).parents('#notifice').html('').hide();
 })
// EVENT SIDEBAR MENU
    $('#sidebar-menu .nav-item .nav-link .title').after('<span class="fa fa-angle-right arrow"></span>');
    var sidebar_menu = $('#sidebar-menu > .nav-item > .nav-link');
    sidebar_menu.on('click', function () {
        if (!$(this).parent('li').hasClass('active')) {
            $('.sub-menu').slideUp();
            $(this).parent('li').find('.sub-menu').slideDown();
            $('#sidebar-menu > .nav-item').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
        } else {
            $('.sub-menu').slideUp();
            $('#sidebar-menu > .nav-item').removeClass('active');
            return false;
        }
    });

    $('body').on('click','.fa-trash-o,.fa-trash',function(){
        if(confirm('Bạn chắc chắn muốn xóa chứ ? '))
            return true ;
            return false ;
    })
    
// update file
    $('body').on('click','.add-file',function () {
        $(this).css('display','none') ;
        var object = $(this) ;
        var inputFile = $(this).parents('div.up-file').find('input[type="file"]') ;
        var selector = $(this).parents('div.up-file') ;
        selector.find('.file-return').html('') ;
        var URI_single = 'http://phanvantam.com/admin/?mod=media&controller=index&action=add';//$('input#upload-action').val();
        var fileToUpload = inputFile[0].files[0];
        var formData = new FormData();
        formData.append('img', fileToUpload);
        formData.append('type', $('input#type').val());
        formData.append('img_id',selector.find('input.id').val());
        $.ajax({
            url: URI_single,
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
//                console.log(data) ;
                if(data.error !== undefined ){
                    selector.find('.file-return').html(data.error) ;
                }else{
                    var path = data.url ;
                    selector.parents('.main-up-file').find('img').attr('src',path);
                    selector.find('.id').val(data.id) ;
                }
            }
        });
        return false;
    });
// filter string 
    function filter_str(str){
        $list_char = Array("'",'"',',','.',';','$','&','(',')','@','!','#','^','*','_','-','=','\\','/','?','[',']','<','>','+','`','~',':') ;
        $str = str.replace($list_char,' ') ;
        return str.trim() ;
    }

// format giá 
function format_price(data) {
    var price_value = filter_str(data) ;
        price_value = price_value.replace(/ |\D/gi,'') ;
    var price_format = price_value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    return price_format ;
}
// Tạo slug 
function ChangeToSlug(str)
{
    //Đổi chữ hoa thành chữ thường
    slug = str.toLowerCase();
    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    
    return slug ;
}

// select file


    $('body').on("keydown",'.input-file-trigger', function( event ) {
        if ( event.keyCode == 13 || event.keyCode == 32 ) {
            $('.input-file').focus();
        }
    });
    $('body').on("click",'.input-file-trigger', function( event ) {
        $('.input-file').focus();
        return false;
    });
    $('body').on('change','.input-file',function() {
        $(this).parents('.up-file').find('.file-return').html(this.value) ;
        $(this).parents('.up-file').find('.add-file').css('display','block') ;
    });

// update media
    $('#list-img').on('click','.edit',function(){
        $(this).parents('li').find('.up-file').toggleClass('active','hidden') ;
        return false ;
    })
// Tạo slug
    $('input[name="title"]').keyup(function(){
        var slug = ChangeToSlug($(this).val());
        $("input[name='slug']").val(slug) ;
    });
    $('input[name="slug"]').keyup(function(){
        var slug = ChangeToSlug($(this).val());
        $(this).val(slug) ;
    });
// format giá
    $("input[name='price']").keyup(function(){
        var price = format_price($(this).val());
        $(this).val(price) ;
        $("input[name='discount']").val(price) ;
        discount() ;
    });
    $("input[name='min_price']").keyup(function(){
        var price = format_price($(this).val());
        $(this).val(price) ;
    });
    $("input[name='discount']").keyup(function(){
        var price = format_price($(this).val());
        $(this).val(price) ;
    });
    $("input[name='max_price']").keyup(function(){
        var price = format_price($(this).val());
        $(this).val(price) ;
    });
function discount(){
    var price = $("input[name='price']").val() ;
    var price = filter_str(price) ;
        price = price.replace(/ |\D/gi,'') ;
    var percen = Number($("input[name='percen']").val()) ;
        percen = percen > 100 ? 100 : percen; 
        percen = percen < 1 ? 0 : percen ; 
        $("input[name='percen']").val(percen) ;
    var discount = price - (percen * price) / 100 ;
        discount = Math.floor(discount) ;
        discount = discount.toString() ;
        discount = format_price(discount) ;
        $("input[name='discount']").val(discount) ;
}
$('input[name="percen"]').keyup(function(){
   discount() ;
})

// Thêm select file upload
$('#add-img-involve').click(function(){
    var $html = "<li><div class=\"main-up-file\">\n" +
        "                            <div class=\"up-file upload-file\">\n" +
        "                                <div class=\"input-file-container\">\n" +
        '<i class="fa fa-times-circle-o drop" aria-hidden="true"></i>  '+
        "                                    <input class=\"input-file\" name=\"img\" id=\"my-file\" type=\"file\">\n" +
        "                                    <label tabindex=\"0\" for=\"my-file\" class=\"input-file-trigger\">Chọn file tải lên</label>\n" +
        "                                    <input type=\"hidden\" name=\"img_involve[]\" class=\"id\" value=\"\">\n" +
        "                                    <button class=\"add-file\" name=\"\"><i class=\"fa fa-upload\" aria-hidden=\"true\"></i></button>\n" +
        "                                </div>\n" +
        "                                <p class=\"file-return\"></p>\n" +
        "                            </div>\n" +
        "                            <img src=\"public/images/sytem/product.jpg\">\n" +
        "                        </div></li>";
        $html += $('#list-option-img').html() ;
        $('#list-option-img').html($html) ;
})

// Drop img
function drop_img(path=null){
    var url = "index.php?mod=media&controller=index&action=drop" ;
        url += path ;
    $.ajax({
        method: 'GET',
        data:{},
        typeData:'text',
        url: url ,
        success: function(result){
        }
    });
}
// Xóa lựa chọn upload 
$('ul#list-option-img').on('click','li i.drop',function(){
    var id = $(this).parents('li').find('input.id').val() ;
    var path = '&id='+id ;
    var v = $(this).parents('li').hasClass('db-up');
    if(v){
        var product_id = $('input#product_id').val() ;
        path+='&product_id='+product_id+'&involve' ;
    }
    drop_img(path) ;
    $(this).parents('li').remove();
});

    $('.content-hidden').on('click','i.fa-times-circle',function (){
        $(this).parents('li').remove() ;
    });
$('.form-group select[name="location"]').change(function(){
    if($(this).val() == 2 ){
        $('#select-parent-footer').show() ;
    }else{
        $('#select-parent-footer').hide() ;
    }

    if($(this).val() == 3 ){
        $('#select-parent-sidebar').show() ;
    }else{
        $('#select-parent-sidebar').hide() ;
    }

    if($(this).val() == 4 ){
        $('#select-parent-respon').show() ;
    }else{
        $('#select-parent-respon').hide() ;
    }
});

});

