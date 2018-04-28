/*页面 全屏-添加*/
function o2o_edit(title,url){
    var index = layer.open({
        type: 2,
        title: title,
        content: url
    });
    layer.full(index);
}

/*添加或者编辑缩小的屏幕*/
function o2o_s_edit(title,url,w,h){
    layer_show(title,url,w,h);
}
/*-删除*/
function o2o_del(url,$msg){

    layer.confirm($msg,function(index){
        window.location.href=url;
    });
}


//主后台排序
$('.listorder input').blur(function () {
    var id = $(this).attr('attr-id');
    var listorder = $(this).val();
    var postData = {
        'id':id,
        'listorder':listorder,
    };
    var url = SCOPE.listorder_url;
    $.post(url,postData,function(result){
       if (result.code == 1){
           location.href = result.data;
       }else {
           alert(result.msg);
       }
    },'json');
});



//商户入驻二级城市信息
$('.cityId').change(function () {
    var cityId = $(this).val();
    var url = SCOPE.city_url;
    var postData = {
        'id': cityId,
    };
    city_html = '<option value="0">--请选择--</option>';
    $.post(url,postData,function (result) {
        if (result.status == 1){
            $(result.data).each(function () {
                city_html += '<option value="'+this.id+'">'+this.name+'</option>';
            });
            $('.se_city_id').html(city_html);
            $('.location').html('');
            return;
        } else if(result.status == 0) {
            $('.se_city_id').html('<option value="0">'+'--无--'+'</option>');
            $('.location').html('');
            return;
        }
    },'json');
});


//根据城市显示门店,商品添加页
$('.se_city_id').change(function () {
    var cityId = $('.cityId').val();
    var cityPath = cityId+','+$(this).val();
    var bisId = $('#bisId').val();
    var url = SCOPE.city_location;
    var postData = {
        'path':cityPath,
        'bis_id':bisId,
    };
    location_html = '';
    $.post(url,postData,function (result) {
        if (result.status){
            $(result.data).each(function () {
                location_html += '<input name="location_ids" class="checkbox-moban" type="checkbox" value="' + this.id + '">' + this.name;
                location_html += '<label for="checkbox-moban">&nbsp;</label>';
            });
            $('.location').html(location_html);
            return;
        }else {
            $('.location').html('该城市无门店');
            return;
        }
    },'json');
});


//商户入驻二级分类信息
    $('.categoryId').change(function () {
        var categoryId = $(this).val();
        var url = SCOPE.category_url;
        var postData = {
            'id': categoryId,
        };
        category_html = '';
        $.post(url, postData, function (result) {
            if (result.status == 1) {
                $(result.data).each(function () {
                    category_html += '<input name="se_category_id" class="checkbox-moban" type="checkbox" value="' + this.id + '">' + this.name;
                    category_html += '<label for="checkbox-moban">&nbsp;</label>';
                    return ;
                });
                $('.se_category_id').html(category_html);
            } else if (result.status == 0) {
                $('.se_category_id').html('');
                return;
            }
        }, 'json');
    });


$(function () {
//商户入驻提交获取数据
    $('#register').click(function (i) {
        var d = {};
        var t = $('form').serializeArray();
        var url = SCOPE.register_url;
        var waiting_url = SCOPE.waiting_url;
        var seCategoryId = [];
        $("input[name='se_category_id']:checked").each(function(i){
            seCategoryId[i] =$(this).val();
         });

        $.each(t, function () {
            d[this.name] = this.value;
        });

        var postData = d;

        $.ajax({
            url: url,
            data: {
                'info':postData,
                'se_category_id':seCategoryId,

            },
            dataType: 'json',
            type: "POST",
            success: function (data) {
                if (!data.code) {
                    $('#msg').text(data.msg);
                    $('#msg').show();
                }else {
                    location.href=waiting_url+'?id='+data.bisId;
                }
            }
        });

        i.preventDefault();
    });

//商户入驻地址标记经纬度
    $('#maptag').click(function () {
        var tagAddress = $('.address input').val();
        var url = SCOPE.maptag_url;
        if (tagAddress == ''){
            $('#tagmsg').text('地址为空');
            $('#tagmsg').show();
            return;
        }
        $.post(url, {check:3,address: tagAddress}, function (result) {
            if (result.code) {
                $('#tagmsg').text('经度约为:' + result.lng + '，纬度约为:' + result.lat);
                $('#tagmsg').show();
            }else {
                $('#tagmsg').text(result.msg);
                $('#tagmsg').show();
            }
        }, 'json');
    });



    $('#emailtag').click(function () {
        var url = SCOPE.maptag_url;
        var email = $('#email').val();
        var re=/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
        if (email == '' || !re.test(email)){
            $('#emailmsg').text('邮箱不正确');
            $('#emailmsg').show();
            return;
        }
        $.post(url,{check:1,email:email},function (data) {
            if (data.code) {
                $('#emailmsg').text(data.msg);
                $('#emailmsg').show();
            }else {
                $('#emailmsg').text(data.msg);
                $('#emailmsg').show();
            }
        },'json');

    });

    $('#usertag').click(function () {
        var url = SCOPE.maptag_url;
        var username = $('#username').val();
        if(username == '') {
            $('#usermsg').text('地址为空');
            $('#usermsg').show();
        }
        $.post(url,{check:2,username:username},function (data) {
            if (data.code) {
                $('#usermsg').text(data.msg);
                $('#usermsg').show();
            }else {
                $('#usermsg').text(data.msg);
                $('#usermsg').show();
            }
        },'json');
    });

});

