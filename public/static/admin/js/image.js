$(function() {

    //图片上传
    $("#file_upload").uploadify({
        'buttonText' :'图片上传',
        'swf'      : SCOPE.uploadify_swf,
        'uploader' : SCOPE.image_upload,
        'fileTypeDesc' : 'Image Files',
        'fileObjName' : 'file',
        'fileTypeExts' : '*.gif; *.jpg; *.png',
        'onUploadSuccess' : function(file, data, response) {
            if (response){
                var obj = JSON.parse(data);
                $('#upload_org_code_img').attr('src',obj.data);
                $('#file_upload_image').attr('value',obj.data);
                $('#upload_org_code_img').show();
            }else {
                var obj = JSON.parse(data);
                alert(obj.msg);
            }
        }
    });

    //营业执照图片上传
    $("#file_upload_other").uploadify({
        'buttonText' :'图片上传',
        'swf'      : SCOPE.uploadify_swf,
        'uploader' : SCOPE.image_upload,
        'fileTypeDesc' : 'Image Files',
        'fileObjName' : 'file',
        'fileTypeExts' : '*.gif; *.jpg; *.png',
        'onUploadSuccess' : function(file, data, response) {
            if (response){
                var obj = JSON.parse(data);
                $('#upload_org_code_img_other').attr('src',obj.data);
                $('#file_upload_image_other').attr('value',obj.data);
                $('#upload_org_code_img_other').show();
            }else {
                var obj = JSON.parse(data);
                alert(obj.msg);
            }
        }
    });


});
