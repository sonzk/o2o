$('#register').submit(function (i) {
    var data = $('form').serialize();

    var url = 'register';

    $.ajax({
        url:url,
        data:{
            info:data,
        },
        type:'POST',
        dataType:'json',
        success:function (result) {
            if (!result.code){
                layer.msg(result.msg);
            }else {
                layer.msg(result.msg,{time:1000,icon: 16
                    ,shade: 0.01},function () {
                    location.href=result.url;
                });
            }
        }

    });
    i.preventDefault();
});


$('#login').submit(function (i) {
    var data = $('form').serialize();

    var url = 'logincheck';

    $.ajax({
        url:url,
        data:{
            info:data,
        },
        type:'POST',
        dataType:'json',
        success:function (result) {
            if (!result.code){
                layer.msg(result.msg);
            }else {
                layer.msg(result.msg,{time:1000,icon: 16
                    ,shade: 0.01},function () {
                    location.href=result.url;
                });
            }
        }

    });
    i.preventDefault();
});