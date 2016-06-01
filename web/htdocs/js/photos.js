window.onload = function(){
    $('#export-student-number').click(function(){
        $('button').attr('disabled', 'disabled');
        var index = layer.load(0, {shade: false});
        $.post("/api.php/export/photos", {
            name : "student_number"
        }, function(data, status){
            layer.close(index);
            $('button').removeAttr('disabled');
            if(status == 'success'){
                if(data.status == 200){
                    layer.confirm(data.data.desc + ' 是否立即下载', {
                        btn: ['下载','算了'] //按钮
                    }, function(){
                        window.location.href = data.data.uri;
                    }, function(){
                        return;
                    });
                }else{
                    layer.msg(data.status + ':' + data.data);
                    return ;
                }
            }else{
                layer.msg('网络错误，请求失败！' + status);
                return ;
            }
        });
    });

    $('#export-student-name').click(function(){
        $('button').attr('disabled', 'disabled');
        var index = layer.load(0, {shade: false});
        $.post("/api.php/export/photos", {
            name : "name"
        }, function(data, status){
            layer.close(index);
            $('button').removeAttr('disabled');
            if(status == 'success'){
                if(data.status == 200){
                    layer.confirm(data.data.desc + ' 是否立即下载', {
                        btn: ['下载','算了'] //按钮
                    }, function(){
                        window.location.href = data.data.uri;
                    }, function(){
                        return;
                    });
                }else{
                    layer.msg(data.status + ':' + data.data);
                    return ;
                }
            }else{
                layer.msg('网络错误，请求失败！' + status);
                return ;
            }
        });
    });
}