//新门店申请
$('#newLocation').click(function (i) {
    var d = {};
    var t = $('form').serializeArray();
    var url = SCOPE.location_url;
    var seCategoryId = [];
    $("input[name='se_category_id']:checked").each(function(i){
        seCategoryId[i] =$(this).val();
    });
    $.each(t, function () {
        d[this.name] = this.value;
    });
    var postData = d;

    $.ajax({
        url: url,
        data: {
            'info':postData,
            'se_category_id':seCategoryId,
        },
        dataType: 'json',
        type: "POST",
        success: function (data) {
            if (!data.code) {
                $('#msg').text(data.msg);
                $('#msg').show();
            }else {
                layer.alert(data.msg,{icon: 6},function () {
                    location.href=data.url;
                });

            }
        }
    });
    i.preventDefault();
})

function selecttime(flag){
    if(flag==1){
        var endTime = $("#countTimeend").val();
        if(endTime != ""){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',maxDate:endTime});
        }else{
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'});
        }
    }else{
        var startTime = $("#countTimestart").val();
        if(startTime != ""){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',minDate:startTime});
        }else{
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'});
        }
    }
}

//团购商品提交

$('.newDeal').click(function (i) {
    var d = {};
    var t = $('form').serializeArray();
    var url = SCOPE.deal_url;
    var seCategoryId = [];
    var locationIds = [];
    $("input[name='location_ids']:checked").each(function(i){
        locationIds[i] =$(this).val();
    });
    $("input[name='se_category_id']:checked").each(function(i){
        seCategoryId[i] =$(this).val();
    });
    $.each(t, function () {
        d[this.name] = this.value;
    });
    var postData = d;

    $.ajax({
        url: url,
        data: {
            'info':postData,
            'se_category_id':seCategoryId,
            'location_ids': locationIds,
        },
        dataType: 'json',
        type: "POST",
        success: function (data) {
            if (!data.code) {
                $('#msg').text(data.msg);
                $('#msg').show();
            }else {
                layer.alert(data.msg,{icon: 6},function () {
                    location.href=data.url;
                });

            }
        }
    });
    i.preventDefault();
});


//搜索时间判断
$('#searchDeal').click(function (i) {
    var start = $('#start_time').val();
    var end = $('#end_time').val();
    if (start && !end) {
        layer.alert('选择结束时间');
        i.preventDefault();
    }
    if (!start && end) {
        layer.alert('选择结束时间');
        i.preventDefault();
    }
    var start_time = Date.parse(start);
    var end_time = Date.parse(end);

    if (start_time >= end_time){
        layer.alert('结束时间要大于开始时间');
        i.preventDefault();
    }

});

//推荐位添加

$('#newFeatured').click(function (i) {
    var d = {};
    var t = $('form').serializeArray();
    var url = SCOPE.featured_url;
    $.each(t,function () {
        d[this.name] = this.value;
    });
    var postDate = d;
    $.ajax({
        url:url,
        data:{
            'info':postDate,
        },
        dataType: 'json',
        type: "POST",
        success:function (result) {
            if (!result.code){
                layer.alert(result.msg);
            }else {
                layer.alert(result.msg,function () {
                    location.href=result.url;
                });
            }
        }
    });
    i.preventDefault();
});






